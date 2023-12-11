<h1 class="text-center"> Nueva categoria de
    <?php echo $data[0]['marca']; ?>
</h1>
<form method="POST" action="marca.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_marca']) ?>">
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-4">
            <label class="form-label"><b>Categoria</b></label>
        </div>
    </div>
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-4">
            <select name="data[id_categoria]" class="form-control" required>
                <?php
                foreach ($dataCategorias as $key => $categorias) :
                    $selected = "";
                    if ($categorias['id_categoria'] == $data[0]['id_categoria']) :
                        $selected = " selected";
                    endif;
                ?>
                    <option value="<?php echo $categorias['id_categoria']; ?>" <?php echo $selected; ?>><?php echo $categorias['categoria']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <input type="hidden" name="data[id_marca]" value="<?php echo ($data[0]['id_marca']) ?>">
    </div>

    <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
                <input type="submit" class="btn btn-primary btn-lg" name="enviar" value="Guardar">
            </div>
    </div> 
</form>