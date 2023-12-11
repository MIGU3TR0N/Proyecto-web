<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/usuario_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de usuario.';
        if (!is_null($id)) {
            $contador = $usuario->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'Usuario eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe el usuario.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $usuario->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Usuario ingresado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $usuario->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'Usuario actualizado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $usuario->get();
    }else{
        $data = $usuario->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>