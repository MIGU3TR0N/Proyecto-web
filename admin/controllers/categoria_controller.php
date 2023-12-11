<?php
require_once("sistema.php");

/**
 * Controller Categoria
 */
class Categoria extends Sistema
{
    /**
     * Obtiene la categoria solicitada
     *
     * @return array $data las categorias solicitadas
     * @param integer $id si se especifica un id solo obtiene la categoria solicitada, de lo contrario obtiene todas
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from categoria";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from categoria where id_categoria = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nueva categoria
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos de la nueva categoria
     */
    public function new ($data)
    {
        $this->db();
        $sql = "insert into categoria (categoria) values (:categoria)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":categoria", $data['categoria'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar categoria
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador de la categoria a editar
     *         array $data los datos modificados de la categoria
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update categoria set categoria = :categoria where id_categoria = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":categoria", $data['categoria'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar categoria
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador de la categoria a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from categoria where id_categoria = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$categoria = new Categoria;
?>