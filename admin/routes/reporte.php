<?php
require_once('../controllers/sistema.php');
require_once ('../../vendor/autoload.php');

use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new Html2Pdf();

$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$sistema->db();

switch($action):
    case 'detalle':
        $sql = "SELECT vd.id_venta, vd.id_producto, v.fecha, v.id_usuario, 
        u.nombre, v.fecha, v.id_tienda, t.tienda, t.direccion, p.producto,
        p.sku, p.precio AS precio_unitario, vd.cantidad, ue.nombre AS empleado,
        (vd.cantidad * p.precio) AS total
        FROM venta_detalle AS vd 
        LEFT JOIN venta AS v on v.id_venta = vd.id_venta 
        LEFT JOIN producto AS p ON p.id_producto = vd.id_producto 
        LEFT JOIN usuario AS u ON u.id_usuario = v.id_venta 
        LEFT JOIN tienda AS t ON t.id_tienda = v.id_tienda 
        LEFT JOIN empleado AS e ON e.id_empleado = v.id_empleado
        LEFT JOIN usuario AS ue ON ue.id_usuario = e.id_usuario
        WHERE vd.id_venta = :id";

        $st = $sistema->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        $html = "
        <h1>Detalles de la venta.</h1>
        <br>
        <b>Id venta: </b>".$data[0]['id_venta']."<br>
        <b>Fecha: </b>".$data[0]['fecha']."<br>
        <b>Empleado: </b>".$data[0]['empleado']."<br>
        <b>Tienda: </b>".$data[0]['tienda']."<br>
        <b>Dirección: </b>".$data[0]['direccion']."<br><br>
        <h3>Productos:</h3><br>
        <table>";
        
        $total = 0; // Variable para almacenar el total a pagar
        
        foreach($data as $key => $tarea):
            $html .= "
            <tr>
                <th><b>".$tarea['producto']."</b></th>
                <td><b>Precio: $</b>".$tarea['precio_unitario']."</td>
                <td><b>Cantidad: </b>".$tarea['cantidad']."</td>
            </tr> ";
            
            $total += $tarea['total']; // Sumar el total del producto al total general
        endforeach;
        
        $html .= "
        </table>
        <br>
        <b>Total a pagar: </b>$".$total."
        ";
        break;
    default:
        $html='<h1>Sin reporte</h1>No hay ningún reporte a generar';
endswitch;
$html2pdf->writeHTML($html);
$html2pdf->output();
