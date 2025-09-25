<?php


session_start();

require_once 'config.php';

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $conn -> query("INSERT INTO users (username, password) VALUES ('$username', '$password')");

  header("Location:../index.php");

  exit();
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = $conn -> query("SELECT * FROM users WHERE username = '$username'");
  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['username'] = $user['username'];
      header("Location:../html/index.html");
      exit();
    }
  }

  $_SESSION['login_error'] = "Wrong username or password";
  $_SESSION['active_form'] = "login";
  header("Location:../index.php");
  exit();
}
