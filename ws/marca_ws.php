<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/marca_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de marca.';
        if (!is_null($id)) {
            $contador = $marca->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'Marca eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe la marca.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $marca->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Marca ingresada con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $marca->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Marca actualizado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $marca->get();
    }else{
        $data = $marca->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>