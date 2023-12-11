<h1 class="text-center">
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Tienda
</h1>
<form method="POST" action="tienda.php?action=<?php echo $action; ?>">
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <label class="form-label">Nombre de la tienda</label>
    </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <input type="text" name="data[tienda]" class="form-control" placeholder="tienda"
      value="<?php echo isset($data[0]['tienda']) ? $data[0]['tienda'] : ''; ?>" required minlength="3" maxlength="50" />
      </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <label class="form-label">Dirección</label>
      </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <input type="text" name="data[direccion]" class="form-control" placeholder="Dirección"
      value="<?php echo isset($data[0]['direccion']) ? $data[0]['direccion'] : ''; ?>" required minlength="5" maxlength="100" />
    </div>
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_tienda]"
        value="<?php echo isset($data[0]['id_tienda']) ? $data[0]['id_tienda'] : ''; ?>">
    <?php endif; ?>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <p></p>
    </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
      <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
  </div>
</form>