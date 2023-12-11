<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/pago_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de pago.';
        if (!is_null($id)) {
            $contador = $pago->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'pago eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe el pago.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $pago->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'pago ingresado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $pago->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'pago actualizado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $pago->get();
    }else{
        $data = $pago->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>