<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/marca_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
$id_categoria = (isset($_GET['id_categoria'])) ? $_GET['id_categoria'] : null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de marca y categoria.';
        if (!is_null($id)) {
            $contador = $marca->deleteCategory($id, $id_categoria);
            if ($contador == 1) {
                $data['mensaje'] = 'Marca categoria eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe la marca categoria.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        
        if (is_null($id)) {
            $cantidad = $marca->newCategory($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Marca categoria ingresada con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $marca->getCategory($id);
    }else{
        $data = $marca->getCategory($id);     
    }     
}
$data = json_encode(($data));
echo($data); 
?>