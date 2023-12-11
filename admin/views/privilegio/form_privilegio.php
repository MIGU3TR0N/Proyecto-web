<h1 class="text-center">
    <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>privilegio
</h1>
<form method="POST" action="privilegio.php?action=<?php echo $action; ?>">
    <div class="row ">
        <div class="col-1"></div>
            <div class="col-4">
                <label class="form-label">Nombre del privilegio</label>
                <input type="text" name="data[privilegio]" class="form-control" placeholder="Privilegio" value="<?php echo isset($data[0]['privilegio']) ? $data[0]['privilegio'] : ''; ?>" required minlength="3" maxlength="50" />
            </div>
        </div>
    </div>
    <div class="row">
        <p></p>
    </div>
    <div class="row ">
        <div class="col-1"></div>
            <div class="col-4">
                <?php if ($action == 'edit') : ?>
                    <input type="hidden" name="data[id_privilegio]" value="<?php echo isset($data[0]['id_privilegio']) ? $data[0]['id_privilegio'] : ''; ?>">
                <?php endif; ?>
                <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
                <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
            </div>
        </div>
    </div>
</form>