<?php

include 'models/devsalsa.php';

$GLOBALS['option']='';

$optionPost = filter_input(INPUT_POST, 'option');

switch ($optionPost) {
  case 'signin':
    $data = array(
      'user'=>filter_input(INPUT_POST, 'user'),
      'pass'=>filter_input(INPUT_POST, 'pass')
    );

    $dbModel = new devsalsaModel();
    $dbModel->dbConnect();
    $iduser = $dbModel->get_user($data);
    $dbModel->dbDisconnect();
    error_log($iduser);
    if($iduser==0){
      $GLOBALS['option']='message';
      $GLOBALS['mensaje']='Usuario Invalido';
    }

    break;

  case 'register':
    $data = array(
      'user'=>filter_input(INPUT_POST, 'user'),
      'pass'=>filter_input(INPUT_POST, 'pass'),
      'name'=>filter_input(INPUT_POST, 'name')
    );

    $dbModel = new devsalsaModel();
    $dbModel->dbConnect();
    $iduser = $dbModel->insert_user($data);
    $dbModel->dbDisconnect();

    if($iduser>0){
      $GLOBALS['option']='message';
      $GLOBALS['mensaje']='Registro Exitoso';
    }
    break;

  case 'change':
    //
    break;

  default:
    error_log("post no valido:".$optionPost);
    break;
}



$template = file_get_contents("static/html/template.html");
if($GLOBALS['option']!='message'){
    $GLOBALS['option'] = filter_input(INPUT_GET, 'option');
}

switch ($GLOBALS['option']) {
  case 'signin':
    $page = file_get_contents("static/html/signin.html");
    break;

  case 'register':
    $page = file_get_contents("static/html/register.html");
    break;

  case 'change':
    $page = file_get_contents("static/html/change-password.html");
    break;

  case 'message':
      $page = $GLOBALS['mensaje'];
      break;

  default:
    $page = file_get_contents("static/html/inicio.html");
    break;
}

$html = str_replace("%%page%%", $page, $template);

echo $html;

 ?>
