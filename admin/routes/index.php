<?php
require_once("../controllers/index_controller.php");
require_once("../controllers/usuario_controller.php");
require_once("../controllers/producto_controller.php");
require_once("../controllers/venta_controller.php");
include("../views/header.php");
include("../views/menu.php");

$index->verificarSesion();
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
        $dataProductos = $producto->get(null);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $cantidad = $index->new($data);
            if ($cantidad) {
                $index->flash('success', 'Venta dada de alta con éxito');
                //Obtener datos de la venta.
                $id_venta = $index->getLastID();
                $data = $index->get($id_venta);
                $data_producto = $venta->getDetails($id_venta);
                //Mostrar los detalles.
                include('../views/dashboard/index_detalles.php');
                //$data_producto = $venta->getDetails($id);
            } else {
                $index->flash('danger', 'Algo ha fallado');
                include('../views/dashboard/form_venta.php');
            }
        } else {
            include('../views/dashboard/form_venta.php');
        }
        break;
    case 'details':
        $lastID = $index->getLastID();
        $data = $venta->get($lastID);
        $data_producto = $venta->getDetails($lastID);
        include("../views/dashboard/form_detalles.php");
        break;
    case 'newdetails':
        $dataProductos = $venta->getAllDetails();
        $data = $index->get($id);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data2 = $_POST['data'];
            $cantidad = $index->newDetails($id, $data2);
            if ($cantidad) {
                $index->flash('success', "Producto dado de alta con éxito");
            } else {
                $index->flash('danger', "Algo ha fallado");
            }
            $data_producto = $venta->getDetails($id);
            include('../views/dashboard/index_detalles.php');
        } else {
            include("../views/dashboard/form_detalles.php");
        }
        break;
    case 'newpay':
        break;
    case 'deletedetails':
        $cantidad = $index->deleteDetails($id, $id_producto);
        if ($cantidad) {
            $index->flash('success', "Registro eliminado con éxito");
            $data = $index->get($id);
            $data_producto = $venta->getDetails($id);
            include('../views/dashboard/index_detalles.php');
        } else {
            $index->flash('danger', "Algo ha fallado");
            $data = $index->get($id);
            $data_producto = $venta->getDetails($id);
            include('../views/dashboard/index_detalles.php');
        }
        break;
    default:
        include("../views/dashboard/index_dashboard.php");
}
include("../views/footer.php");
?>