<?php
  require('functions.php');
  unsetSession();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>TODO</title>
</head>
<body>
  簡易アプリケーション2
  <div>
     <a href="new.php">
       <p>新規作成</p>
     </a>
  </div>
  <div> 
    <table>
      <tr>
        <th>ID</th>
        <th>内容</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      <?php foreach(find() as $todo): ?>
      <tr>
        <td><?php echo h($todo['id']) ?></td>
        <td><?php echo h($todo['todo']) ?></td>
        <td>
          <a href="edit.php?id=<?php echo h($todo['id'])?>">更新</a>
        </td>
        <td>
          <form action="store.php" method="POST">
            <input type="hidden" name="id" value="<?php echo h($todo['id']) ?>">
            <input type="hidden" name="type" value="delete">
            <button type="submit">削除</button>           
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>