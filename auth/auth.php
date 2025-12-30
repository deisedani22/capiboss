<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/config.php';
session_start();

class Auth
{
    public static function login($email, $senha)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && password_verify($senha, $resultado['senha_hash'])) {
                $_SESSION['usuario_id'] = $resultado['id'];
                $_SESSION['usuario_nome'] = $resultado['nome'];
                $_SESSION['usuario_email'] = $resultado['email'];
                $_SESSION['foto'] = $resultado['foto'];
                $_SESSION['vidas'] = $resultado['coracoes'];
                $_SESSION['estrelas'] = $resultado['estrelas'];
                $_SESSION['capimoedas'] = $resultado['capimoedas'];
                $_SESSION['tipo_usuario'] = $resultado['tipo_usuario'];
                $_SESSION['timer'] = new DateTime(); // Inicia o timer de sessão
                header('Location: /capiboss/home.php'); // painel de controle
                exit;
            } else {
                $_SESSION["msg"] = "Email ou senha inválidos!";
                header('Location: /capiboss/index.php');
                exit;
            }
        } catch (Exception $e) {
            echo "Erro ao autenticar usuário: " . $e->getMessage();
            return false;
        }
    }
    public static function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /capiboss/index.php');
        exit;
    }

    public static function estaLogado()
    {
        return isset($_SESSION['usuario_id']);
    }

    public static function isAluno()
    {
        return isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'aluno';
    }

    public static function isProfessor()
    {
        return isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'professor';
    }

    public static function isAdmin()
    {
        return isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin';
    }

    public static function encerraSessaoPorInatividade($limiteMinutos = 15)
    {
        if (isset($_SESSION['timer'])) {
            $agora = new DateTime();
            $diferenca = $agora->getTimestamp() - $_SESSION['timer']->getTimestamp();
            $limiteSegundos = $limiteMinutos * 60;

            if ($diferenca > $limiteSegundos) {
                self::logout();
            } else {
                $_SESSION['timer'] = new DateTime(); // Reinicia o timer
            }
        } else {
            $_SESSION['timer'] = new DateTime(); // Inicia o timer se não existir
        }
    }
}

// Encerra a sessão por inatividade
Auth::encerraSessaoPorInatividade();