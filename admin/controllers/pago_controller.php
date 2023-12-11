<?php
require_once("sistema.php");

class Pago extends Sistema{
    public function get($id = null){        
        $this->db();
        if (is_null($id)){
            $sql = "SELECT p.id_pago, p.fecha, p.monto, p.id_venta, v.id_usuario,
            u.nombre AS nombre, v.id_tienda, t.tienda, t.direccion, v.id_empleado, ue.nombre AS empleado 
            FROM pago AS p LEFT JOIN venta AS v ON v.id_venta = p.id_venta 
            LEFT JOIN usuario AS u ON v.id_usuario = u.id_usuario 
            LEFT JOIN tienda AS t ON t.id_tienda = v.id_tienda 
            LEFT JOIN empleado AS e ON e.id_empleado = v.id_empleado
            LEFT JOIN usuario AS ue ON ue.id_usuario = e.id_usuario
            ";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $sql = "SELECT p.id_pago, p.fecha, p.monto, p.id_venta, v.id_usuario, 
            u.nombre AS nombre, v.id_tienda, t.tienda, t.direccion, v.id_empleado, ue.nombre AS empleado 
            FROM pago AS p LEFT JOIN venta AS v ON v.id_venta = p.id_venta 
            LEFT JOIN usuario AS u ON v.id_usuario = u.id_usuario 
            LEFT JOIN tienda AS t ON t.id_tienda = v.id_tienda 
            LEFT JOIN empleado AS e ON e.id_empleado = v.id_empleado 
            LEFT JOIN usuario AS ue ON ue.id_usuario = e.id_usuario
            WHERE p.id_pago =:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function new ($data){        
        $this->db();

        $sql ="INSERT INTO pago (fecha, monto, id_venta) VALUES (:fecha, :monto, :id_venta)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":fecha", $data['fecha'], PDO::PARAM_STR);
        $st->bindParam(":monto", $data['monto'], PDO::PARAM_STR);
        $st->bindParam(":id_venta", $data['id_venta'], PDO::PARAM_INT);

        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    public function delete($id){
        $this->db();
        $sql = "DELETE FROM pago WHERE id_pago=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function edit($id, $data){
        $this->db();
        $sql = "UPDATE pago 
        SET fecha = :fecha, monto = :monto, id_venta = :id_venta 
        WHERE id_pago = :id";
        
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":fecha", $data['fecha'], PDO::PARAM_STR);
        $st->bindParam(":monto", $data['monto'], PDO::PARAM_STR);
        $st->bindParam(":id_venta", $data['id_venta'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$pago = new pago; 
?>