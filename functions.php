<?php
require('connection.php');

function create($data) {
  insertDb($data['todo']);
}

function update($data) {
  upDateDb($data['id'],$data['todo']);
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
  $data = $_POST;
  if($path === '/php/toDo/index.php' && $data['type'] === 'delete') {
    delete($data['id']);
    return 'index';
  }else if($path === '/php/toDo/new.php') {
     create($data);	
  }else if($path === '/php/toDo/edit.php') {
    update($data);
  }
}

function detail($id) {
  return $todoText=detailText($id);
}