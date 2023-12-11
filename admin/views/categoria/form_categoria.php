<h1 class="text-center">
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>categoria
</h1>
<form method="POST" action="categoria.php?action=<?php echo $action; ?>">

  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <label class="form-label">Nombre de la categoria</label>
    </div>
  </div>
  <div class="row">
    <div class="col-1"></div>
    <div class="col-4">
      <input type="text" name="data[categoria]" class="form-control" placeholder="Categoria" value="<?php echo isset($data[0]['categoria']) ? $data[0]['categoria'] : ''; ?>" required minlength="3" maxlength="50" />
    </div>
  </div>

  <div class="row">
    <p></p>
  </div>
  
  <div class="mb-3">
    <?php if ($action == 'edit') : ?>
      <input type="hidden" name="data[id_categoria]" value="<?php echo isset($data[0]['id_categoria']) ? $data[0]['id_categoria'] : ''; ?>">
    <?php endif; ?>
  </div>

  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
      <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
      <input type="submit" class="btn btn-primary btn-lg" name="enviar" value="Guardar">
    </div>
  </div>
</form>