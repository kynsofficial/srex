<?php
  session_start();
  include 'include/conn.php';
  ob_start();

  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
  $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
  }else {
  $ip_address = $_SERVER['REMOTE_ADDR'];
  }

$device_info = $_SERVER['HTTP_USER_AGENT'];
$today = date('Y-m-d');

if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    $conn = $pdo->open();

    try{
    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM drivers WHERE username = :username");
	$stmt->execute(['username'=>$_COOKIE['username']]);
	$row = $stmt->fetch();

	if($row['numrows'] > 0){
		if($row['status'] == 1){
			if($_COOKIE['password'] == $row['password']){
				if($row['type']){
					$_SESSION['driver'] = $row['id'];
                    
                    $stmt = $conn->prepare("SELECT * FROM drivers WHERE id=:id");
                    $stmt->execute(['id'=>$_SESSION['driver']]);
                    $admin = $stmt->fetch();
                    echo "<script>window.location.assign('driver/home')</script>";
				}
				else{
					$_SESSION['user'] = $row['id'];
					$stmt = $conn->prepare("SELECT * FROM drivers WHERE id=:id");
                    $stmt->execute(['id'=>$_SESSION['user']]);
                    $user = $stmt->fetch();
                    echo "<script>window.location.assign('user/home')</script>";
				}
			}
			else{
				$_SESSION['error'] = 'Incorrect Password';
				unset($_SESSION['user']);
				unset($_SESSION['driver']);
            	setcookie("username", "", time() - 3600, "/");
            	setcookie("password", "", time() - 3600, "/");
		        echo "<script>window.location.assign('driver-login')</script>";
			}
		}
		elseif ($row['status'] == 2) {
			$_SESSION['block'] = 'This account has been blocked for violating our <a href="terms-conditions">Terms & Conditions</a> and cannot be used anymore! If you think otherwise
			do <a href="contact">write</a> to us providing your username and we could help resolve this.';
			unset($_SESSION['user']);
				unset($_SESSION['driver']);
        	setcookie("username", "", time() - 3600, "/");
        	setcookie("password", "", time() - 3600, "/");
		    echo "<script>window.location.assign('driver-login')</script>";
		}
		else{
			$_SESSION['error'] = 'Account not activated. Check your email for activation link.';
			unset($_SESSION['user']);
				unset($_SESSION['driver']);
        	setcookie("username", "", time() - 3600, "/");
        	setcookie("password", "", time() - 3600, "/");
		    echo "<script>window.location.assign('driver-login')</script>";
		}
	}
	else{
		//$_SESSION['error'] = 'Username not found';
		unset($_SESSION['user']);
				unset($_SESSION['driver']);
    	setcookie("username", "", time() - 3600, "/");
    	setcookie("password", "", time() - 3600, "/");
		echo "<script>window.location.assign('driver-login')</script>";
	}
	
    }
    catch(PDOException $e){
      echo "There is some problem in connection: " . $e->getMessage();
    }
    $pdo->close();
    
    // if(password_verify($user['id'], $_COOKIE[$cookie_name])){
    //     echo "<script>window.location.assign('driver/home')</script>";   
    // }
}

  if(isset($_SESSION['driver'])){
    header('location: driver/home');
    echo "<script>window.location.assign('driver/home')</script>";
  }

  if(isset($_SESSION['user'])){

    $conn = $pdo->open();

    try{
      $stmt = $conn->prepare("SELECT * FROM drivers WHERE id=:id");
      $stmt->execute(['id'=>$_SESSION['user']]);
      $user = $stmt->fetch();
      // header('location: profile.php');
    }
    catch(PDOException $e){
      echo "There is some problem in connection: " . $e->getMessage();
    }

    $pdo->close();
  }
?>
