<?php
include("../controllers/sistema.php");
include("../views/header.php");
$action = (isset($_GET['action'])) ? $_GET['action'] : 'login';
switch ($action) {
    case 'logout':
        $sistema ->logout();
        include("../views/login/index.php");
        break;
    case 'login':
        default:
        if(isset($_POST['enviar'])){
            $data = $_POST;
            if($sistema ->login($data['correo'],$data['contrasena'])){
                $sistema->flash('success', "Ingresando espere un momento");
                $paginaDestino = "index.php";
                echo '<html><head><meta http-equiv="refresh" content="1; url=' . $paginaDestino . '"></head><body></body></html>';
            }else{
                $sistema->flash('danger', "El usuario no existe o los datos son incorrectos.");
            }
        }
        include("../views/login/index.php");
        break;
}
include("../views/footer.php");
?>