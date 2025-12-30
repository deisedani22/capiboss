<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/config.php';

class Aulas {
    private $id;
    private $trilha_id;
    private $titulo;
    private $created_at;

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
            $stmt = $conexao->prepare("SELECT * FROM aulas WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->trilha_id = $resultado['trilha_id'];
                $this->titulo = $resultado['titulo'];
                $this->created_at = $resultado['created_at'];
            }
        } catch (Exception $e) {
            echo "Erro ao carregar aula: " . $e->getMessage();
        }
    }

    public function enviar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("INSERT INTO aulas (trilha_id, titulo) VALUES (:trilha_id, :titulo)");
            $stmt->bindValue(":trilha_id", $this->trilha_id);
            $stmt->bindValue(":titulo", $this->titulo);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao enviar aula: " . $e->getMessage();
        }
    }

    public static function listar(){
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT a.*, t.titulo AS trilha_nome FROM aulas a JOIN trilhas t ON a.trilha_id = t.id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao listar aulas: " . $e->getMessage();
            return [];
        }
    }

    public function atualizar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("UPDATE aulas SET trilha_id = :trilha_id, titulo = :titulo WHERE id = :id");
            $stmt->bindValue(":trilha_id", $this->trilha_id);
            $stmt->bindValue(":titulo", $this->titulo);
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao atualizar aula: " . $e->getMessage();
        }
    }

    public function deletar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("DELETE FROM aulas WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao deletar aula: " . $e->getMessage();
        }
    }

    public function getMissoesPorAula($aula_id){
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM missoes WHERE aula_id = :aula_id");
            $stmt->bindValue(":aula_id", $aula_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao obter missões por aula: " . $e->getMessage();
            return [];
        }
    }

    public function getLicoesPorAula($aula_id){
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM licoes WHERE aula_id = :aula_id");
            $stmt->bindValue(":aula_id", $aula_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao obter lições por aula: " . $e->getMessage();
            return [];
        }
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }
    public function setTrilhaId($trilha_id)
    {
        $this->trilha_id = $trilha_id;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getTrilhaId()
    {
        return $this->trilha_id;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    
}