<?php
require_once("sistema.php");

/**
 * Controller Proveedor
 */
class Proveedor extends Sistema
{
    /**
     * Obtiene el proveedor solicitado
     *
     * @return array $data los proveedores solicitados
     * @param integer $id si se especifica un id solo obtiene el proveedor solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from proveedor";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from proveedor where id_proveedor = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo proveedor
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo proveedor
     */
    public function new ($data)
    {
        $this->db();
        $sql = "insert into proveedor (proveedor, telefono) values (:proveedor, :telefono)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":proveedor", $data['proveedor'], PDO::PARAM_STR);
        $st->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar proveedor
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del proveedor a editar
     *         array $data los datos modificados del proveedor
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update proveedor set proveedor = :proveedor, telefono = :telefono where id_proveedor = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":proveedor", $data['proveedor'], PDO::PARAM_STR);
        $st->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar proveedor
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del proveedor a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from proveedor where id_proveedor = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$proveedor = new Proveedor;
?>