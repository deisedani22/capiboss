<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/config.php';

class Progresso
{
    private $id;
    private $user_id;
    private $tipo; // trila, aula, missao, licao
    private $referencia_id;
    private $status; // bloqueado, iniciado, concluido
    private $updated_at;

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
            $stmt = $conexao->prepare("SELECT * FROM Progresso WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultado) {
                $this->user_id = $resultado['user_id'];
                $this->tipo = $resultado['tipo'];
                $this->referencia_id = $resultado['referencia_id'];
                $this->status = $resultado['status'];
                $this->updated_at = $resultado['updated_at'];
            }
        } catch (Exception $e) {
            echo "Erro ao carregar progresso: " . $e->getMessage();
        }
    }

    public function criar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("INSERT INTO Progresso (user_id, tipo, referencia_id, status) VALUES (:user_id, :tipo, :referencia_id, :status)");
            $stmt->bindValue(":user_id", $this->user_id);
            $stmt->bindValue(":tipo", $this->tipo);
            $stmt->bindValue(":referencia_id", $this->referencia_id);
            $stmt->bindValue(":status", $this->status);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao criar progresso: " . $e->getMessage();
        }
    }

    public static function verificarProgresso($user_id, $tipo, $referencia_id)
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT * FROM Progresso WHERE user_id = :user_id AND tipo = :tipo AND referencia_id = :referencia_id");
            $stmt->bindValue(":user_id", $user_id);
            $stmt->bindValue(":tipo", $tipo);
            $stmt->bindValue(":referencia_id", $referencia_id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? true : false;
        } catch (Exception $e) {
            echo "Erro ao verificar progresso: " . $e->getMessage();
            return false;
        }
    }

    public static function contarProgressoTrilha($user_id, $trilha_id)
    {
        try {
            $conexao = Config::conectar();

            $sql = "
            SELECT 
                COUNT(DISTINCT m.id) AS total_missoes,
                COUNT(DISTINCT p.id) AS missoes_concluidas
            FROM Trilhas t
            INNER JOIN Aulas a 
                ON a.trilha_id = t.id
            INNER JOIN Missoes m 
                ON m.aula_id = a.id
            LEFT JOIN Progresso p 
                ON p.tipo = 'missao'
                AND p.referencia_id = m.id
                AND p.user_id = :user_id
                AND p.status = 'concluido'
            WHERE t.id = :trilha_id
        ";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->bindValue(":trilha_id", $trilha_id);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$resultado || $resultado['total_missoes'] == 0) {
                return [
                    'total' => 0,
                    'concluidas' => 0,
                    'percentual' => 0
                ];
            }

            $percentual = round(
                ($resultado['missoes_concluidas'] / $resultado['total_missoes']) * 100
            );

            return [
                'total' => (int)$resultado['total_missoes'],
                'concluidas' => (int)$resultado['missoes_concluidas'],
                'percentual' => $percentual
            ];
        } catch (Exception $e) {
            echo "Erro ao contar progresso: " . $e->getMessage();
            return [
                'total' => 0,
                'concluidas' => 0,
                'percentual' => 0
            ];
        }
    }

    public static function licoesConcluidasNaAula($user_id, $aula_id)
    {
        try {
            $conexao = Config::conectar();

            $sql = "
            SELECT 
                COUNT(DISTINCT l.id) AS total_licoes,
                COUNT(DISTINCT p.id) AS licoes_concluidas
            FROM Licoes l
            LEFT JOIN Progresso p 
                ON p.referencia_id = l.id
                AND p.tipo = 'licao'
                AND p.user_id = :user_id
                AND p.status = 'concluido'
            WHERE l.aula_id = :aula_id
        ";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':aula_id', $aula_id);
            $stmt->execute();

            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            // Se não tiver lições, retorna false por segurança
            if (!$r || $r['total_licoes'] == 0) {
                return false;
            }

            return ((int)$r['total_licoes'] === (int)$r['licoes_concluidas']);
        } catch (Exception $e) {
            echo "Erro ao verificar lições: " . $e->getMessage();
            return false;
        }
    }

    public static function progressoDeTrilhas($user_id)
    {
        try {
            $conexao = Config::conectar();

            $sql = "
            SELECT 
                t.id AS trilha_id,
                t.titulo,
                COUNT(DISTINCT m.id) AS total_missoes,
                COUNT(DISTINCT p.id) AS missoes_concluidas
            FROM Trilhas t
            INNER JOIN Aulas a 
                ON a.trilha_id = t.id
            INNER JOIN Missoes m 
                ON m.aula_id = a.id
            LEFT JOIN Progresso p 
                ON p.tipo = 'missao'
                AND p.referencia_id = m.id
                AND p.user_id = :user_id
                AND p.status = 'concluido'
            GROUP BY t.id, t.titulo
            ORDER BY t.titulo
        ";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->execute();

            $lista = [];

            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $total = (int)$r['total_missoes'];
                $concluidas = (int)$r['missoes_concluidas'];

                $percentual = $total > 0
                    ? round(($concluidas / $total) * 100)
                    : 0;

                $lista[] = [
                    'trilha_id'   => (int)$r['trilha_id'],
                    'titulo'      => $r['titulo'],
                    'total'       => $total,
                    'concluidas'  => $concluidas,
                    'percentual'  => $percentual,
                    'finalizada'  => ($total > 0 && $total === $concluidas)
                ];
            }

            return $lista;
        } catch (Exception $e) {
            echo "Erro ao buscar progresso das trilhas: " . $e->getMessage();
            return [];
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getReferenciaId()
    {
        return $this->referencia_id;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    public function setReferenciaId($referencia_id)
    {
        $this->referencia_id = $referencia_id;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
