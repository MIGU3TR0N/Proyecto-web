<?php
require_once("sistema.php");
/**
 * Controller Marca
 */
class Marca extends Sistema{
    /**
    * Obtiene las marcas solicitadas
    *
    * @return array $data las marcas solicitadas
    * @param integer $id si se especifica un id solo obtiene la marca solicitada, de lo contrario obtiene todas
    */
    public function get($id = null){        
        $this->db();
        if (is_null($id)){
            $sql = "select * from marca m  left join proveedor p
            on m.id_proveedor = p.id_proveedor ";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $sql = "select * from marca m  left join proveedor p
            on m.id_proveedor = p.id_proveedor where m.id_marca=:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    /**
    * Nueva marca
    *
    * @return integer $rc cantidad de filas afectadas por el insert
    * @param array $data los datos de la nueva marca
    */
    public function new ($data){        
        $this->db();

        $sql = "INSERT INTO marca ( marca, id_proveedor) 
        VALUES (:marca, :id_proveedor)";

        $st = $this->db->prepare($sql);
        $st->bindParam(":marca", $data['marca'], PDO::PARAM_STR);
        $st->bindParam(":id_proveedor", $data['id_proveedor'], PDO::PARAM_INT);

        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    /**
     * Borrar marca
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador de la marca a eliminar
     */
    public function delete($id){
        $this->db();
        $sql = "DELETE FROM marca WHERE id_marca=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    /**
     * Editar marca
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador de la marca a editar
     *         array $data los datos modificados de la marca
     */
    public function edit($id, $data){
        $this->db();

        $sql = "UPDATE marca 
            SET marca =:marca, id_proveedor =:id_proveedor
            where id_marca =:id";
        
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":marca", $data['marca'], PDO::PARAM_STR);
        $st->bindParam(":id_proveedor", $data['id_proveedor'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    //Categorias

    public function getCategory($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT c.id_categoria, c.categoria from categoria as c left join marca_categoria as mc on mc.id_categoria = c.id_categoria left join marca as m on m.id_marca = mc.id_marca;";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT c.id_categoria, c.categoria from categoria as c left join marca_categoria as mc on mc.id_categoria = c.id_categoria left join marca as m on m.id_marca = mc.id_marca where mc.id_marca =:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function getAllCategories()
    {
        $this->db();
        $sql = "SELECT * from categoria;";
        $st = $this->db->prepare($sql);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function deleteCategory($id_marca, $id_categoria)
    {
        $this->db();
        $sql = "delete from marca_categoria where id_categoria = :id_categoria AND id_marca = :id_marca";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_categoria", $id_categoria, PDO::PARAM_STR);
        $st->bindParam(":id_marca", $id_marca, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newCategory($id, $data)
    {
        $this->db();
        $sql = "insert into marca_categoria (id_marca,id_categoria) values (:id_marca,:id_categoria)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_marca", $id, PDO::PARAM_INT);
        $st->bindParam(":id_categoria", $data['id_categoria'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
//Objeto de la clase marca
$marca = new Marca; 
?>