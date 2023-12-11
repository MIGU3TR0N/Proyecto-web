<section class="vh-100">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6 text-black">
                <div class="px-5 ms-xl-4">
                    <br>
                    <span class="h1 fw-bold mb-0">Recuperar contraseña.</span>
                </div>
                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                    <form style="width: 23rem;" method="POST" action="login.php?action=send">
                        <div class="form-outline mb-4">
                            <input name='correo' type="email" id="form2Example18" class="form-control form-control-lg" />
                            <label class="form-label" for="form2Example18">Correo electrónico</label>
                        </div>
                        <div class="pt-1 mb-4">
                            <input type="submit" name="enviar" value="Recuperar contraseña" class="btn btn-primary btn-lg btn-block">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="../images/forgotpassword.jpg" alt="Forgot password image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>