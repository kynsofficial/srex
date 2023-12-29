<?php
  include 'include/conn.php';
  session_start();

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
            }
            else{
              $_SESSION['user'] = $row['id'];
              $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
              $stmt->execute(['id'=>$_SESSION['user']]);
              $user = $stmt->fetch();
              echo "<script>window.location.assign('../user/home')</script>";
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

  if(isset($_SESSION['user'])){
    // header('location: ../user/home');
    echo '<script>location.replace("../user/home"); </script>';
  }
    
//   $token = $_COOKIE['token'];
  
//   if (!is_null($token)) {
//     require_once('../jwt/jwt.php');

//     // Get our server-side secret key from a secure location.
//     $serverKey = '5f2b5cdbe5194f10b3241568fe4e2b24';

//     try {
//       $payload = JWT::decode($token, $serverKey, array('HS256'));
//       $returnArray = array('userId' => $payload->userId, 'statuscode' => 1);

//       $conn = $pdo->open();

//       try{
//         $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
//         $stmt->execute(['id'=>$payload->userId]);
//         $admin = $stmt->fetch();
//         // header('location: profile.php');
//       }
//       catch(PDOException $e){
//         echo "There is some problem in connection: " . $e->getMessage();
//       }

//       $pdo->close();

//       if (isset($payload->exp)) {
//         $returnArray['exp'] = date(DateTime::ISO8601, $payload->exp);
//       }
//     }
//     catch(Exception $e) {
//       $returnArray = array('error' => $e->getMessage(), 'statuscode' => 0);
//     }

//     $jsonEncodedReturnArray = json_encode($returnArray, JSON_PRETTY_PRINT);
//     // echo $jsonEncodedReturnArray;
//     $res = json_decode($jsonEncodedReturnArray);

//     // var_dump($res);

//     if ($res->statuscode == 1) {
//       // All is well
//     }elseif ($res->statuscode == 0) {
//       $_SESSION['error'] = $res->error;
//       unset($_SESSION['admin']);
//       header('location: ../login');
//       exit;
//     }

//   }

  elseif(isset($_SESSION['admin'])){

    $conn = $pdo->open();

    try{
      $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
      $stmt->execute(['id'=>$_SESSION['admin']]);
      $admin = $stmt->fetch();
      // header('location: profile.php');
    }
    catch(PDOException $e){
      echo "There is some problem in connection: " . $e->getMessage();
    }

    $pdo->close();
  }else {
    $_SESSION['warning'] = 'You need to be logged in to access that page!';
    // header('location: ../login');
    echo '<script>location.replace("../login"); </script>';
  }

  // if ('session_start()' == true) {
  //   $conn = $pdo->open();
  //   $stmt = $conn->prepare("SELECT * FROM about");
  //   $stmt->execute();
  //   $row = $stmt->fetch();
  //   $visitors = $row['visitors'] + 1;

  //   try{
  //     $stmt = $conn->prepare("UPDATE about SET visitors=:visitors");
  //     $stmt->execute(['visitors'=>$visitors]);

  //   }
  //   catch(PDOException $e){
  //     $_SESSION['error'] = $e->getMessage();
  //   }


  //   $pdo->close();
  // }

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

$conn = $pdo->open();
try{
  $stmt = $conn->prepare("SELECT * FROM rates WHERE id = 1");
  $stmt->execute();
  $rates = $stmt->fetch();
}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
?>
