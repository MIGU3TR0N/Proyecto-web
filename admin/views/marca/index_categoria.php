<h1 class="text-center"> Categorias de
    <?php echo $data[0]['marca']; ?>. 
    <a href="marca.php?action=newcategory&&id=<?php echo $data[0]['id_marca'];?>" 
    class="btn btn-success"> Añadir categoria</a>
</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">    
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-12">Categoria</th>
                        <th scope="col" class="col-md-3">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_category as $key => $categoria) : ?>
                        <tr>
                            <th scope="row"><?php echo $categoria['categoria']; ?></th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Menu Renglon">
                                    <a class="btn btn-danger" href="marca.php?action=deletecategory&id=<?php echo $data['0']['id_marca'] ?>&id_categoria=<?php echo $categoria['id_categoria']; ?>">Eliminar</a>                                
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>        
        <b>Total categorias:</b> <?php echo sizeof($data_category); ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>