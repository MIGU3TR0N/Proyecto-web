    <h1 class="text-center">
        <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> Marca
    </h1>

    <form class="container-fluid" method="POST" action="marca.php?action=<?php echo ($action); ?>"
        enctype="multipart/form-data">   
        <div class="row ">
            <div class="col-1"></div>
            <div class="col-4">
                <label for="marca"><b>Marca</b></label>
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4">
                <input required="required" type="text" class="form-control" id="marca" name="data[marca]"
                    value="<?php echo isset($data[0]['marca']) ? $data[0]['marca'] : ''; ?>" minlength="5"
                    maxlength="50" placeholder="Marca">
            </div>
        </div>

        <div class="row"><p></p></div>
        
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4">
                <label for="id_proveedor"><b>Proveedor</b></label>
            </div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4">
                <select name="data[id_proveedor]" required="required" class="form-control">
                    <?php
                    $selected = " ";
                    foreach ($dataProveedores as $key => $tnd):
                        if ($tnd['id_proveedor'] == $data[0]['id_proveedor']):
                            $selected = "selected";
                        endif;
                        ?>
                        <option value="<?php echo $tnd['id_proveedor']; ?>" <?php echo $selected; ?>>
                            <?php echo $tnd['proveedor'] ?></option>
                        <?php $selected = " "; endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row"><p></p></div>

        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
                <input type="submit" class="btn btn-primary btn-lg" name="enviar" value="Guardar">
            </div>
        </div>

        <?
        if ($action == 'edit'): ?>
            <input type="hidden" name="data[id_marca]"
                value="<?php echo isset($data[0]['id_marca']) ? $data[0]['id_marca'] : ''; ?>" class="" />
        <? endif; ?>
    </form>