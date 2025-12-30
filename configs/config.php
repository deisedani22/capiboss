<?php
// config.php

require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/constant.php';

class Config
{

    public static function conectar()
    {
        try {
            $pdo = new PDO(SGBD . ":host=" . LOCALDOBANCO . ";dbname=" . NOMEDOBANCO . ";charset=utf8mb4", USUARIO, SENHA);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            exit;
        }
    }
}
