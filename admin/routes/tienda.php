<?php
require_once("../controllers/tienda_controller.php");
include_once("../views/header.php");
include_once("../views/menu.php");

$tienda -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
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
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $cantidad = $tienda->new($data);
            if ($cantidad) {
                $tienda->flash('success', 'Tienda dada de alta con éxito');
                $data = $tienda->get(null);
                include('../views/tienda/index_tienda.php');
            } else {
                $tienda->flash('danger', 'Algo fallo');
                include('../views/tienda/form_tienda.php');
            }
        } else {
            include('../views/tienda/form_tienda.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_tienda'];
            $cantidad = $tienda->edit($id, $data);
            if ($cantidad) {
                $tienda->flash('success', 'Tienda actualizada con éxito');
                $data = $tienda->get(null);
                include('../views/tienda/index_tienda.php');
            } else {
                $tienda->flash('danger', 'Algo fallo');
                $data = $tienda->get(null);
                include('../views/tienda/index_tienda.php');
            }
        } else {
            $data = $tienda->get($id);
            include('../views/tienda/form_tienda.php');
        }
        break;
    case 'delete':
        $cantidad = $tienda->delete($id);
        if ($cantidad) {
            $tienda->flash('success', 'Tienda con el id= ' . $id . ' eliminada con éxito');
            $data = $tienda->get(null);
            include('../views/tienda/index_tienda.php');
        } else {
            $tienda->flash('danger', 'Algo ha fallado');
            $data = $tienda->get(null);
            include('../views/tienda/index_tienda.php');
        }
        break;
    case 'getAll':
    default:
        $data = $tienda->get(null);
        include("../views/tienda/index_tienda.php");
}
include("../views/footer.php");
?>