<h1 class="text-center"> Agregar producto de la venta</h1>
<form method="POST" action="index.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_venta']) ?>">
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-4">
            <label class="form-label">Producto</label>
            <select name="data[id_producto]" class="form-control" required>
                <?php
                foreach ($dataProductos as $key => $productos) :
                    $selected = "";
                    if ($productos['id_producto'] == $data[0]['id_producto']) :
                        $selected = " selected";
                    endif;
                ?>
                    <option value="<?php echo $productos['id_producto']; ?>" <?php echo $selected; ?>><?php echo $productos['producto']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <label for="cantidad">Cantidad:</label>
        </div>
    </div>


    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <input type="number" step="1" min="0" name="data[cantidad]" placeholder="Cantidad" class="form-control" value="<?php echo isset($data[0]['cantidad']) ? $data[0]['cantidad'] : ''; ?>" required />                    
        </div>
    </div>

    <div class="row">
        <p></p>
    </div>

    <div class="row">
        <div class="col-2">
            <input type="hidden" name="data[id_venta]" value="<?php echo ($data[0]['id_venta']) ?>">     
        </div>
    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
            <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
        </div>
    </div>
</form>