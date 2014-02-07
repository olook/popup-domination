<?php

if(strstr($_POST['email'],'@')) {

  $postdata = http_build_query(
      array(
          'email' => $_POST['email']
      )
  );

  $opts = array('http' =>
      array(
          'method'  => 'POST',
          'header'  => 'Content-type: application/x-www-form-urlencoded',
          'content' => $postdata
      )
  );

  $popdom = new PopUp_Domination_Front();

  $context  = stream_context_create($opts);

  $result = file_get_contents($popdom->option('action'), false, $context);
  echo $result;

}

?>