<?php
class Security {
    public static function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
?>
