<?php
require_once("sistema.php");

class Producto extends Sistema{
    public function get($id = null){        
        $this->db();
        if (is_null($id)){
            $sql = "SELECT p.id_producto, p.producto, p.precio, p.costo, p.sku,
            p.unidades, p.id_marca, m.marca, m.id_proveedor, pro.proveedor, 
            pro.telefono, p.id_categoria, c.categoria 
            FROM producto AS p LEFT JOIN marca AS m ON m.id_marca = p.id_marca 
            LEFT JOIN categoria AS c ON c.id_categoria = p.id_categoria 
            LEFT JOIN proveedor AS pro ON pro.id_proveedor = m.id_proveedor";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $sql = "SELECT p.id_producto, p.producto, p.precio, p.costo, p.sku, 
            p.unidades, p.id_marca, m.marca, m.id_proveedor, pro.proveedor, pro.telefono, 
            p.id_categoria, c.categoria FROM producto AS p 
            LEFT JOIN marca AS m ON m.id_marca = p.id_marca 
            LEFT JOIN categoria AS c ON c.id_categoria = p.id_categoria 
            LEFT JOIN proveedor AS pro ON pro.id_proveedor = m.id_proveedor 
            WHERE p.id_producto =:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function new ($data){        
        $this->db();

        $sql = "INSERT INTO producto (producto, precio, costo, sku, unidades, id_marca, id_categoria) 
        VALUES (:producto, :precio, :costo, :sku, :unidades, :id_marca, :id_categoria)";

        $st = $this->db->prepare($sql);
        $st->bindParam(":producto", $data['producto'], PDO::PARAM_STR);
        $st->bindParam(":precio", $data['precio'], PDO::PARAM_STR);
        $st->bindParam(":costo", $data['costo'], PDO::PARAM_STR);
        $st->bindParam(":sku", $data['sku'], PDO::PARAM_STR);
        $st->bindParam(":unidades", $data['unidades'], PDO::PARAM_INT);
        $st->bindParam(":id_marca", $data['id_marca'], PDO::PARAM_INT);
        $st->bindParam(":id_categoria", $data['id_categoria'], PDO::PARAM_INT);

        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id){
        $this->db();
        $sql = "DELETE FROM producto WHERE id_producto=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data){
        $this->db();

        $sql = "UPDATE producto
            SET producto = :producto, precio = :precio, costo = :costo, 
            sku = :sku, unidades = :unidades, id_marca = :id_marca, id_categoria = :id_categoria 
            WHERE id_producto =:id";
        
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":producto", $data['producto'], PDO::PARAM_STR);
        $st->bindParam(":precio", $data['precio'], PDO::PARAM_STR);
        $st->bindParam(":costo", $data['costo'], PDO::PARAM_STR);
        $st->bindParam(":sku", $data['sku'], PDO::PARAM_STR);
        $st->bindParam(":unidades", $data['unidades'], PDO::PARAM_INT);
        $st->bindParam(":id_marca", $data['id_marca'], PDO::PARAM_INT);
        $st->bindParam(":id_categoria", $data['id_categoria'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$producto = new Producto; 
?>