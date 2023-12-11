<?php
require_once("sistema.php");

/**
 * Controller Tienda
 */
class Tienda extends Sistema
{
    /**
     * Obtiene la tienda solicitado
     *
     * @return array $data las tiendas solicitados
     * @param integer $id si se especifica un id solo obtiene la tienda solicitada, de lo contrario obtiene todas
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from tienda";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from tienda where id_tienda = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nueva tienda
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos de la nueva tienda
     */
    public function new ($data)
    {
        $this->db();
        $sql = "insert into tienda (tienda, direccion) values (:tienda, :direccion)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":tienda", $data['tienda'], PDO::PARAM_STR);
        $st->bindParam(":direccion", $data['direccion'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar tienda
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador de la tienda a editar
     *         array $data los datos modificados de la tienda
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update tienda set tienda = :tienda, direccion = :direccion where id_tienda = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":tienda", $data['tienda'], PDO::PARAM_STR);
        $st->bindParam(":direccion", $data['direccion'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar tienda
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador de la tienda a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from tienda where id_tienda = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$tienda = new Tienda;
?>