<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/tienda_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de tienda.';
        if (!is_null($id)) {
            $contador = $tienda->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'Tienda eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe la tienda.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $tienda->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Tienda ingresada con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $tienda->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Tienda actualizada con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $tienda->get();
    }else{
        $data = $tienda->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>