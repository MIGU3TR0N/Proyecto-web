<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/venta_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de venta.';
        if (!is_null($id)) {
            $contador = $venta->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'Venta eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe la venta.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $venta->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Venta ingresada con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $venta->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Venta actualizada con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $venta->get();
    }else{
        $data = $venta->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>