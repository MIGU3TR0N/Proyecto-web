<br>
<h3 class="text-center">
    Roles del usuario: <?php echo $data[0]['correo']; ?>
    <a href="usuario.php?action=newrole&&id=<?php echo $data[0]['id_usuario']; ?>" class="btn btn-success"> Añadir rol</a>
</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-1">ID</th>
                        <th scope="col" class="col-md-12">Roles</th>
                        <th scope="col" class="col-md-1">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_rol as $key => $rol) : ?>
                        <tr>
                            <td scope="row"><?php echo $rol['id_rol']; ?></td>
                            <td scope="row"><?php echo $rol['rol']; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Menu Renglon">
                                    <a class="btn btn-success" href="usuario.php?action=privilege&id_rol=<?php echo $rol['id_rol']; ?>">Privilegios</a>
                                    <a class="btn btn-danger" href="usuario.php?action=deleterole&id=<?php echo $data['0']['id_usuario'] ?>&id_rol=<?php echo $rol['id_rol']; ?>">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <b>Total roles:</b> <?php echo sizeof($data_rol); ?>.
        </div>
        <div class="col-1"></div>
    </div>
</div>