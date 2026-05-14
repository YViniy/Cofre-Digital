# Cofre-Digital
O COFRE DIGITAL

Vinicius Eduardo Guimarães dos Santos: 247434-1


Tecnologias Utilizadas
O projeto foi desenvolvido utilizando as seguintes tecnologias:

PHP → Linguagem principal da aplicação
XAMPP → Ambiente de desenvolvimento local (Apache + PHP + MySQL)
HTML5 → Estrutura das páginas
CSS3 → Estilização da interface
JavaScript → Interações e requisições da aplicação
MySQL → Banco de dados para armazenamento das informações
GitHub → Versionamento do código
Objetivo da Atividade:
Aplicar conceitos de Security by Design na prática através de uma dinâmica de:

🔵 Blue Team (Desenvolvedor)
Construção e proteção da API.
🔴 Red Team (Auditoria)
Identificação e exploração de possíveis vulnerabilidades.
📂 Funcionalidades da API
A API possui os seguintes endpoints obrigatórios:

🔐 Registro de Usuário
POST /api/register
Responsável por cadastrar um novo usuário.

Campos:
{
  "nome": "Usuário",
  "email": "usuario@email.com",
  "senha": "123456"
}
Login de Usuário:
POST /api/login
Realiza autenticação do usuário e retorna acesso ao sistema.

Campos:
{
  "email": "usuario@email.com",
  "senha": "123456"
}
Criar Segredo:
POST /api/secrets
Cria uma anotação secreta vinculada ao usuário autenticado.

Campos:
{
  "titulo": "Minha senha",
  "conteudo_secreto": "SenhaSuperSecreta123"
}
Buscar Segredo por ID:
GET /api/secrets/{id}
Retorna uma anotação secreta específica através do ID informado.

Conceitos de Segurança Aplicados:
Durante o desenvolvimento foram utilizados alguns princípios de segurança:

Criptografia de senhas utilizando password_hash()
Validação de dados de entrada
Organização da API em rotas
Controle básico de autenticação
Proteção contra acesso indevido às informações
Separação entre frontend e backend
⚙️ Como Executar o Projeto
1️⃣ Instalar o XAMPP
Baixe e instale o XAMPP:

XAMPP Oficial

-Clonar o Repositório
git clone https://github.com/SEU-USUARIO/SEU-REPOSITORIO.git
-Mover Projeto para a Pasta do XAMPP
Coloque a pasta do projeto dentro de:

htdocs/
Exemplo:

C:/xampp/htdocs/cofre-digital
-Iniciar o Apache e MySQL
Abra o painel do XAMPP e inicie:

Apache
MySQL
-Configurar Banco de Dados
Acesse o phpMyAdmin:

http://localhost/phpmyadmin
Crie o banco de dados e importe o arquivo .sql do projeto.

-Executar o Projeto
Acesse no navegador:

http://localhost/cofre-digital
📁 Estrutura do Projeto
/cofre-digital
│
├── api/
│   ├── register.php
│   ├── login.php
│   ├── secrets.php
│
├── css/
├── js/
├── database/
├── index.php
└── README.md
