<?php
  include 'include/conn.php';
  session_start();

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
  $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
  }else {
  $ip_address = $_SERVER['REMOTE_ADDR'];
  }

$device_info = $_SERVER['HTTP_USER_AGENT'];
$today = date('Y-m-d');

  
  // Probably has issues
  if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    $conn = $pdo->open();
    
    try{
      $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE username = :username");
      $stmt->execute(['username'=>$_COOKIE['username']]);
      $row = $stmt->fetch();
      
      if($row['numrows'] > 0){
        if($row['status'] == 1){
          if($_COOKIE['password'] == $row['password']){
            if($row['type']){
              $_SESSION['admin'] = $row['id'];
              
              $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
              $stmt->execute(['id'=>$_SESSION['admin']]);
              $admin = $stmt->fetch();
              echo "<script>window.location.assign('admin/home')</script>";
            }
            else{
              $_SESSION['user'] = $row['id'];
              $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
              $stmt->execute(['id'=>$_SESSION['user']]);
              $user = $stmt->fetch();
            }
          }
          else{
            $_SESSION['error'] = 'Incorrect Password';
            unset($_SESSION['user']);
            unset($_SESSION['admin']);
            setcookie("username", "", time() - 3600, "/");
            setcookie("password", "", time() - 3600, "/");
            echo "<script>window.location.assign('../login')</script>";
          }
        }
        elseif ($row['status'] == 2) {
          $_SESSION['block'] = 'This account has been blocked for violating our <a href="terms-conditions">Terms & Conditions</a> and cannot be used anymore! If you think otherwise
          do <a href="contact">write</a> to us providing your username and we could help resolve this.';
          unset($_SESSION['user']);
          unset($_SESSION['admin']);
          setcookie("username", "", time() - 3600, "/");
          setcookie("password", "", time() - 3600, "/");
          echo "<script>window.location.assign('../login')</script>";
        }
        else{
          $_SESSION['error'] = 'Account not activated. Check your email for activation link.';
          unset($_SESSION['user']);
          unset($_SESSION['admin']);
          setcookie("username", "", time() - 3600, "/");
          setcookie("password", "", time() - 3600, "/");
          echo "<script>window.location.assign('../login')</script>";
        }
      }
      else{
        $_SESSION['error'] = 'Username not found';
        unset($_SESSION['user']);
        unset($_SESSION['admin']);
        setcookie("username", "", time() - 3600, "/");
        setcookie("password", "", time() - 3600, "/");
        echo "<script>window.location.assign('../login')</script>";
      }
      
    }
    catch(PDOException $e){
      echo "There is some problem in connection: " . $e->getMessage();
    }
    $pdo->close();
    
    // if(password_verify($user['id'], $_COOKIE[$cookie_name])){
      //     echo "<script>window.location.assign('admin/home')</script>";   
      // }
  }

  if(isset($_SESSION['admin'])){
    header('location: ../admin/home');
  }

  if(isset($_SESSION['user'])){

    $conn = $pdo->open();

    try{
      $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
      $stmt->execute(['id'=>$_SESSION['user']]);
      $user = $stmt->fetch();
      // header('location: profile.php');
    }
    catch(PDOException $e){
      echo "There is some problem in connection: " . $e->getMessage();
    }

    $pdo->close();
  }else {
    unset($_SESSION['user']);
    echo "<script>window.location.assign('../login')</script>";
    header('location: ../login');
  }

    if ('session_start()' == true) {

  $conn = $pdo->open();

  $stmt = $conn->prepare("SELECT * FROM visitors");
  $stmt->execute();
  $row = $stmt->fetch();

  $count = $row['count'] + 1;
  $ini_count = 1;
  $db_ip = $row['ip'];

  if ($db_ip == $ip_address) {
    $stmt = $conn->prepare("UPDATE visitors SET count = :count, date = :date WHERE ip = :ip");
    $stmt->execute(['count'=>$count, 'date'=>$today, 'ip'=>$db_ip]);
  }
  else {
    $stmt = $conn->prepare("INSERT INTO visitors(count, ip, deviceinfo, date) VALUES (:count, :ip, :deviceinfo, :date)");
    $stmt->execute(['count'=>$ini_count, 'ip'=>$ip_address, 'deviceinfo'=>$device_info, 'date'=>$today]);
  }

  $pdo->close();

}

$conn = $pdo->open();
try{
  $stmt = $conn->prepare("SELECT * FROM settings WHERE id = 1");
  $stmt->execute();
  $settings = $stmt->fetch();
}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
?>
