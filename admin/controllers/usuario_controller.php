<?php
require_once("sistema.php");

/**
 * Controller Usuario
 */
class Usuario extends Sistema
{
    /**
     * Obtiene el usuario solicitado
     *
     * @return array $data los usuario solicitados
     * @param integer $id si se especifica un id solo obtiene el usuario solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT u.id_usuario, u.usuario, u.correo, u.nombre, u.direccion, u.telefono, 
            GROUP_CONCAT(DISTINCT r.rol ORDER BY r.rol ASC) AS rol,
            GROUP_CONCAT(DISTINCT p.privilegio ORDER BY p.privilegio ASC) AS privilegio 
            FROM usuario AS u LEFT JOIN usuario_rol AS ur ON u.id_usuario = ur.id_usuario 
            LEFT JOIN rol AS r ON ur.id_rol = r.id_rol 
            LEFT JOIN rol_privilegio AS pr ON pr.id_rol = r.id_rol 
            LEFT JOIN privilegio AS p ON p.id_privilegio = pr.id_privilegio 
            GROUP BY u.id_usuario, u.correo ORDER BY u.correo ASC;
            ";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT u.id_usuario, u.usuario, u.correo, u.nombre, u.direccion, u.telefono, 
            GROUP_CONCAT(DISTINCT r.rol ORDER BY r.rol ASC) AS rol,
            GROUP_CONCAT(DISTINCT p.privilegio ORDER BY p.privilegio ASC) AS privilegio 
            FROM usuario AS u LEFT JOIN usuario_rol AS ur ON u.id_usuario = ur.id_usuario 
            LEFT JOIN rol AS r ON ur.id_rol = r.id_rol 
            LEFT JOIN rol_privilegio AS pr ON pr.id_rol = r.id_rol 
            LEFT JOIN privilegio AS p ON p.id_privilegio = pr.id_privilegio 
            WHERE u.id_usuario = :id
            GROUP BY u.id_usuario, u.correo ORDER BY u.correo ASC
            ";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo usuario
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo usuario
     */
    public function new ($data)
    {
        $this->db();
        $sql = "insert into usuario (usuario, nombre, correo, contrasena, direccion, telefono) 
        values (:usuario, :nombre, :correo, md5(:contrasena), :direccion, :telefono)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":usuario", $data['usuario'], PDO::PARAM_STR);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR, 32);
        $st->bindParam(":direccion", $data['direccion'], PDO::PARAM_STR);
        $st->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar usuario
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del usuario a editar
     *         array $data los datos modificados del usuario
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update usuario set usuario =:usuario , nombre =:nombre , correo =:correo, direccion =:direccion , telefono =:telefono  where id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":usuario", $data['usuario'], PDO::PARAM_STR);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $st->bindParam(":direccion", $data['direccion'], PDO::PARAM_STR);
        $st->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar usuario
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del usuario a eliminar
     */public function delete($id)
    {
        $this->db();
        $sql = "delete from usuario where id_usuario = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    //Roles

    public function getRole($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT r.rol from rol as r left join usuario_rol as ur on ur.id_rol = r.id_rol left join usuario as u on u.id_usuario = ur.id_usuario;";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT r.id_rol, r.rol from rol as r left join usuario_rol as ur on ur.id_rol = r.id_rol left join usuario as u on u.id_usuario = ur.id_usuario where ur.id_usuario =:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function getAllRoles()
    {
        $this->db();
        $sql = "SELECT * from rol;";
        $st = $this->db->prepare($sql);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function deleteRole($id_usuario, $id_rol)
    {
        $this->db();
        $sql = "delete from usuario_rol where id_rol = :id_rol AND id_usuario = :id_usuario";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_rol", $id_rol, PDO::PARAM_STR);
        $st->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function newRole($id, $data)
    {
        $this->db();
        $sql = "insert into usuario_rol (id_usuario,id_rol) values (:id_usuario,:id_rol)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_usuario", $id, PDO::PARAM_INT);
        $st->bindParam(":id_rol", $data['id_rol'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function getRoleOne($id)
    {
        $data = null;
        $this->db();
        if (is_null($id)) {
            die("*se murio*");
        } else {
            $sql = "SELECT * from tarea t left join proyecto p on t.id_proyecto=p.id_proyecto
            where t.id_tarea=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    //Privilegios
    public function getPrivilege($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT * from privilegio as p left join rol_privilegio as pr on pr.id_privilegio = p.id_privilegio left join rol as r on r.id_rol = pr.id_rol;";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * from privilegio as p left join rol_privilegio as pr on pr.id_privilegio = p.id_privilegio left join rol as r on r.id_rol = pr.id_rol where pr.id_rol =:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function privilegeGetRole($id)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "SELECT r.id_rol, r.rol from rol as r left join rol_privilegio as pr on pr.id_rol = r.id_rol ;";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT r.id_rol, r.rol  from rol as r left join rol_privilegio as pr on pr.id_rol = r.id_rol where r.id_rol =:id;";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function getAllPrivileges()
    {
        $this->db();
        $sql = "SELECT * from privilegio;";
        $st = $this->db->prepare($sql);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function newPrivilege($id, $data)
    {
        $this->db();
        $sql = "insert into rol_privilegio (id_rol,id_privilegio) values (:id_rol,:id_privilegio)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_rol", $id, PDO::PARAM_INT);
        $st->bindParam(":id_privilegio", $data['id_privilegio'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function deletePrivilege($id_privilegio, $id_rol)
    {
        $this->db();
        $sql = "delete from rol_privilegio where id_rol = :id_rol AND id_privilegio = :id_privilegio";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_rol", $id_rol, PDO::PARAM_STR);
        $st->bindParam(":id_privilegio", $id_privilegio, PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$usuario = new Usuario;
?>