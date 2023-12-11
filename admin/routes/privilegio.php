<?php
require_once('../controllers/privilegio_controller.php');
include_once('../views/header.php');
include_once('../views/menu.php');

$privilegio -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
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
            $cantidad = $privilegio->new($data);
            if ($cantidad) {
                $privilegio->flash('success', "Registro dado de alta con éxito");
                $data = $privilegio->get();
                include('../views/privilegio/index_privilegio.php');
            } else {
                $privilegio->flash('danger', "Algo fallo");
                include('../views/privilegio/form_privilegio.php');
            }
        } else {
            include('../views/privilegio/form_privilegio.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_privilegio'];
            $cantidad = $privilegio->edit($id, $data);
            if ($cantidad) {
                $privilegio->flash('success', "Registro actualizado con éxito");
                $data = $privilegio->get();
                include('../views/privilegio/index_privilegio.php');
            } else {
                $privilegio->flash('warning', "Algo fallo o no hubo cambios");
                $data = $privilegio->get();
                include('../views/privilegio/index_privilegio.php');
            }
        } else {
            $data = $privilegio->get($id);
            include('../views/privilegio/form_privilegio.php');
        }
        break;
    case 'delete':
            $cantidad = $privilegio->delete($id);
            if ($cantidad) {
                $privilegio->flash('success', "Registro eliminado con exito");
                $data = $privilegio->get();
                include('../views/privilegio/index_privilegio.php');
            } else {
                $privilegio->flash('danger', "Algo fallo");
                $data = $privilegio->get();
                include('../views/privilegio/index_privilegio.php');
            }
        break;
    case 'get':
    default:
        $data = $privilegio->get($id);
        include("../views/privilegio/index_privilegio.php");
}
include_once('../views/footer.php');
?>