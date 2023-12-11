<?php
require_once("../controllers/venta_controller.php");
require_once("../controllers/usuario_controller.php");
require_once("../controllers/tienda_controller.php");
require_once("../controllers/empleado_controller.php");
include_once("../views/header.php");
include_once("../views/menu.php");

$venta -> validateRol('Administrador');
$action = (isset($_GET["action"])) ? $_GET["action"] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_producto = (isset($_GET['id_producto'])) ? $_GET['id_producto'] : null;

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
        $dataEmpleados = $empleado->get(null);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $cantidad = $venta->new($data);
            if ($cantidad) {
                $venta->flash('success', 'Venta dada de alta con éxito');
                $data = $venta->get(null);
                include('../views/venta/index_venta.php');
            } else {
                $venta->flash('danger', 'Algo fallo');
                include('../views/venta/form_venta.php');
            }
        } else {
            include('../views/venta/form_venta.php');
        }
        break;
    case 'delete':
        $cantidad = $venta->delete($id);
        if ($cantidad) {

            $venta->flash('success', 'Venta con el id= ' . $id . ' eliminado con éxito');
            $data = $venta->get(null);
            include('../views/venta/index_venta.php');
        } else {
            $venta->flash('danger', 'Algo fallo');
            $data = $venta->get(null);
            include('../views/venta/index_venta.php');
        }
        break;
    case 'edit':
        $dataUsuarios = $usuario->get(null);
        $dataTiendas = $tienda->get(null);
        $dataEmpleados = $empleado->get(null);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_venta'];
            $cantidad = $venta->edit($id, $data);
            if ($cantidad) {
                $venta->flash('success', 'Venta actualizada con éxito');
                $data = $venta->get(null);
                include('../views/venta/index_venta.php');
            } else {
                $venta->flash('danger', 'Algo fallo');
                $data = $venta->get(null);
                include('../views/venta/index_venta.php');
            }
        } else {
            $data = $venta->get($id);
            include('../views/venta/form_venta.php');
        }
        break;
    case 'details':
        $data = $venta->get($id);
        $data_producto = $venta->getDetails($id);
        include("../views/venta/index_detalles.php");
        break;
    case 'deletedetails':
        $cantidad = $venta->deleteDetails($id, $id_producto);
        if ($cantidad) {
            $venta->flash('success', "Registro eliminado con exito");
            $data = $venta->get($id);
            $data_producto = $venta->getDetails($id);
            include('../views/venta/index_detalles.php');
        } else {
            $venta->flash('danger', "Algo fallo");
            $data = $venta->get($id);
            $data_producto = $venta->getDetails($id);
            include('../views/venta/index_detalles.php');
        }
        break;
    case 'newdetails':
        $dataProductos = $venta->getAllDetails();
        $data = $venta->get($id);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data2 = $_POST['data'];
            $cantidad = $venta->newDetails($id, $data2);
            if ($cantidad) {
                $venta->flash('success', "Producto dado de alta con éxito");
            } else {
                $venta->flash('danger', "Algo fallo");
            }
            $data_producto = $venta->getDetails($id);
            include('../views/venta/index_detalles.php');
        } else {
            include("../views/venta/form_detalles.php");
        }
        break;
    case 'getAll':
    default:
        $data = $venta->get(null);
        include("../views/venta/index_venta.php");
}
include("../views/footer.php");
