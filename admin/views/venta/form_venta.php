<h1 class="text-center">
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> venta
</h1>

<form class="container-fluid" method="POST" action="venta.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="fecha">Fecha:</label>
        </div>
    </div>
    
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <input type="date" name="data[fecha]" class="form-control" value="<?php echo isset($data[0]['fecha']) ? $data[0]['fecha'] : ''; ?>" required />
        </div>        
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="id_usuario">Cliente:</label>
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
            <label for="id_empleado">Empleado:</label>
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <select name="data[id_empleado]" required="required" class="form-control">
                <?php
                $selected = " ";
                foreach ($dataEmpleados as $key => $tnd):
                    if ($tnd['id_empleado'] == $data[0]['id_empleado']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $tnd['id_empleado']; ?>" <?php echo $selected; ?>>
                        <?php echo $tnd['nombre'] ?></option>
                    <?php $selected = " "; endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        
    </div>

    <div class="row">
        <div class="col-1 mb-3">
        
        </div>
        <div class="col-4">
            <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
            <input type="submit" class="btn btn-primary mb-3" name="enviar" value="Guardar">
        </div>
    </div>

    <?
    if ($action == 'edit'): ?>
        <input type="hidden" name="data[id_venta]"
            value="<?php echo isset($data[0]['id_venta']) ? $data[0]['id_venta'] : ''; ?>" class="" />
    <? endif; ?>
</form>