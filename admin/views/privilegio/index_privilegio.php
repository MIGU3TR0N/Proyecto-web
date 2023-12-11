<div class="container-fluid">
    <h1 class="text-center">Privilegios
        <a href="privilegio.php?action=new" class="btn btn-success"> Añadir privilegio </a>
    </h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="col-md-1">id</th>
                    <th scope="col" class="col-md-8">Privilegio</th>
                    <th scope="col" class="col-md-3"> Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $privilegio) : ?>
                    <tr>
                        <th scope="row"><?php echo $privilegio['id_privilegio']; ?></th>
                        <td><?php echo $privilegio['privilegio']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Menu Renglon">
                                <a class="btn btn-primary" href="privilegio.php?action=edit&id=<?php echo $privilegio['id_privilegio'] ?>">Modificar</a>
                                <a class="btn btn-danger" href="privilegio.php?action=delete&id=<?php echo $privilegio['id_privilegio'] ?>">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <b>Total privilegios:</b> <?php echo sizeof($data); ?>.
        </div>
        <div class="col-1"></div>
    </div>
</div>