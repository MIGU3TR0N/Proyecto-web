<div class="container-fluid">
    <h1 class="text-center">Roles
        <a href="rol.php?action=new" class="btn btn-success"> Añadir nuevo rol </a>
    </h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-md-1">id</th>
                    <th scope="col" class="col-md-9">Rol</th>
                    <th scope="col" class="col-md-2"> Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $rol) : ?>
                    <tr>
                        <th scope="row"><?php echo $rol['id_rol']; ?></th>
                        <td><?php echo $rol['rol']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Menu Renglon">
                                <a class="btn btn-primary" href="rol.php?action=edit&id=<?php echo $rol['id_rol'] ?>">Modificar</a>
                                <a class="btn btn-danger" href="rol.php?action=delete&id=<?php echo $rol['id_rol'] ?>">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <b>Total roles:</b> <?php echo sizeof($data); ?>.
        </div>
        <div class="col-1"></div>
    </div>
</div>