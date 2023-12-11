<?php
require_once("../controllers/usuario_controller.php");
include_once("../views/header.php");
include_once("../views/menu.php");

$usuario -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_rol = (isset($_GET['id_rol'])) ? $_GET['id_rol'] : null;
$id_privilegio = (isset($_GET['id_privilegio'])) ? $_GET['id_privilegio'] : null;

if(isset($_POST['g-recaptcha-response'])){
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secredkey='6Le6EywpAAAAAC0f37kW267SFLbjDIDjQ_4bE_8Y';

    $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secredkey&response=$captcha&remoteip=$ip");

    $atributos = json_decode($respuesta, TRUE);
}

switch ($action) {
    case 'new':
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $cantidad = $usuario->new($data);
            if ($cantidad) {
                $usuario->flash('success', 'Usuario dado de alta con éxito');
                $data = $usuario->get(null);
                include('../views/usuario/index_usuario.php');
            } else {
                $usuario->flash('danger', 'Algo fallo');
                include('../views/usuario/form_usuario.php');
            }
        } else {
            include('../views/usuario/form_usuario.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_usuario'];
            $cantidad = $usuario->edit($id, $data);
            if ($cantidad) {
                $usuario->flash('success', 'Usuario actualizado con éxito');
                $data = $usuario->get(null);
                include('../views/usuario/index_usuario.php');
            } else {
                $usuario->flash('danger', 'Algo fallo');
                $data = $usuario->get(null);
                include('../views/usuario/index_usuario.php');
            }
        } else {
            $data = $usuario->get($id);
            include('../views/usuario/form_usuario.php');
        }
        break;
    case 'delete':
        $cantidad = $usuario->delete($id);
        if ($cantidad) {
            $usuario->flash('success', 'Usuario con el id= ' . $id . ' eliminado con éxito');
            $data = $usuario->get(null);
            include('../views/usuario/index_usuario.php');
        } else {
            $usuario->flash('danger', 'Algo fallo');
            $data = $usuario->get(null);
            include('../views/usuario/index_usuario.php');
        }
        break;
    case 'role':
        $data = $usuario->get($id);
        $data_rol = $usuario->getRole($id);
        include("../views/usuario/index_rol.php");
        break;
    case 'deleterole':
        $cantidad = $usuario->deleteRole($id, $id_rol);
        if ($cantidad) {
            $usuario->flash('success', "Registro eliminado con exito");
            $data = $usuario->get($id);
            $data_rol = $usuario->getRole($id);
            include('../views/usuario/index_rol.php');
        } else {
            $usuario->flash('danger', "Algo fallo");
            $data = $usuario->get($id);
            $data_rol = $usuario->getRole($id);
            include('../views/usuario/index_rol.php');
        }
        break;
    case 'newrole':
        $dataroles = $usuario->getAllRoles();
        $data = $usuario->get($id);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data2 = $_POST['data'];
            $cantidad = $usuario->newRole($id, $data2);
            if ($cantidad) {
                $usuario->flash('success', "Rol dado de alta con éxito");
            } else {
                $usuario->flash('danger', "Algo fallo");
            }
            $data_rol = $usuario->getRole($id);
            include('../views/usuario/index_rol.php');
        } else {
            include("../views/usuario/form_rol.php");
        }
        break;
    case 'privilege':
        $data = $usuario->privilegeGetRole($id_rol);
        $data_privilege = $usuario->getPrivilege($id_rol);
        include("../views/usuario/index_privilegio.php");
        break;
    case 'newprivilege':
        $dataprivilegios = $usuario->getAllPrivileges();
        $data = $usuario->privilegeGetRole($id_rol);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data2 = $_POST['data'];
            $cantidad = $usuario->newPrivilege($id_rol, $data2);
            if ($cantidad) {
                $usuario->flash('success', "Privilegio dado de alta con éxito");
            } else {
                $usuario->flash('danger', "Algo fallo");
            }
            $data_privilege = $usuario->getPrivilege($id_rol);
            include('../views/usuario/index_privilegio.php');
        } else {
            include("../views/usuario/form_privilegio.php");
        }
        break;
    case 'deleteprivilege':
        $cantidad = $usuario->deletePrivilege($id_privilegio, $id_rol);
        if ($cantidad) {
            $usuario->flash('success', "Registro eliminado con exito");
            $data = $usuario->privilegeGetRole($id_rol);
            $data_privilege = $usuario->getPrivilege($id_rol);
            include('../views/usuario/index_privilegio.php');
        } else {
            $usuario->flash('danger', "Algo fallo");
            $data = $usuario->privilegeGetRole($id_rol);
            $data_privilege = $usuario->getPrivilege($id_rol);
            include('../views/usuario/index_privilegio.php');
        }
        break;
    case 'getAll':
    default:
        $data = $usuario->get(null);
        include("../views/usuario/index_usuario.php");
}
include("../views/footer.php");
?>