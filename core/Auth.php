<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function require_admin() {
    require_login();
    if ($_SESSION['account_type'] !== 'admin') {
        header("Location: home.php?error=access_denied");
        exit();
    }
}

function require_staff_or_admin() {
    require_login();
    if (!in_array($_SESSION['account_type'], ['admin', 'staff'])) {
        header("Location: home.php?error=access_denied");
        exit();
    }
}

function current_user_id() {
    return $_SESSION['user_id'] ?? null;
}