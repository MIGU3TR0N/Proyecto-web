<h1 class="text-center">Marcas 
    <a class="btn btn-success" href="marca.php?action=new" 
    role="button">Añadir marca</a>
</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Proveedores</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Operación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nReg = 0;
                    foreach ($data as $key => $marca):
                        $nReg++; ?>
                        <tr>
                            <td>
                                <?php echo $marca["id_marca"] ?>
                            </td>
                            <td>
                                <?php echo $marca["marca"] ?>
                            </td>
                            <td>
                                <?php echo $marca["proveedor"] ?>
                            </td>
                            <td>
                                <?php echo $marca["telefono"] ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-secondary" href="marca.php?action=category&id=<?php echo $marca['id_marca'] ?>">Categorias</a>
                                    <a href="marca.php?action=edit&id=<?php echo $marca["id_marca"] ?>"
                                        type="button" class="btn btn-primary">Modificar</a>
                                    <a href="marca.php?action=delete&id=<?php echo $marca["id_marca"] ?>"
                                        type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <b>Total marcas: </b><?php echo $nReg ?>.
        </div>
        <div class="col-1"></div>
    </div>
</div>