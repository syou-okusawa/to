<?php

require('config.php');

function insertDb($data) {
  $dbh = connectPdo();
  $sql = 'INSERT INTO todos (todo) VALUES (:todo)';
  /*
    SQL実行準備
  */
  $pre = $dbh->prepare($sql);
  $pre->bindParam(':todo', $data, PDO::PARAM_STR);
  $pre->execute();
}

function upDateDb($id ,$data){
  $dbh = connectPdo();
  $sql = 'UPDATE todos set todo = :todo where id = :id AND deleted_at IS NULL';
  /*
    SQL実行準備
  */
  $pre = $dbh->prepare($sql);
  $pre->bindParam(':todo', $data, PDO::PARAM_STR);
  $pre->bindValue(':id', (int)$id, PDO::PARAM_STR);
  $pre->execute();
}

function selectAll() {
  $dbh = connectPdo();
  $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
  $todo = array();
  foreach($dbh->query($sql) as $row) {
    array_push($todo, $row);
  }
  return $todo;
}

function connectPdo() {
  try{
    return new PDO(DSN,DB_USER,DB_PASSWORD);
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}

function detailText($id){
  $dbh = connectPdo();
  $sql = 'SELECT todo FROM todos WHERE id = :id AND deleted_at IS NULL';
  /*
    SQL実行準備
  */
  $pre = $dbh->prepare($sql);
  $pre->execute(array(':id' => (int)$id));
  $data = $pre->fetch();
  return $data['todo'];

}