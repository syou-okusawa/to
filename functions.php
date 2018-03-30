<?php
require('connection.php');
session_start();

function newTodo($data) {
  if(checkToken($data['token'])) {
    insertDb($data['todo']);
  }
}

function update($data) {
  if(checkToken($data['token'])) {
    upDateDb($data['id'],$data['todo']);
  }
}

function delete($data) {
  deleteAt($data);
}

function find() {
  return $todos = selectAll();
}

function checkReferer() {
  $url = parse_url($_SERVER['HTTP_REFERER']);/* url確認 */
  return $res = transition($url['path']);
}

function transition($path) {
  unsetSession();
  $data = $_POST;
  if(isset($data['todo'])) $res = validate($data['todo']);
  if($path === '/php/toDo/index.php' && $data['type'] === 'delete') {
    delete($data['id']);
    return 'index';
  }else if(!$res || !empty($_SESSION['err'])) {
    return 'back';
  }else if($path === '/php/toDo/new.php') {
     newTodo($data);	
  }else if($path === '/php/toDo/edit.php') {
    update($data);
  }
}

function detail($id) {
  return $todoText=detailText($id);
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function unsetSession() {
  if(!empty($_SESSION['err'])) $_SESSION['err'] = '';
}

function setToken() {
  $key = hash_hmac('sha256', uniqid(mt_rand(),true), false); 
  $_SESSION['token'] = $key;
}

function checkToken($data) {
  if (empty($_SESSION['token']) || ($_SESSION['token'] != $data)){
    $_SESSION['err'] = '不正な操作です';
    header('location: '.$_SERVER['HTTP_REFERER'].'');
    exit();
  }
  return true;
}

function validate($data) {
  return $res = $data != "" ? true : $_SESSION['err'] = '入力してください'; 
}



