<?php
require_once('./../../index.php');
$encrypt=new Encrypt();

if($encrypt->isLogin())
  header("Location: ./index.php");

$hide="hidden";
if(isset($_POST['k']))
  $encrypt->login() || ($hide="");
require_once('./header-template.php');
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-md-offset-4">
      <form class="k" method="post">
        <div class="alert alert-danger <?php echo $hide; ?>" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          Código inválido.
        </div>
        <div id="k-img-cont" class="col-md-8 col-md-offset-2">
          <img src="./../img/candado.png" />
        </div>
        <div class="col-md-12"><hr /></div>
        <div class="form-group">
          <input type="password" name="k" class="form-control" id="k" placeholder="Ingresar">
        </div>
        <button type="submit" class="btn btn-1">Acceso</button>
      </form>
    </div>
  </div>
</div>
</div>
<?php require_once('./footer-template.php'); ?>