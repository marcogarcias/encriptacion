<?php
session_start();
class Encrypt{
  /*
   * F=file
   * C=content
   * D=decrypt
   * E=encrypt
   * A=array
   */
  private $url;
  private $infoF;
  private $infoC;
  private $infoD;
  private $infoE;
  private $infoA;
  private $yekF;
  private $yekC;

  public function __construct($url=null, $infoF=null, $yekF=null){
    $this->url = $url ? $url : "./../docs/";
    $this->infoF = $infoF ? $infoF : "pms.mp3";
    $this->yekF= $yekF ? $yekF : "k";
    //$this->main();
  }

  public function main(){
    $this->readInfo();
    $this->readYek();
    $this->decryptInfo();
    $this->infoToArray();
  }

  private function readInfo(){
    $url = $this->url;
    $file = $this->infoF;
    $cont = $this->readF($url, $file);
    $this->infoC = $cont;
  }

  public function readYek($url=null, $yekFile=null){
    $url = $url ? $url : $this->url;
    $file = $yekFile ? $yekFile : $this->yekF;
    $cont = $this->readF($url, $file);
    $this->yekC = $cont;
  }

  private function writeInfo(){
    $url = $this->url;
    $file = $this->infoF;
    $cont = $this->infoE;
    //echo $cont;
    $this->writeF($url, $file, $cont);
  }

  private function encryptInfo(){
    $infoC = $this->infoC;
    $this->infoE = $this->encrypt($infoC);
  }

  private function decryptInfo(){
    $infoC = $this->infoC;
    $this->infoD = $this->decrypt($infoC);
  }

  private function readF($url=null, $file=null){
    $info = fopen($url.$file, "r");
    $cont="";
    while($line = fgets($info)){
      $cont.=trim($line, " ");
    }
    fclose($info);
    return $cont;
  }

  private function writeF($url=null, $file=null, $cont){
    $info = fopen($url.$file, "w");
    fwrite($info, $cont);
    fclose($info);
  }

  private function encrypt($info){
    $yek = $this->yekC;
    return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($yek), $info, MCRYPT_MODE_CBC, md5(md5($yek))));
  }

  private function decrypt($info){
    $yek = $this->yekC;
    return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($yek), base64_decode($info), MCRYPT_MODE_CBC, md5(md5($yek))), "\0");
  }

  private function infoToArray(){
    $this->infoA = explode("/*", $this->infoD);
  }

  private function arraytToInfo(){
    $this->infoD = implode("/*", $this->infoA);
  }

  public function submitData(){
    $act = $_POST['act'];
    $idx = $_POST['idx'];
    $txt = "\n\r".$_POST['txt'];
    switch ($act) {
      case 'new':
        die('en construccion...');
        break;
      case 'edit':
        $this->editData($idx, $txt);
        break;
      
      default:
        die('ocurrió algo inesperado...');
        break;
    }
    die('kokok');
  }

  private function editData($idx=null, $txt=null){
    $ty='';
    $msg='';
    if($idx>=0 && $txt){
      $this->infoA[$idx]=$txt;
      $this->arraytToInfo();
      $this->infoC=$this->infoD;
      $this->encryptInfo();
      $this->infoC=$this->infoE;
      $this->writeInfo();
      $ty='success';
      $msg='Se editó correctamente.';
    }else{
      $ty='error';
      $msg='Ocurrió un error al escribir los datos codificados.';
    }
    $_SESSION['toastr']=''.
      '<script>'.
          'Encrypt.launchToastr({"ty":"'.$ty.'", "msg":"'.$msg.'"});'.
      '</script>';
    header("Location: ./index.php");
  }
  /**
   * Acciones paea las secciones del menu de navegación [datos, cargar archivo, logout]
   * @return [type] [description]
   */
  public static function navActions(){
    switch (key($_POST)) {
      case 'data':
        $go='./index.php';
        break;
      case 'load':
        $go='./loadFile.php';
        break;
      case 'logout':
        self::logout();
        $go='./index.php';
        break;
      default:
        $go='./index.php';
        break;
    }
    header("Location: ".$go);
  } 
  /**
   * Comprueba si se ha iniciado sesión o no.
   * @return boolean [description]
   */
  public static function isLogin(){
    return (isset($_SESSION['login']) && $_SESSION['login']);
  }
  /**
   * Crea las variables de sesión
   * @return boolean [description]
   */
  public function login(){
    $this->readYek("./../docs/");
    $yek=$this->getYekC();
    $yek_=md5($_POST['k']);
    if($yek==$yek_){
      $_SESSION['login']=true;
      header("Location: ./index.php");
    }
    return false;
  }
  /**
   * Cierra la sesión creada
   * @return [type] [description]
   */
  public function logout(){
    $_SESSION['login']=false;
    $_SESSION['loginData']=false;
    unset($_SESSION['login'], $_SESSION['loginData']);
  }

  public function getInfo(){
    return $this->infoC;
  }

  public function setInfo($info){
    $this->infoC=$info;
  }

  public function getYekC(){
    return $this->yekC;
  }

  public function setYekC($yek){
    $this->yekC=$yek;
  }

  public function getInfoD(){
    return $this->infoD;
  }

  public function setInfoD($infoD){
    $this->infoD=$infoD;
  }

  public function getInfoA(){
    return $this->infoA;
  }

  public function setInfoA($infoA){
    $this->infoA=$infoA;
  }



  /*
   * para leer archivo desencryptado y encryptarlo/guardarlo
   */
  public function test(){
    $this->readInfo();
    $this->readYek();
    $this->encryptInfo();
    $this->infoC=$this->infoE;
    $this->writeInfo();
    //var_dump($this->url, $this->infoF, $this->infoC, $this->infoE, $this->yekC);
    //$this->infoToArray();
  }
}



//$test=new Encrypt('./src/docs/');
//$test->test();

$dir = $_SERVER['HTTP_HOST']."/encriptacion/";