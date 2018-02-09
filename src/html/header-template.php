<?php
if(isset($_POST['data']) || isset($_POST['load']) || isset($_POST['logout']))
  Encrypt::navActions();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Encriptación - by: max/mags</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="./../libs/toastr/toastr.css" rel="stylesheet"/>
  <link rel="stylesheet" href="./../css/styles.css?<?php echo time(); ?>">

  <script src="./../libs/jquery/jquery-3.3.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="./../libs/toastr/toastr.js"></script>
  <script src="./../js/script.js?<?php echo time(); ?>"></script>
</head>
<body>
<div class="col-md-12" id="header">
<?php if(isset($_SESSION['login'])): ?>
  <header>
    <form action="" method="post" id="frm-nav">
      <ul>
        <li>
          <button class="btn-nav" name="data">
            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Datos
          </button>
        </li>
        <li>
          <button class="btn-nav" name="load">
          <span class="glyphicon glyphicon-open" aria-hidden="true"></span> Cargar Archivo
          </button>
        </li>
        <ul class="pull-right">
          <li>
            <button class="btn-nav" name="logout">
              <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
            </button>
          </li>
        </ul>
      </ul>
    </form>
  </header>
<?php endif; ?>
</div>