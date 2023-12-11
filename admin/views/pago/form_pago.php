<h1 class="text-center">
    <?php echo ($action == 'edit') ? 'Modificar' : 'Nuevo'; ?> pago
</h1>

<form class="container-fluid" method="POST" action="pago.php?action=<?php echo ($action); ?>"
    enctype="multipart/form-data">

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="id_venta">Fecha:</label>
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
            <label for="id_venta">Monto:</label>
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <input type="number" step="0.5" min="0" name="data[monto]" placeholder="Monto" class="form-control" value="<?php echo isset($data[0]['monto']) ? $data[0]['monto'] : ''; ?>" required />
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="id_venta">Venta:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <select name="data[id_venta]" required="required" class="form-control">
                <?php
                $selected = " ";
                foreach ($dataVentas as $key => $tnd):
                    if ($tnd['id_venta'] == $data[0]['id_venta']):
                        $selected = "selected";
                    endif;
                    ?>
                    <option value="<?php echo $tnd['id_venta']; ?>" <?php echo $selected; ?>>
                        <?php echo $tnd['id_venta'] ?></option>
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
        <input type="hidden" name="data[id_marca]"
            value="<?php echo isset($data[0]['id_marca']) ? $data[0]['id_marca'] : ''; ?>" class="" />
    <? endif; ?>
</form>