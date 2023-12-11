<?php
require_once("../controllers/empleado_controller.php");
require_once("../controllers/tienda_controller.php");
require_once("../controllers/usuario_controller.php");
include_once("../views/header.php");
include_once("../views/menu.php");

$empleado -> validateRol('Administrador');
$action = (isset($_GET["action"])) ? $_GET["action"] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

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
        $dataUsuarios = $usuario->get(null);
        $dataTiendas = $tienda->get(null);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $cantidad = $empleado->new($data);
            if ($cantidad) {
                $empleado->flash('success', 'Empleado dado de alta con éxito');
                $data = $empleado->get(null);
                include('../views/empleado/index_empleado.php');
            } else {
                $empleado->flash('danger', 'Algo fallo');
                include('../views/empleado/form_empleado.php');
            }
        } else {
            include('../views/empleado/form_empleado.php');
        }
        break;
    case 'delete':
        $cantidad = $empleado->delete($id);
        if ($cantidad) {

            $empleado->flash('success', 'Empleado con el id= ' . $id . ' eliminado con éxito');
            $data = $empleado->get(null);
            include('../views/empleado/index_empleado.php');
        } else {
            $empleado->flash('danger', 'Algo fallo');
            $data = $empleado->get(null);
            include('../views/empleado/index_empleado.php');
        }
        break;
    case 'edit':
        $dataUsuarios = $usuario->get(null);
        $dataTiendas = $tienda->get(null);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_empleado'];
            $cantidad = $empleado->edit($id, $data);
            if ($cantidad) {
                $empleado->flash('success', 'Empleado actualizado con éxito');
                $data = $empleado->get(null);
                include('../views/empleado/index_empleado.php');
            } else {
                $empleado->flash('danger', 'Algo fallo');
                $data = $empleado->get(null);
                include('../views/empleado/index_empleado.php');
            }
        } else {
            $data = $empleado->get($id);
            include('../views/empleado/form_empleado.php');
        }
        break;
    case 'getAll':
    default:
        $data = $empleado->get(null);
        include("../views/empleado/index_empleado.php");
}
include("../views/footer.php");
