<h1 class="text-center">
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> producto
</h1>

<form class="container-fluid" method="POST" action="producto.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row ">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="producto">Producto:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <input required="required" type="text" class="form-control" id="producto" name="data[producto]"
                value="<?php echo isset($data[0]['producto']) ? $data[0]['producto'] : ''; ?>" minlength="5"
                maxlength="50" placeholder="Nombre del producto">
        </div>
    </div>

    <div class="row">
    <div class="col-1"></div>
        <div class="col-4">
            <label for="precio">Precio:</label>
        </div>
    </div>
    
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <input type="number" step="0.5" min="0" name="data[precio]" placeholder="Precio" class="form-control" value="<?php echo isset($data[0]['precio']) ? $data[0]['precio'] : ''; ?>" required />
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="costo">Costo:</label>
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <input type="number" step="0.5" min="0" name="data[costo]" placeholder="Costo (Precio - 20%)" class="form-control" value="<?php echo isset($data[0]['costo']) ? $data[0]['costo'] : ''; ?>" required />
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="sku">Código de barras:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <input required="required" type="text" class="form-control" id="sku" name="data[sku]"
                value="<?php echo isset($data[0]['sku']) ? $data[0]['sku'] : ''; ?>" minlength="5"
                maxlength="50" placeholder="Código de barras">
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="unidades">Unidades:</label>
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <input type="number" step="1" min="0" name="data[unidades]" placeholder="Unidades" class="form-control" value="<?php echo isset($data[0]['unidades']) ? $data[0]['unidades'] : ''; ?>" required />
        </div>
    </div>
    
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="id_marca">Marca:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <select name="data[id_marca]" required="required" class="form-control">
                <?php
                $selected = " ";
                foreach ($dataMarcas as $key => $tnd):
                    if ($tnd['id_marca'] == $data[0]['id_marca']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $tnd['id_marca']; ?>" <?php echo $selected; ?>>
                        <?php echo $tnd['marca'] ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="id_categoria">Categoria:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <select name="data[id_categoria]" required="required" class="form-control">
                <?php
                $selected = " ";
                foreach ($dataCategorias as $key => $tnd):
                    if ($tnd['id_categoria'] == $data[0]['id_categoria']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $tnd['id_categoria']; ?>" <?php echo $selected; ?>>
                        <?php echo $tnd['categoria'] ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <p></p>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
            <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
        </div>
    </div>

    <?
    if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_producto]"
            value="<?php echo isset($data[0]['id_producto']) ? $data[0]['id_producto'] : ''; ?>" class="" />
    <? endif; ?>
</form>