<?php

namespace App\Core;

use App\Models\User;

class Auth
{
    public static function login(string $username, string $password): bool
    {
        SessionManager::start();

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {

            SessionManager::set('user_id', $user['id']);
            SessionManager::set('account_type', $user['account_type']);

            return true;
        }

        return false;
    }

    public static function requireLogin(): void
    {
        SessionManager::start();

        if (!SessionManager::get('user_id')) {
            header("Location: login.php");
            exit;
        }
    }

    public static function requireAdmin(): void
    {
        self::requireLogin();

        if (SessionManager::get('account_type') !== 'admin') {
            header("Location: home.php?error=access_denied");
            exit;
        }
    }

    public static function requireStaffOrAdmin(): void
    {
        self::requireLogin();

        $role = SessionManager::get('account_type');

        if (!in_array($role, ['admin', 'staff'])) {
            header("Location: home.php?error=access_denied");
            exit;
        }
    }

    public static function userId(): ?int
    {
        return SessionManager::get('user_id');
    }

    public static function logout(): void
    {
        SessionManager::start();
        SessionManager::destroy();

        header("Location: login.php");
        exit;
    }
}