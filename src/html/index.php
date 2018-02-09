<?php
require_once('./../../index.php');
$encrypt=new Encrypt();
if(!$encrypt->isLogin()){
  header("Location: ./login.php");
}else{
  $encrypt->main();
  //var_dump($encrypt->getInfoA());
  //die();
  if(isset($_POST['act']) && isset($_POST['idx']) && isset($_POST['txt'])){
    $encrypt->submitData();
    die();
  }

if(isset($_SESSION['toastr'])){
  echo $_SESSION['toastr'];
  unset($_SESSION['toastr']);
  $_SESSION['toastr']='';
}
require_once('./header-template.php');
?>
<div class="container-fluid">
  <div class="row">
    <article>
      <section>
        <div class="col-md-5 col-md-offset-4">
        <?php
        foreach ($encrypt->getInfoA() as $k => $v){ ?>
          <div class="box">
            <?php 
            echo '<div id="txt-'.$k.'">'.str_replace(array("\n"), "<br />", $v).'</div>';
            $n='{"act":"new", "idx":"'.$k.'"}';
            $e='{"act":"edit", "idx":"'.$k.'"}';
            $d='{"act":"delete", "idx":"'.$k.'"}';
            ?>
            <div class="box-foot">
              <ul>
                <li>
                  <button class="btn btn-wh btn-crud" data-action='<?php echo $n; ?>' data-toggle="modal" data-target="#modalWindow">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
                  </button>
                </li>
                <li>
                  <button class="btn btn-wh btn-crud" data-action='<?php echo $e; ?>' data-toggle="modal" data-target="#modalWindow">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Editar
                  </button>
                </li>
                <li>
                  <button class="btn btn-wh btn-crud" data-action='<?php echo $d; ?>' data-toggle="modal" data-target="#modalWindow">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Eliminar
                  </button>
                </li>
              </ul>
            </div>
          </div>
        <?php } ?>
        </div>
      </section>
    </article>
  </div>
</div>
<?php require_once('./footer-template.php'); 
} // fin else
?>