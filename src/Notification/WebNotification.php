<?php

declare(strict_types=1);

namespace App\Notification;

class WebNotification
{
    public static function add(string $message, string $types): void
    {
        $_SESSION[$types] = $message;
    }

    public static function show(): void
    {
        if (isset($_SESSION['success'])) {
            $type = 'success';
            $message = $_SESSION['success'];
            include '../views/template/notification.phtml';
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['danger'])) {
            $type = 'danger';
            $message = $_SESSION['danger'];
            include '../views/template/notification.phtml';
            unset($_SESSION['danger']);
        }
        if (isset($_SESSION['warning'])) {
            $type = 'warning';
            $message = $_SESSION['warning'];
            include '../views/template/notification.phtml';
            unset($_SESSION['warning']);
        }
    }
}
