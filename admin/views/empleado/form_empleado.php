<h1 class="text-center">
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> empleado
</h1>

<form class="container-fluid" method="POST" action="empleado.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row">
        <p></p>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="id_tienda">Tienda:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <select name="data[id_tienda]" required="required" class="form-control">
                <?php
                $selected = " ";
                foreach ($dataTiendas as $key => $tnd):
                    if ($tnd['id_tienda'] == $data[0]['id_tienda']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $tnd['id_tienda']; ?>" <?php echo $selected; ?>>
                        <?php echo $tnd['tienda'] ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="id_usuario">Usuario:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <select name="data[id_usuario]" required="required" class="form-control">
                <?php
                $selected = " ";
                foreach ($dataUsuarios as $key => $tnd):
                    if ($tnd['id_usuario'] == $data[0]['id_usuario']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $tnd['id_usuario']; ?>" <?php echo $selected; ?>>
                        <?php echo $tnd['nombre'] ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <p></p>
    </div>


    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
            <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
        </div>
    </div>

    <?
    if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_empleado]"
            value="<?php echo isset($data[0]['id_empleado']) ? $data[0]['id_empleado'] : ''; ?>" class="" />
    <? endif; ?>
</form>