<?php
// Calling the DB and checking if there's already an active session
include 'include/session.php';
$conn = $pdo->open();
try{
    // Importing settings from DB
    $stmt = $conn->prepare("SELECT * FROM settings WHERE id = 1");
    $stmt->execute();
    $settings = $stmt->fetch();
}
catch(PDOException $e){
    echo "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
?>
<?php
// Getting user's IP Address for logging
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
}
$deviceinfo = $_SERVER['HTTP_USER_AGENT'];

if(isset($_GET['return'])){
    $return = $_GET['return'];
    
}
else{
    $return = 'driver-login';
}

$conn = $pdo->open();

if(isset($_POST['login'])){
    // Inputs from form
    $username = $_POST['email'];
    $password = $_POST['password'];
    
    try{
        // Check if the email is in the DB
        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM drivers WHERE username = :username OR email = :email");
        $stmt->execute(['username'=>$username, 'email'=>$username]);
        $row = $stmt->fetch();
        
        // If user details is not found in DB
        if($row['numrows'] > 0){
            // If user status is active on the platform
            if($row['status'] == 1){
                // Password verification
                if(password_verify($password, $row['password'])){
                    if($row['type']){ // type has to be 1

                        // If user is an driver
                        $_SESSION['driver'] = $row['id'];
                        $_SESSION['message'] = $settings['gen_notification'];

                        // Create cookie to store user details set to 30 days
                        setcookie("username", $row['username'], time() + (86400 * 30), "/");
                        setrawcookie("password", $row['password'], time() + (86400 * 30), "/");

                        // Insert user's log into DB
                        $stmt = $conn->prepare("INSERT INTO driverslog (userid, userip, deviceinfo) VALUES (:userid, :userip, :deviceinfo)");
                        $stmt->execute(['userid'=>$row['id'], 'userip'=>$ip_address, 'deviceinfo'=>$deviceinfo]);
                    }
                    // else{
                    //     unset($_SESSION['username']);
                    //     // If user is a user
                    //     $_SESSION['user'] = $row['id'];
                    //     $_SESSION['message'] = $settings['gen_notification'];

                    //     // Create cookie to store user details set to 30 days
                    //     setcookie("username", $row['username'], time() + (86400 * 30), "/");
                    //     setrawcookie("password", $row['password'], time() + (86400 * 30), "/");

                    //     // Insert user's log into DB
                    //     $stmt = $conn->prepare("INSERT INTO userslog (userid, userip, deviceinfo) VALUES (:userid, :userip, :deviceinfo)");
                    //     $stmt->execute(['userid'=>$row['id'], 'userip'=>$ip_address, 'deviceinfo'=>$deviceinfo]);
                    // }
                }
                // If password is not correct
                else{
                    $_SESSION['error'] = 'Incorrect Password';
                    $_SESSION['username'] = $username;
                }
            }
            // If user status is not active on the platform
            elseif ($row['status'] == 2) {
                $_SESSION['block'] = 'This account has been blocked for violating our <a href="terms-conditions">Terms & Conditions</a> and cannot be used anymore! If you think otherwise
                do <a href="contact">write</a> to us providing your username and we could help resolve this.';
                $_SESSION['username'] = $username;
            }
            else{
                $_SESSION['error'] = 'Account not activated. Check your email for activation link.';
                $_SESSION['username'] = $username;
            }
        }
        else{
            $_SESSION['error'] = 'Email not found';
            $_SESSION['username'] = $username;
        }
    }
    catch(PDOException $e){
        echo "There is some problem in connection: " . $e->getMessage();
    }
    
}
else{
    $_SESSION['warning'] = 'No shortcuts, Fill up the form first';
}

$pdo->close();

//var_dump($_SESSION);

// 	header('location:'.$return);
echo "<script>window.location.assign('driver-login')</script>";
?>
