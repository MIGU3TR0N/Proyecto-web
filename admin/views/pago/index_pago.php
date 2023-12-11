<h1 class="text-center">Pagos 
    <a class="btn btn-success" href="pago.php?action=new" role="button">Añadir pago</a>
</h1>
<div class="container-fluid">
    <div class="row">
    <div class="col-1"></div>
        <div class="col">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col-md-1">ID</th>
                        <th scope="col-md-2">Fecha</th>
                        <th scope="col-md-1">Monto</th>
                        <th scope="col-md-2">Empleado</th>
                        <th scope="col-md-2">Tienda</th>
                        <th scope="col-md-2">Dirección</th>
                        <th scope="col-md-2">Operación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $pago):
                        $nReg++; ?>
                        <tr>
                            <td>
                                <?php echo $pago["id_pago"] ?>
                            </td>
                            <td>
                                <?php echo $pago["fecha"] ?>
                            </td>
                            <td>
                                <?php echo $pago["monto"] ?>
                            </td>
                            <td>
                                <?php echo $pago["empleado"] ?>
                            </td>
                            <td>
                                <?php echo $pago["tienda"] ?>
                            </td>
                            <td>
                                <?php echo $pago["direccion"] ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="pago.php?action=edit&id=<?php echo $pago["id_pago"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="pago.php?action=delete&id=<?php echo $pago["id_pago"] ?>"
                                        type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>              
                </tbody>
            </table>
            <b>Total pagos:</b> <?php echo $nReg ?>.
        </div>
        <div class="col-1"></div>
    </div>
</div>