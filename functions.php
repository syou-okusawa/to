<?php
require('connection.php');

function create($data) {
  insertDb($data['todo']);
}

function update($data){
  upDateDb($data['id'],$data['todo']);
}

function find() {
  return $todos = selectAll();
}

function checkReferer() {
  $url = parse_url($_SERVER['HTTP_REFERER']);
  return $res = transition($url['path']);
}

function transition($path) {
  $data = $_POST;
 if($path === '/php/toDo/new.php'){
    create($data);
  }elseif($path === '/php/toDo/edit.php'){
    update($data);
  }
}

function detail($id){
	return $todoText=detailText($id);
}