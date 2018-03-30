<?php
  require('functions.php');
  $res = checkReferer();

  header('location: ./index.php');