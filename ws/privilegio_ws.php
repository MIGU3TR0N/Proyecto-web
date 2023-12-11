<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/privilegio_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de privilegio.';
        if (!is_null($id)) {
            $contador = $privilegio->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'privilegio eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe el privilegio.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $privilegio->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'privilegio ingresado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $privilegio->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'privilegio actualizado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $privilegio->get();
    }else{
        $data = $privilegio->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>