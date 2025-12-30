<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/config.php';

class Trilhas {
    private $id;
    private $titulo;
    private $descricao;
    private $nivel_dificuldade;
    private $foto;
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
            $stmt = $conexao->prepare("SELECT * FROM trilhas WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->titulo = $resultado['titulo'];
                $this->descricao = $resultado['descricao'];
                $this->nivel_dificuldade = $resultado['nivel_dificuldade'];
                $this->foto = $resultado['foto'];
                $this->recompensa_capimoedas = $resultado['recompensa_capimoedas'];
                $this->created_at = $resultado['created_at'];
            }
        } catch (Exception $e) {
            echo "Erro ao carregar trilha: " . $e->getMessage();
        }
    }

    public function enviar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("INSERT INTO trilhas (titulo, descricao, nivel_dificuldade, foto) VALUES (:titulo, :descricao, :nivel_dificuldade, :foto)");
            $stmt->bindValue(":titulo", $this->titulo);
            $stmt->bindValue(":descricao", $this->descricao);
            $stmt->bindValue(":nivel_dificuldade", $this->nivel_dificuldade);
            $stmt->bindValue(":foto", $this->foto);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao enviar trilha: " . $e->getMessage();
        }
    }

    public static function listar(){
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM trilhas");
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (Exception $e) {
            echo "Erro ao listar trilhas: " . $e->getMessage();
            return [];
        }
    }

    public function atualizar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("UPDATE trilhas SET titulo = :titulo, descricao = :descricao, nivel_dificuldade = :nivel_dificuldade, foto = :foto, recompensa_capimoedas = :recompensa_capimoedas WHERE id = :id");
            $stmt->bindValue(":titulo", $this->titulo);
            $stmt->bindValue(":descricao", $this->descricao);
            $stmt->bindValue(":nivel_dificuldade", $this->nivel_dificuldade);
            $stmt->bindValue(":foto", $this->foto);
            $stmt->bindValue(":recompensa_capimoedas", $this->recompensa_capimoedas);
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao atualizar trilha: " . $e->getMessage();
        }
    }

    public function deletar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("DELETE FROM trilhas WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao deletar trilha: " . $e->getMessage();
        }
    }

    public function countAulas($trilha_id)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT COUNT(*) AS total FROM aulas WHERE trilha_id = :trilha_id");
            $stmt->bindValue(":trilha_id", $trilha_id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] ?? 0;
        } catch (Exception $e) {
            echo "Erro ao contar aulas: " . $e->getMessage();
            return 0;
        }
    }

    public function countMissoes($trilha_id)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT COUNT(*) AS total FROM missoes m JOIN aulas a ON m.aula_id = a.id WHERE a.trilha_id = :trilha_id");
            $stmt->bindValue(":trilha_id", $trilha_id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] ?? 0;
        } catch (Exception $e) {
            echo "Erro ao contar missões: " . $e->getMessage();
            return 0;
        }
    }

    public function countLicoes($trilha_id)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT COUNT(*) AS total FROM aulas WHERE trilha_id = :trilha_id");
            $stmt->bindValue(":trilha_id", $trilha_id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] ?? 0;
        } catch (Exception $e) {
            echo "Erro ao contar lições: " . $e->getMessage();
            return 0;
        }
    }

    public function getAulasPorTrilha($trilha_id)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM aulas WHERE trilha_id = :trilha_id");
            $stmt->bindValue(":trilha_id", $trilha_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao obter aulas por trilha: " . $e->getMessage();
            return [];
        }
    }

    public static function listPorTermo($termo)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM trilhas WHERE titulo LIKE :termo OR descricao LIKE :termo");
            $stmt->bindValue(":termo", "%" . $termo . "%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao buscar trilhas: " . $e->getMessage();
            return [];
        }
    }

    // Getters and Setters
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setNivelDificuldade($nivel_dificuldade)
    {
        $this->nivel_dificuldade = $nivel_dificuldade;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function setRecompensaCapimoedas($recompensa_capimoedas)
    {
        $this->recompensa_capimoedas = $recompensa_capimoedas;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getNivelDificuldade()
    {
        return $this->nivel_dificuldade;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getRecompensaCapimoedas()
    {
        return $this->recompensa_capimoedas;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    

}

