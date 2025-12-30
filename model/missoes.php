<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/config.php';

class Missoes {
    private $id;
    private $aula_id;
    private $titulo;
    private $jogo_url;
    private $recompensa_capimoedas;
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
            $stmt = $conexao->prepare("SELECT * FROM missoes WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->aula_id = $resultado['aula_id'];
                $this->titulo = $resultado['titulo'];
                $this->jogo_url = $resultado['jogo_url'];
                $this->recompensa_capimoedas = $resultado['recompensa_capimoedas'];
                $this->created_at = $resultado['created_at'];
            }
        } catch (Exception $e) {
            echo "Erro ao carregar missão: " . $e->getMessage();
        }
    }

    public function enviar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("INSERT INTO missoes (aula_id, titulo, jogo_url) VALUES (:aula_id, :titulo, :jogo_url)");
            $stmt->bindValue(":aula_id", $this->aula_id);
            $stmt->bindValue(":titulo", $this->titulo);
            $stmt->bindValue(":jogo_url", $this->jogo_url);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao enviar missão: " . $e->getMessage();
        }
    }

    public static function listar(){
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT m.*, a.titulo AS aula_nome FROM missoes m JOIN aulas a ON m.aula_id = a.id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao listar missões: " . $e->getMessage();
            return [];
        }
    }

    public function atualizar(){
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("UPDATE missoes SET aula_id = :aula_id, titulo = :titulo, jogo_url = :jogo_url, recompensa_capimoedas = :recompensa_capimoedas WHERE id = :id");
            $stmt->bindValue(":aula_id", $this->aula_id);
            $stmt->bindValue(":titulo", $this->titulo);
            $stmt->bindValue(":jogo_url", $this->jogo_url);
            $stmt->bindValue(":recompensa_capimoedas", $this->recompensa_capimoedas);
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao atualizar missão: " . $e->getMessage();
        }
    }

    public function deletar(){
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("DELETE FROM missoes WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao deletar missão: " . $e->getMessage();
        }
    }

    public function countPorAula($aula_id){
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT COUNT(*) AS total FROM missoes WHERE aula_id = :aula_id");
            $stmt->bindValue(":aula_id", $aula_id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] ?? 0;
        } catch (Exception $e) {
            echo "Erro ao contar missões: " . $e->getMessage();
            return 0;
        }
    }

    public static function listPorTermo($termo)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM missoes WHERE titulo LIKE :termo LIKE :termo");
            $stmt->bindValue(":termo", "%" . $termo . "%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao buscar trilhas: " . $e->getMessage();
            return [];
        }
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }
    public function getAulaId()
    {
        return $this->aula_id;
    }
    public function setAulaId($aula_id)
    {
        $this->aula_id = $aula_id;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getJogoUrl()
    {
        return $this->jogo_url;
    }
    public function setJogoUrl($jogo_url)
    {
        $this->jogo_url = $jogo_url;
    }
    public function getRecompensaCapimoedas()
    {
        return $this->recompensa_capimoedas;
    }
    public function setRecompensaCapimoedas($recompensa_capimoedas)
    {
        $this->recompensa_capimoedas = $recompensa_capimoedas;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
}