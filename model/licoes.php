<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/capiboss/configs/config.php';

class Licoes
{
    private $id;
    private $aula_id;
    private $titulo;
    private $conteudo;
    private $video_url;
    private $arquivo;
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
            $stmt = $conexao->prepare("SELECT * FROM licoes WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $this->aula_id = $data['aula_id'];
                $this->titulo = $data['titulo'];
                $this->conteudo = $data['conteudo'];
                $this->video_url = $data['video_url'];
                $this->arquivo = $data['arquivo'];
                $this->created_at = $data['created_at'];
            }
        } catch (Exception $e) {
            echo "Erro ao carregar aula: " . $e->getMessage();
        }
    }

    public function enviar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("INSERT INTO licoes (aula_id, titulo, conteudo, video_url, arquivo) VALUES (:aula_id, :titulo, :conteudo, :video_url, :arquivo)");
            $stmt->bindValue(":aula_id", $this->aula_id);
            $stmt->bindValue(":titulo", $this->titulo);
            $stmt->bindValue(":conteudo", $this->conteudo);
            $stmt->bindValue(":video_url", $this->video_url);
            $stmt->bindValue(":arquivo", $this->arquivo);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao enviar lição: " . $e->getMessage();
        }
    }

    public static function listar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("SELECT l.*, a.titulo AS aula_nome FROM licoes l JOIN aulas a ON l.aula_id = a.id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erro ao listar lições: " . $e->getMessage();
            return [];
        }
    }

    public function atualizar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("UPDATE licoes SET aula_id = :aula_id, titulo = :titulo, conteudo = :conteudo, video_url = :video_url, arquivo = :arquivo WHERE id = :id");
            $stmt->bindValue(":aula_id", $this->aula_id);
            $stmt->bindValue(":titulo", $this->titulo);
            $stmt->bindValue(":conteudo", $this->conteudo);
            $stmt->bindValue(":video_url", $this->video_url);
            $stmt->bindValue(":arquivo", $this->arquivo);
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao atualizar lição: " . $e->getMessage();
        }
    }

    public function deletar()
    {
        try {
            $conexao = Config::conectar();
            $stmt = $conexao->prepare("DELETE FROM licoes WHERE id = :id");
            $stmt->bindValue(":id", $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erro ao deletar lição: " . $e->getMessage();
        }
    }

    public function setAulaId($aula_id)
    {
        $this->aula_id = $aula_id;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAulaId()
    {
        return $this->aula_id;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getConteudo()
    {
        return $this->conteudo;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getVideo()
    {
        return $this->video_url;
    }
    public function getArquivo()
    {
        return $this->arquivo;
    }
    public function setVideo($video_url)
    {
        $this->video_url = $video_url;
    }
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;
    }
    
}
