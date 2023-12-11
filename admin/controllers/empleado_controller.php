<?php
require_once("sistema.php");
/**
 * Controller Empleado
 */
class Empleado extends Sistema{
    /**
    * Obtiene los empleados solicitado
    *
    * @return array $data los empleados solicitados
    * @param integer $id si se especifica un id solo obtiene el empleado solicitado, de lo contrario obtiene todos
    */
    public function get($id = null){        
        $this->db();
        if (is_null($id)){
            $sql = "select * from empleado e  left join tienda t 
            on e.id_tienda = t.id_tienda left join usuario u on u.id_usuario = e.id_usuario ";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $sql = "select * from empleado e  left join tienda t 
            on e.id_tienda = t.id_tienda left join usuario u on u.id_usuario = e.id_usuario 
            where e.id_empleado=:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    /**
    * Nuevo empleado
    *
    * @return integer $rc cantidad de filas afectadas por el insert
    * @param array $data los datos del nuevo empleado
    */
    public function new ($data){        
        $this->db();

        $sql = "INSERT INTO empleado (id_tienda, id_usuario) 
        VALUES (:id_tienda, :id_usuario)";

        $st = $this->db->prepare($sql);
        $st->bindParam(":id_tienda", $data['id_tienda'], PDO::PARAM_INT);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);

        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    /**
     * Borrar empleado
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del empleado a eliminar
     */
    public function delete($id){
        $this->db();
        $sql = "DELETE FROM empleado WHERE id_empleado=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    /**
     * Editar empleado
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del empleado a editar
     *         array $data los datos modificados del empleado
     */
    public function edit($id, $data){
        $this->db();

        $sql = "UPDATE empleado 
            SET id_tienda =:id_tienda,
            id_usuario = :id_usuario
            where id_empleado =:id";
        
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id_tienda", $data['id_tienda'], PDO::PARAM_INT);
        $st->bindParam(":id_usuario", $data['id_usuario'], PDO::PARAM_INT);
        
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
//Objeto de la clase empleado
$empleado = new Empleado; 
?>