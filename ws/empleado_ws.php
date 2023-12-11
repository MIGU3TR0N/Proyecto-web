<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/empleado_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de empleado.';
        if (!is_null($id)) {
            $contador = $empleado->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'Empleado eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe el empleado.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            //$cantidad = $empleado->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Empleado ingresado con éxito';
            }else{
                $data['mensaje'] = 'No se puede insertar de manera temporal';
                //$data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $empleado->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Empleado actualizado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $empleado->get();
    }else{
        $data = $empleado->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>