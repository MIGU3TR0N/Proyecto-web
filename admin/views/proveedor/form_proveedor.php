<h1 class="text-center">
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>proveedor
</h1>
<form method="POST" action="proveedor.php?action=<?php echo $action; ?>">
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <label class="form-label">Nombre del proveedor</label>
    </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <input type="text" name="data[proveedor]" class="form-control" placeholder="Proveedor"
      value="<?php echo isset($data[0]['proveedor']) ? $data[0]['proveedor'] : ''; ?>" required minlength="3" maxlength="50" />
      </div>
  </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <label class="form-label">Teléfono</label>
      </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <input type="number" name="data[telefono]" class="form-control" placeholder="Telefono"
      value="<?php echo isset($data[0]['telefono']) ? $data[0]['telefono'] : ''; ?>" required minlength="7" maxlength="11" />
    </div>
  </div>

  <div class="row">
    <p></p>
  </div>

  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_proveedor]"
      value="<?php echo isset($data[0]['id_proveedor']) ? $data[0]['id_proveedor'] : ''; ?>">
      <?php endif; ?>
      <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
      <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
  </div>
</form>