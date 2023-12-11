<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/categoria_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de categoria.';
        if (!is_null($id)) {
            $contador = $categoria->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'Categoria eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe la categoria.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $categoria->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Categoria ingresada con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $categoria->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Categoria actualizada con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $categoria->get();
    }else{
        $data = $categoria->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>