<?php
$user = "atsuatsu";
$pass = "Password";
try {
  if (empty($_GET['id'])) throw new Exception('ID不正');
  $id = (int) $_GET['id'];
  $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', 
  $user, $pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM recipes WHERE id = ?";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  echo "料理" . $result['recipe_name'] . "<br>\n";
  echo "カテゴリ" . $result['category'] . "<br>\n";
  echo "予算" . $result['budget'] . "<br>\n";
  echo "難易度" . $result['difficulty'] . "<br>\n";
  echo "作り方" . $result['howto'] . "<br>\n";
  $dbh = null;
} catch (Exception $e) {
  echo "エラー発生" . htmlspecialchars($e->getMessage(),
  ENT_QUOTES, 'UTF-8') . "<br>";
  die();
}