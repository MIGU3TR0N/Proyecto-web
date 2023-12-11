<h1 class="text-center">
    Tiendas
    <a href="tienda.php?action=new" class="btn btn-success">Añadir tienda</a>
</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-1">Id</th>
                        <th scope="col" class="col-md-5">Tienda</th>
                        <th scope="col" class="col-md-5">Dirección</th>
                        <th scope="col" class="col-md-2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $tienda) :
                        $nReg++; ?>
                        <tr>
                            <th scope="row">
                                <?php echo $tienda["id_tienda"] ?>
                            </th>
                            <th scope="row">
                                <?php echo $tienda["tienda"] ?>
                            </th>
                            <th scope="row">
                                <?php echo $tienda["direccion"] ?>
                            </th>
                            <th>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="tienda.php?action=edit&id=<?php echo $tienda["id_tienda"] ?>" type="button" class="btn btn-primary">Modificar</a>
                                    <a href="tienda.php?action=delete&id=<?php echo $tienda["id_tienda"] ?>" type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <b>Total tiendas:</b> <?php echo $nReg ?>.
        </div>
        <div class="col-1"></div>
    </div>
</div>