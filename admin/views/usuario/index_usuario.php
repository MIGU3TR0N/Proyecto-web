<div class="container-fluid">
    <h1 class="text-center">
        Usuarios
        <a href="usuario.php?action=new" class="btn btn-success">Añadir usuarios</a>
    </h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="col-md-1">Id</th>
                            <th scope="col" class="col-md-1">Usuario</th>
                            <th scope="col" class="col-md-1">Nombre</th>
                            <th scope="col" class="col-md-1">Correo</th>
                            <th scope="col" class="col-md-2">Dirección</th>
                            <th scope="col" class="col-md-1">Teléfono</th>
                            <th scope="col" class="col-md-1">Roles</th>
                            <th scope="col" class="col-md-1">Privilegios</th>
                            <th scope="col" class="col-md-3">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nReg = 0;
                        foreach ($data as $key => $usuario) :
                            $nReg++; ?>
                            <tr>
                                <td scope="row">
                                    <?php echo $usuario["id_usuario"] ?>
                                </td>
                                <td scope="row">
                                    <?php echo $usuario["usuario"] ?>
                                </td>
                                <td scope="row">
                                    <?php echo $usuario["nombre"] ?>
                                </td>
                                <td scope="row">
                                    <?php echo $usuario["correo"] ?>
                                </td>
                                <td scope="row">
                                    <?php echo $usuario["direccion"] ?>
                                </td>
                                <td scope="row">
                                    <?php echo $usuario["telefono"] ?>
                                </td>
                                <td scope="row">
                                    <?php echo $usuario["rol"] ?>
                                </td>
                                <td scope="row">
                                    <?php echo $usuario["privilegio"] ?>
                                </td>
                                <th>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-secondary" href="usuario.php?action=role&id=<?php echo $usuario['id_usuario'] ?>">Roles</a>
                                        <a href="usuario.php?action=edit&id=<?php echo $usuario["id_usuario"] ?>" type="button" class="btn btn-primary">Modificar</a>
                                        <a href="usuario.php?action=delete&id=<?php echo $usuario["id_usuario"] ?>" type="button" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <b>Total usuarios:</b> <?php echo $nReg ?>.
            </div>
            <div class="col-1"></div>
        </div>
    </div>