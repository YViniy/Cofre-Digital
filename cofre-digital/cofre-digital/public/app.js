const API_AUTH = '../api/AuthController.php';
const API_SECRET = '../api/SecretController.php';

function toggleForm(type) {
    const loginCard = document.getElementById('login-card');
    const registerCard = document.getElementById('register-card');
    if (type === 'register') {
        loginCard.classList.add('hidden');
        registerCard.classList.remove('hidden');
    } else {
        loginCard.classList.remove('hidden');
        registerCard.classList.add('hidden');
    }
}

// Login
if (document.getElementById('login-form')) {
    document.getElementById('login-form').onsubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const res = await fetch(`${API_AUTH}?action=login`, { method: 'POST', body: formData });
        const data = await res.json();
        if (data.success) {
            window.location.href = 'dashboard.html';
        } else {
            alert(data.message);
        }
    };
}

// Registro
if (document.getElementById('register-form')) {
    document.getElementById('register-form').onsubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const res = await fetch(`${API_AUTH}?action=register`, { method: 'POST', body: formData });
        const data = await res.json();
        alert(data.message);
        if (data.success) toggleForm('login');
    };
}

// Dashboard - Salvar Segredo
if (document.getElementById('secret-form')) {
    document.getElementById('secret-form').onsubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const res = await fetch(`${API_SECRET}?action=create`, { method: 'POST', body: formData });
        const data = await res.json();
        if (data.success) {
            e.target.reset();
            loadSecrets();
        } else {
            alert(data.message);
        }
    };
}

async function loadSecrets() {
    const list = document.getElementById('secrets-list');
    if (!list) return;

    const res = await fetch(`${API_SECRET}?action=list`);
    const data = await res.json();

    if (data.success) {
        list.innerHTML = data.data.map(s => `
            <div class="secret-item">
                <div class="secret-info">
                    <h3>${s.title}</h3>
                    <p>${s.content}</p>
                </div>
                <button class="btn-delete" onclick="deleteSecret(${s.id})">Excluir</button>
            </div>
        `).join('');
    }
}

async function deleteSecret(id) {
    if (!confirm('Tem certeza?')) return;
    const formData = new FormData();
    formData.append('id', id);
    const res = await fetch(`${API_SECRET}?action=delete`, { method: 'POST', body: formData });
    const data = await res.json();
    if (data.success) loadSecrets();
}

async function checkAuth() {
    const res = await fetch(`${API_AUTH}?action=check`);
    const data = await res.json();
    if (!data.success && window.location.pathname.includes('dashboard.html')) {
        window.location.href = 'index.html';
    }
}

async function logout() {
    await fetch(`${API_AUTH}?action=logout`);
    window.location.href = 'index.html';
}
