<?php
require_once("../controllers/marca_controller.php");
require_once("../controllers/proveedor_controller.php");
include_once("../views/header.php");
include_once("../views/menu.php");

$marca -> validateRol('Administrador');
$action = (isset($_GET["action"])) ? $_GET["action"] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_categoria = (isset($_GET['id_categoria'])) ? $_GET['id_categoria'] : null;

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
        $dataProveedores = $proveedor->get(null);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $cantidad = $marca->new($data);
            if ($cantidad) {
                $marca->flash('success', 'Marca dada de alta con éxito');
                $data = $marca->get(null);
                include('../views/marca/index_marca.php');
            } else {
                $marca->flash('danger', 'Algo fallo');
                include('../views/marca/form_marca.php');
            }
        } else {
            include('../views/marca/form_marca.php');
        }
        break;
    case 'delete':
        $cantidad = $marca->delete($id);
        if ($cantidad) {

            $marca->flash('success', 'Marca con el id= ' . $id . ' eliminado con éxito');
            $data = $marca->get(null);
            include('../views/marca/index_marca.php');
        } else {
            $marca->flash('danger', 'Algo fallo');
            $data = $marca->get(null);
            include('../views/marca/index_marca.php');
        }
        break;
    case 'edit':
        $dataProveedores = $proveedor->get(null);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_marca'];
            $cantidad = $marca->edit($id, $data);
            if ($cantidad) {
                $marca->flash('success', 'Marca actualizada con éxito');
                $data = $marca->get(null);
                include('../views/marca/index_marca.php');
            } else {
                $marca->flash('danger', 'Algo fallo');
                $data = $marca->get(null);
                include('../views/marca/index_marca.php');
            }
        } else {
            $data = $marca->get($id);
            include('../views/marca/form_marca.php');
        }
        break;
    case 'category':
        $data = $marca->get($id);
        $data_category = $marca->getCategory($id);
        include("../views/marca/index_categoria.php");
        break;
    case 'deletecategory':
        $cantidad = $marca->deleteCategory($id, $id_categoria);
        if ($cantidad) {
            $marca->flash('success', "Registro eliminado con exito");
            $data = $marca->get($id);
            $data_category = $marca->getCategory($id);
            include('../views/marca/index_categoria.php');
        } else {
            $marca->flash('danger', "Algo fallo");
            $data = $marca->get($id);
            $data_category = $marca->getCategory($id);
            include('../views/marca/index_categoria.php');
        }
        break;
    case 'newcategory':
        $dataCategorias = $marca->getAllCategories();
        $data = $marca->get($id);
        if (isset($_POST['enviar']) && $atributos['success']) {
            $data2 = $_POST['data'];
            $cantidad = $marca->newCategory($id, $data2);
            if ($cantidad) {
                $marca->flash('success', "Categoria dada de alta con éxito");
            } else {
                $marca->flash('danger', "Algo fallo");
            }
            $data_category = $marca->getCategory($id);
            include('../views/marca/index_categoria.php');
        } else {
            include("../views/marca/form_categoria.php");
        }
        break;
    case 'getAll':
    default:
        $data = $marca->get(null);
        include("../views/marca/index_marca.php");
}
include("../views/footer.php");
