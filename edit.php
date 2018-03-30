<?php
  require_once('functions.php');
  $data = h(detail($_GET['id']));
  echo "ID:".$_GET['id'];
  setToken()
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>編集</title>
</head>
<body>
  <?php if(isset($_SESSION['err'])): ?>
    <p><?php echo $_SESSION['err']; ?></p>
  <?php endif; ?>
  <form action="store.php" method="post">
    <input type="hidden" name="id" value="<?php echo h($_GET['id']) ?>">
    <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
    <input type="text" name="todo" value="<?php echo h($data) ?>">
    <input type="submit" value="更新">
  </form>
  <div>
    <a href="index.php">一覧へもどる</a>
  </div>
  <?php unsetSession(); ?>
</body>
</html>