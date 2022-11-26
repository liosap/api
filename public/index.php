<?php

use App\Config\ErrorLog;
use App\Config\ResponseHttp;

require_once dirname(__DIR__).'/vendor/autoload.php';

//Activa el registro de errores
ErrorLog::activateErrorLog();

if (isset($_GET['route'])) {

  $name = explode('/', $_GET['route']);
  $file = dirname(__DIR__).'/src/Routes/'.$name[0].'.php';

  if (is_readable($file))
  {
    require_once $file;
  } else {
    echo json_encode(ResponseHttp::status400('La ruta no existe'));
    //Escribe el archivo php-error.log
    error_log('La ruta no existe');
  }

} else {
  echo json_encode(ResponseHttp::status404());
}