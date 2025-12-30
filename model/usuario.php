<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/config.php';

class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $senhaHash;
    private $codigoInstituicao;
    private $tipoUsuario;
    private $foto;
    private $estrelas;
    private $capimoedas;
    private $coracoes;
    private $telefone;

    public function __construct($id = false)
    {
        if ($id) {
            $this->id = $id;
            $this->carregar();
        }
    }

    private function carregar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM users  WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->nome = $resultado['nome'];
                $this->email = $resultado['email'];
                $this->senhaHash = $resultado['senha_hash'];
                $this->codigoInstituicao = $resultado['codigo_instituicao'];
                $this->tipoUsuario = $resultado['tipo_usuario'];
                $this->telefone = $resultado['telefone'];
                $this->foto = $resultado['foto'];
                $this->estrelas = $resultado['estrelas'];
                $this->capimoedas = $resultado['capimoedas'];
                $this->coracoes = $resultado['coracoes'];
            }
        } catch (Exception $e) {
            echo "Erro ao carregar usuário: " . $e->getMessage();
        }
    }

    public function enviar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("INSERT INTO users (nome, email, senha_hash, codigo_instituicao, telefone, foto) VALUES (:nome, :email, :senha_hash, :codigo_instituicao, :telefone, :foto)");
            $stmt->bindValue(":nome", $this->nome);
            $stmt->bindValue(":email", $this->email);
            $stmt->bindValue(":senha_hash", $this->senhaHash);
            $stmt->bindValue(":codigo_instituicao", $this->codigoInstituicao);
            $stmt->bindValue(":telefone", $this->telefone);
            $stmt->bindValue(":foto", $this->foto);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao enviar usuário: " . $e->getMessage();
        }
    }

    public static function listar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM users ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao listar usuários: " . $e->getMessage();
            return [];
        }
    }

    public function atualizar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("UPDATE users  SET nome = :nome, email = :email, senha_hash = :senha_hash, codigo_instituicao = :codigo_instituicao, tipo_usuario = :tipo_usuario, telefone = :telefone WHERE id = :id");
            $stmt->bindValue(":nome", $this->nome);
            $stmt->bindValue(":email", $this->email);
            $stmt->bindValue(":senha_hash", $this->senhaHash);
            $stmt->bindValue(":codigo_instituicao", $this->codigoInstituicao);
            $stmt->bindValue(":tipo_usuario", $this->tipoUsuario);
            $stmt->bindValue(":telefone", $this->telefone);
            $stmt->bindValue(":id", $this->id);

            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
        }
    }
    
    public function deletar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("DELETE FROM users  WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao deletar usuário: " . $e->getMessage();
        }
    }

    public static function atualizarFoto($filename, $id)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("UPDATE users SET foto = :foto WHERE id = :id");
            $stmt->bindValue(":foto", $filename);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao atualizar foto do usuário: " . $e->getMessage();
        }
    }

    public static function atualizarCapimoedas($usuario, $quantidade)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("UPDATE users SET capimoedas = capimoedas + :capimoedas WHERE id = :id");
            $stmt->bindValue(":capimoedas", $quantidade, PDO::PARAM_INT);
            $stmt->bindValue(":id", $usuario);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao atualizar capimoedas: " . $e->getMessage();
        }
    }

    public static function atualizarEstrelas($usuario)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("UPDATE users SET estrelas = estrelas + 1 WHERE id = :id");
            $stmt->bindValue(":id", $usuario);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao atualizar estrelas: " . $e->getMessage();
        }
    }

    public static function listPorTermo($termo)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM users WHERE nome LIKE :termo OR email LIKE :termo");
            $stmt->bindValue(":termo", "%" . $termo . "%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao buscar usuários: " . $e->getMessage();
            return [];
        }
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setSenhaHash($senhaHash)
    {
        $this->senhaHash = $senhaHash;
    }

    public function setCodigoInstituicao($codigoInstituicao)
    {
        $this->codigoInstituicao = $codigoInstituicao;
    }

    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getEstrelas()
    {
        return $this->estrelas;
    }
    public function getCapimoedas()
    {
        return $this->capimoedas;
    }

    public function getCoracoes()
    {
        return $this->coracoes;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

}
