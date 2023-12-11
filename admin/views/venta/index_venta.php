<h1 class="text-center">
    Ventas
    <a class="btn btn-success" href="venta.php?action=new" role="button">Añadir venta</a>
</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col-md-2">ID</th>
                        <th scope="col-md-2">Tienda</th>
                        <th scope="col-md-2">Fecha</th>
                        <th scope="col-md-2">Empleado</th>
                        <th scope="col-md-2">Comprador</th>
                        <th scope="col-md-2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $venta) :
                        $nReg++; ?>
                        <tr>
                            <td>
                                <?php echo $venta["id_venta"] ?>
                            </td>
                            <td>
                                <?php echo $venta["fecha"] ?>
                            </td>
                            <td>
                                <?php echo $venta["tienda"] ?>
                            </td>
                            <td>
                                <?php echo $venta["empleado"] ?>
                            </td>

                            <td>
                                <?php echo $venta["nombre"] ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-success" href="venta.php?action=details&id=<?php echo $venta['id_venta'] ?>">Detalles</a>
                                    <a href="venta.php?action=edit&id=<?php echo $venta["id_venta"] ?>" type="button" class="btn btn-primary">Modificar</a>
                                    <a href="venta.php?action=delete&id=<?php echo $venta["id_venta"] ?>" type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <b>Total categorias:</b> <?php echo $nReg ?>.
        </div>
        <div class="col-1"></div>
    </div>
</div>