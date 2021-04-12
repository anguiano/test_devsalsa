<?php

$template = file_get_contents("static/html/template.html");

$option = "";

foreach ($_GET as $key=>$value) {
  $option = $key;
}


switch ($option) {
  case 'signin':
    $page = "iniciar sesion";
    break;

  case 'register':
    $page = "registrar";
    break;

  default:
    $page = file_get_contents("static/html/inicio.html");
    break;
}

$html = str_replace("%%page%%", $page, $template);

echo $html;

 ?>
