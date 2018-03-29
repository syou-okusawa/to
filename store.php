<?php
require('functions.php');
create($_POST);
checkReferer(); //こちらに変更します：追記
header('location: ./index.php'); // 追記