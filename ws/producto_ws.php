<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/producto_controller.php');
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id'])?$_GET['id']:null;
//Revisar el switch
switch ($action) {
    case 'DELETE':
        $data['mensaje'] = 'Ingrese el id de producto.';
        if (!is_null($id)) {
            $contador = $producto->delete($id);
            if ($contador == 1) {
                $data['mensaje'] = 'producto eliminado con éxito';
            }
            if ($contador == 0) {
                $data['mensaje'] = 'No existe el producto.';
            }
            echo($data['mensaje']); 
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $producto->new($data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'producto ingresado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }else{
            $cantidad = $producto->edit($id, $data);
            if ($cantidad!=0) {
                $data['mensaje'] = 'producto actualizado con éxito';
            }else{
                $data['mensaje'] = 'Ocurrió un error';
            }
        }
        break;
    case 'GET':
    default:
    if (is_null($id)) {
        $data = $producto->get();
    }else{
        $data = $producto->get($id);       
    }     
}
$data = json_encode(($data));
echo($data); 
?>