<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/rol_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de rol.';
        if (!is_null($id)) {
            $contador = $rol->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'Rol eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe la rol.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $rol->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Rol ingresado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $rol->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Rol actualizado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $rol->get();
    }else{
        $data = $rol->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>