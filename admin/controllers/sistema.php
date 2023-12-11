<?php
session_start();
require_once(__DIR__.'/../config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Sistema{
    var $db = null;
    public function db()
    {
        $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
        $this->db = new PDO($dsn, DBUSER, DBPASS);
    }

    public function flash($color, $msg)
    {
        include('../views/flash.php');
    }

    public function uploadfile($tipo, $ruta, $archivo)
    {
        $name = false;
        $uploads['archivo'] = array("application/gzip", "application/zip", "application/x-zip-compressed");
        $uploads['fotografia'] = array("image/jpeg", "image/jpg", "image/gif", "image/png");
        if($_FILES[$tipo]['error']==4){
            return $name;
            
        }
        if ($_FILES[$tipo]['error'] == 0) {
            if (in_array($_FILES[$tipo]['type'], $uploads['archivo'])) {
                if ($_FILES[$tipo]['size'] <= 2 * 1048 * 1048) {
                    $origen = $_FILES[$tipo]['tmp_name'];
                    $ext = explode(".", $_FILES[$tipo]['name']);
                    $ext = $ext[sizeof($ext) - 1];
                    $destino = $ruta . $archivo . "." . $ext;
                    if (move_uploaded_file($origen, $destino)) {
                        $name = $destino;
                    }
                }
            }elseif (in_array($_FILES[$tipo]['type'], $uploads['imagen'])) {
                if ($_FILES[$tipo]['size'] <= 6 * 1048 * 1048 && getimagesize($_FILES[$tipo]['tmp_name'])) {
                    $origen = $_FILES[$tipo]['tmp_name'];
                    $ext = pathinfo($_FILES[$tipo]['name'], PATHINFO_EXTENSION);
                    $destino = $ruta . $archivo . "." . $ext;
                    if (move_uploaded_file($origen, $destino)) {
                        $name = $destino;
                    }
                }
            }
        }
        return $name;
    }

    public function login($correo, $contrasena)
    {
        if (!is_null($contrasena)) {
            if (strlen($contrasena) > 0) {
                if ($this->validate_Email($correo)) {
                    $contrasena = md5($contrasena);
                    $this->db();
                    $sql = 'SELECT u.id_usuario, u.correo, u.usuario, u.nombre, t.tienda, t.id_tienda 
                    from usuario u LEFT JOIN empleado e ON e.id_usuario = u.id_usuario 
                    LEFT JOIN tienda t ON t.id_tienda = e.id_tienda
                    WHERE u.correo=:correo AND u.contrasena=:contrasena';
                    $st = $this->db->prepare($sql);
                    $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                    $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
                    $st->execute();
                    $data = $st->fetchAll(PDO::FETCH_ASSOC);
                    if (isset($data[0])) {
                        $data = $data[0];
                        $_SESSION = $data;
                        $_SESSION['roles'] = $this->getRoles($correo);
                        $_SESSION['privilegios'] = $this->getPrivilegios($correo);
                        $_SESSION['validado'] = true;
                        return true;
                    }
                }
            }
        }
        return false;
        //$_SESSION["loggedin"] = true;
    }

    public function validate_Email($correo)
    {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    public function getRoles($correo)
    {
        $roles = array();
        if ($this->validate_Email($correo)) {
            $this->db();
            $sql = 'select r.rol from usuario as u join usuario_rol as ur on u.id_usuario = ur.id_usuario join rol as r on ur.id_rol = r.id_rol where u.correo =:correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key => $rol) {
                array_push($roles, $rol['rol']);
            }
        }
        return $roles;
    }
    public function getPrivilegios($correo)
    {
        $privilegios = array();
        if ($this->validate_Email($correo)) {
            $this->db();
            $sql = 'SELECT p.privilegio from privilegio AS p 
            LEFT JOIN rol_privilegio AS rp on rp.id_privilegio = p.id_privilegio 
            LEFT JOIN rol AS r on r.id_rol = rp.id_rol 
            LEFT JOIN usuario_rol AS ur ON ur.id_rol = r.id_rol 
            LEFT JOIN usuario AS u ON u.id_usuario = ur.id_usuario 
            WHERE u.correo = :correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key => $privilegio) {
                array_push($privilegios, $privilegio['privilegio']);
            }
        }
        return $privilegios;
    }
    public function validateRol($rol)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado']) {
                if (isset($_SESSION['roles'])) {
                    if (!in_array($rol, $_SESSION['roles'])) {
                        $this->kill2('No tienes el rol adecuado');
                    }
                } else {
                    $this->kill2('No tienes roles asignados');
                }
            } else {
                $this->killApp('No estas validado');
            }
        } else {
            $this->killApp('No has iniciado sesión');
        }
    }
    public function validatePrivilegio($privilegio)
{
    if (isset($_SESSION['validado']) && $_SESSION['validado']) {
        if (isset($_SESSION['privilegios'])) {
            $privilegioEncontrado = false;
            foreach ($_SESSION['privilegios'] as $priv) {
                if ($priv === $privilegio) {
                    $privilegioEncontrado = true;
                    break;
                }
            }
            if (!$privilegioEncontrado) {
                $this->kill2('No tienes el privilegio adecuado');
            }
        } else {
            $this->kill2('No tienes privilegios asignados');
        }
    } else {
        $this->killApp('No estás validado');
    }
}

    public function verificarSesion()
    {
        if (!isset($_SESSION['validado']) || !$_SESSION['validado']) {
            $this->killApp('No has iniciado sesión');
        }
    }

    public function kill2($mensaje)
    {
        ob_end_clean();
        include("../views/header_error.php");
        $this->flash('danger', $mensaje);
        include("../views/footer_error.php");
        die();
    }

    public function killApp($mensaje)
    {
        ob_end_clean();
        include("../views/header_error.php");
        $this->flash('danger', $mensaje);
        include("../views/footer_error.php");
        $paginaDestino = "login.php";
        echo '<html><head><meta http-equiv="refresh" content="1; url=' . $paginaDestino . '"></head><body></body></html>';
        die();
    }
    public function logout()
    {
        session_unset();
        session_destroy();
    }

    public function generarToken($correo)
    {
        $token = "papaschicas";
        $n = rand(1, 1000000);
        $x = md5(md5($token));
        $y = md5($x . $n);
        $token = md5($y);
        $token = md5($token . 'calamardo');
        $token = md5('patricio') . md5($token . $correo);
        return $token;
    }

    public function loginSend($correo){
        $rc=0;
        if($this->validate_Email($correo)){
            $this->db();
            $sql = 'select correo from usuario 
            where correo = :correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            if(isset($data[0])){
                $token=$this->generarToken($correo);
                $sql2='update usuario set token = :token where correo = :correo';    
                $st2=$this->db->prepare($sql2);          
                $st2->bindParam(":token", $token, PDO::PARAM_STR);
                $st2->bindParam(":correo", $correo, PDO::PARAM_STR);
                $st2->execute();
                $rc = $st2->rowCount();          
                $this->forgot($correo,$token);
            }
        }
        return $rc;
    }

    public function validateToken($correo,$token){
        if(strlen($token)==64){
            if($this->validate_Email($correo)){
                $this->db();
                $sql = 'select correo from usuario 
                where correo = :correo and token = :token';
                $st = $this->db->prepare($sql);
                $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                $st->bindParam(":token", $token, PDO::PARAM_STR);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
                if(isset($data[0])){
                    return true;
                }
            }
        }
        return false;
    }

    public function resetPassword($correo, $token, $contrasena){
        $cantidad = 0;
        if(strlen($token)==64 and strlen($contrasena)>0){
            if($this->validate_Email($correo)){
                $contrasena = md5($contrasena);
                $this->db();
                $sql = 'UPDATE usuario set contrasena = :contrasena, token = null
                where correo = :correo and token = :token';
                $st = $this->db->prepare($sql);
                $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
                $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                $st->bindParam(":token", $token, PDO::PARAM_STR);
                $st->execute();

                $cantidad = $st->rowCount();                 
            }
        }
        return $cantidad;
    }

    public function forgot($destinatario,$token)
    {
        if ($this->validate_Email($destinatario)) {
            require '../../vendor/autoload.php';
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Username = 'mrjctienda@gmail.com';
            $mail->Password = 'zgqszxnbifectvpt';
            $mail->setFrom('mrjctienda@gmail.com', 'Renata Jimenez');
            $mail->addReplyTo('mrjctienda@gmail.com', 'Renata Jimenez');
            $mail->addAddress($destinatario, 'Sistema de la tienda');
            $mail->Subject = 'Recuperacion de password';
            $mensaje = " 
            Estimado usuario. <br>
            Presione <a href=\"http://localhost:3000/Tienda%20gamer/admin/routes/login.php?action=recovery&token=$token&correo=$destinatario\">aquí</a> para recuperar la contraseña. <br>
            Atentamente la tienda.
            ";
            $mail->msgHTML('Hola ' . $mensaje);
            if (!$mail->send()) {
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Message sent!';
            }
        }
    }
}
$sistema = new Sistema;
?>