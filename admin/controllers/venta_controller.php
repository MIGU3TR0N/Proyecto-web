<?php
require_once("sistema.php");
/**
 * Controller Venta
 */
class Venta extends Sistema{
    /**
    * Obtiene las ventas solicitadas
    *
    * @return array $data las ventas solicitadas
    * @param integer $id si se especifica un id solo obtiene la venta solicitada, de lo contrario obtiene todas
    */
    public function get($id = null){        
        $this->db();
        if (is_null($id)){
            $sql = "SELECT v.id_venta, v.fecha, u.id_usuario, u.usuario, u.nombre AS nombre, 
            t.id_tienda, t.tienda, t.direccion, e.id_empleado, ue.nombre AS empleado 
            FROM venta AS v LEFT JOIN usuario AS u ON u.id_usuario = v.id_usuario 
            LEFT JOIN tienda AS t ON t.id_tienda = v.id_tienda 
            LEFT JOIN empleado AS e ON e.id_empleado = v.id_empleado 
            LEFT JOIN usuario AS ue ON ue.id_usuario = e.id_usuario;";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $sql = "SELECT v.id_venta, v.fecha, u.id_usuario, u.usuario, u.nombre AS nombre, 
            t.id_tienda, t.tienda, t.direccion, e.id_empleado, ue.nombre AS empleado 
            FROM venta AS v LEFT JOIN usuario AS u ON u.id_usuario = v.id_usuario 
            LEFT JOIN tienda AS t ON t.id_tienda = v.id_tienda 
            LEFT JOIN empleado AS e ON e.id_empleado = v.id_empleado 
            LEFT JOIN usuario AS ue ON ue.id_usuario = e.id_usuario
            WHERE v.id_venta=:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    /**
    * Nueva venta
    *
    * @return integer $rc cantidad de filas afectadas por el insert
    * @param array $data los datos de la nueva venta
    */
    public function new ($data){        
        $this->db();

        $sql = "INSERT INTO `venta`(`fecha`, `id_usuario`, `id_tienda`, `id_empleado`)
        VALUES (:fecha ,:id_usuario ,:id_tienda ,:id_empleado)";

        $st = $this->db->prepare($sql);
        $st->bindParam(":fecha", $data['fecha'], PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);
        $st->bindParam(":id_tienda", $data['id_tienda'], PDO::PARAM_INT);
        $st->bindParam(":id_empleado", $data['id_empleado'], PDO::PARAM_INT);

        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    /**
     * Borrar venta
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador de la venta a eliminar
     */
    public function delete($id){
        $this->db();
        $sql = "DELETE FROM venta WHERE id_venta=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    /**
     * Editar venta
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador de la venta a editar
     *         array $data los datos modificados de la vebta
     */
    public function edit($id, $data){
        $this->db();

        $sql = "UPDATE venta 
            SET fecha =:fecha, id_usuario =:id_usuario, id_tienda =:id_tienda, id_empleado =:id_empleado
            where id_venta =:id";
        
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":fecha", $data['fecha'], PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);
        $st->bindParam(":id_tienda", $data['id_tienda'], PDO::PARAM_INT);
        $st->bindParam(":id_empleado", $data['id_empleado'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    //Detalles

    public function getDetails($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT vd.id_venta, vd.id_producto, v.fecha, v.id_usuario, 
            u.nombre, v.fecha, v.id_tienda, t.tienda, t.direccion, p.producto,
            p.sku, p.precio AS precio_unitario, vd.cantidad 
            FROM venta_detalle AS vd 
            LEFT JOIN venta AS v on v.id_venta = vd.id_venta 
            LEFT JOIN producto AS p ON p.id_producto = vd.id_producto 
            LEFT JOIN usuario AS u ON u.id_usuario = v.id_venta 
            LEFT JOIN tienda AS t ON t.id_tienda = v.id_tienda;";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT vd.id_venta, vd.id_producto, v.fecha, v.id_usuario, 
            u.nombre, v.fecha, v.id_tienda, t.tienda, t.direccion, p.producto,
            p.sku, p.precio AS precio_unitario, vd.cantidad 
            FROM venta_detalle AS vd 
            LEFT JOIN venta AS v on v.id_venta = vd.id_venta 
            LEFT JOIN producto AS p ON p.id_producto = vd.id_producto 
            LEFT JOIN usuario AS u ON u.id_usuario = v.id_venta 
            LEFT JOIN tienda AS t ON t.id_tienda = v.id_tienda 
            WHERE vd.id_venta = :id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function getAllDetails()
    {
        $this->db();
        $sql = "SELECT * from producto;";
        $st = $this->db->prepare($sql);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function deleteDetails($id_venta, $id_producto)
    {
        $this->db();
        $sql = "delete from venta_detalle where id_venta = :id_venta AND id_producto = :id_producto";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_producto", $id_producto, PDO::PARAM_STR);
        $st->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newDetails($id, $data)
    {
        $this->db();
        $sql = "insert into venta_detalle (id_venta, id_producto, cantidad) values (:id_venta,:id_producto,:cantidad)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_venta", $id, PDO::PARAM_INT);
        $st->bindParam(":id_producto", $data['id_producto'], PDO::PARAM_INT);
        $st->bindParam(":cantidad", $data['cantidad'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
//Objeto de la clase venta
$venta = new Venta; 
?>