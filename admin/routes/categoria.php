<?php
require_once("../controllers/categoria_controller.php");
include_once("../views/header.php");
include_once("../views/menu.php");
$categoria -> validateRol('Administrador');
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
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
        //$categoria->validatePrivilegio('Categoria Crear');
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $cantidad = $categoria->new($data);
            if ($cantidad) {
                $categoria->flash('success', 'Categoria dada de alta con éxito');
                $data = $categoria->get(null);
                include('../views/categoria/index_categoria.php');
            } else {
                $categoria->flash('danger', 'Algo fallo');
                include('../views/categoria/form_categoria.php');
            }
        } else {
            include('../views/categoria/form_categoria.php');
        }
        break;
    case 'edit':
        //$categoria->validatePrivilegio('Categoria Editar');
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_categoria'];
            $cantidad = $categoria->edit($id, $data);
            if ($cantidad) {
                $categoria->flash('success', 'Categoria actualizada con éxito');
                $data = $categoria->get(null);
                include('../views/categoria/index_categoria.php');
            } else {
                $categoria->flash('danger', 'Algo fallo');
                $data = $categoria->get(null);
                include('../views/categoria/index_categoria.php');
            }
        } else {
            $data = $categoria->get($id);
            include('../views/categoria/form_categoria.php');
        }
        break;
    case 'delete':
        //$categoria->validatePrivilegio('Categoria Eliminar');
        $cantidad = $categoria->delete($id);
        if ($cantidad) {
            $categoria->flash('success', 'Categoria con el id= ' . $id . ' eliminado con éxito');
            $data = $categoria->get(null);
            include('../views/categoria/index_categoria.php');
        } else {
            $categoria->flash('danger', 'Algo fallo');
            $data = $categoria->get(null);
            include('../views/categoria/index_categoria.php');
        }
        break;
    case 'getAll':
    default:
        $categoria->validatePrivilegio('Categoria Leer');
        $data = $categoria->get(null);
        include("../views/categoria/index_categoria.php");
}
include("../views/footer.php");
?>