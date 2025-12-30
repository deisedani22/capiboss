<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/auth/auth.php';

if (Auth::estaLogado()) {
    Auth::logout();
} else {
    header('Location: /capiboss/index.php');
    exit;
}
