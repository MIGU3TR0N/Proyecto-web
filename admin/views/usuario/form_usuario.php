<h1 class="text-center">
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Usuario
</h1>
<form method="POST" action="usuario.php?action=<?php echo $action; ?>">
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <label class="form-label">Usuario</label>
    </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <input type="text" name="data[usuario]" class="form-control" placeholder="Usuario"
      value="<?php echo isset($data[0]['usuario']) ? $data[0]['usuario'] : ''; ?>" required minlength="6" maxlength="50" />
    </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <label class="form-label">Nombre del usuario</label>
      </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
    <input type="text" name="data[nombre]" class="form-control" placeholder="Nombre"
      value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>" required minlength="3" maxlength="50" />
      </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <label class="form-label">Correo</label>
      </div>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <input type="email" name="data[correo]" class="form-control" placeholder="Correo"
      value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>" required minlength="7" maxlength="50" />
      </div>
  </div>
  <?php if ($action == 'new'): ?>
    <div class="row ">
      <div class="col-1"></div>
      <div class="col-4">
        <label class="form-label">Password</label>
      </div>
    </div>
    <div class="row ">
      <div class="col-1"></div>
      <div class="col-4">
        <input type="password" name="data[contrasena]" class="form-control" placeholder="Contraseña"
        value="<?php echo isset($data[0]['contrasena']) ? $data[0]['contrasena'] : ''; ?>" required minlength="7" maxlength="128" />
        </div>
    </div>
  <?php endif; ?>  
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
      value="<?php echo isset($data[0]['direccion']) ? $data[0]['direccion'] : ''; ?>" required minlength="7" maxlength="100" />
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
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_usuario]"
        value="<?php echo isset($data[0]['id_usuario']) ? $data[0]['id_usuario'] : ''; ?>">
    <?php endif; ?>
  </div>
  <div class="row ">
    <div class="col-1"></div>
    <div class="col-4">
      <div class="g-recaptcha mb-3" data-stitekey="6Le6EywpAAAAAFSpg4XKb_zcg8Uuo4nzOh4vSwOh" id="html_element"></div>
      <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
    </div>
  </div>
</form>