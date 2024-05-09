<?php
  declare(strict_types = 1);

  //require_once('../database/connection.db.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/payment.tpl.php');

  //$db = getDatabaseConnection();
  $name = 'Pagamento';

  $method = $_GET['payment_method'];

  session_start();
  $_SESSION
  drawHead($name);
  drawHeader();
  if($method === 'paypal'){
    drawPaypal();
  }
  else if($method === 'card'){
    drawCredit();
  }
  else if($method === 'mbway'){
    drawMB();
  }
  drawFooter();
?>