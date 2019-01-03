<?php
$user = "atsuatsu";
$pass = "Password";
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$category = (int) $_POST['category'];
$difficulty = (int) $_POST['difficulty'];
$budget = (int) $_POST['budget'];
try {
  if (empty($_GET['id'])) throw new Exception('ID不正');
  $id = (int) $_GET['id'];
  $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', 
  $user, $pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "UPDATE recipes SET recipe name = ?, category = ?,
  difficulty = ?, budget = ?, howto = ? WHERE id = ?";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $recipe_name, PDO::PARAM_STR);
  $stmt->bindValue(2, $category, PDO::PARAM_INT);
  $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
  $stmt->bindValue(4, $budget, PDO::PARAM_INT);
  $stmt->bindValue(5, $howto, PDO::PARAM_STR);
  $stmt->execute();
  $dbh = null;
  echo "ID" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "完了しました";
} catch (Exception $e) {
  echo "エラー発生" . htmlspecialchars($e->getMessage(),
  ENT_QUOTES, 'UTF-8') . "<br>";
  die();
}