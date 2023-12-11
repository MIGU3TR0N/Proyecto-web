<h1 class="text-center"> <?php echo ($action == 'editrole') ? 'Modificar ' : 'Nuevo ' ?> rol del usuario:
    <?php echo $data[0]['correo']; ?></h1>
<form method="POST" action="usuario.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_usuario']) ?>">
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-4">
            <label class="form-label">Rol</label>
        </div>
    </div>

    <div class="row ">
        <div class="col-1"></div>
        <div class="col-4">
            <select name="data[id_rol]" class="form-control" required>
                <?php
                foreach ($dataroles as $key => $roles) :
                    $selected = "";
                    if ($roles['id_rol'] == $data[0]['id_rol']) :
                        $selected = " selected";
                    endif;
                ?>
                    <option value="<?php echo $roles['id_rol']; ?>" <?php echo $selected; ?>><?php echo $roles['rol']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <input type="hidden" name="data[id_usuario]" value="<?php echo ($data[0]['id_usuario']) ?>">
    </div>

    <div class="row ">
        <div class="col-1"></div>
        <div class="col-4">
            <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
            <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
        </div>
    </div>
</form>