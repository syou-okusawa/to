<?php
require('connection.php');

function create($data) {
  insertDb($data['todo']);
}

function find() {
  return $todos = selectAll();
}

function checkReferer() {
  $httpArr = parse_url($_SERVER['HTTP_REFERER']);
  return $res = transition($httpArr['path']);
}

function transition($path) {
  $data = $_POST;
 if($path === '/new.php'){
    create($data);
  }elseif($path === '/edit.php'){
    update($data);
  }
}