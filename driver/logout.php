<?php
session_start();
setcookie('token', "", time() - 3600);
unset($_COOKIE['token']);
setcookie("username", "", time() - 3600, "/");
setcookie("password", "", time() - 3600, "/");

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
	$params["path"], $params["domain"],
	$params["secure"], $params["httponly"]
);
}

// Finally, destroy the session.
session_destroy();
//header('location: ../login');
echo "<script>localStorage.clear();</script>";
echo "<script>window.location.assign('../driver-login')</script>";
exit;
?>
