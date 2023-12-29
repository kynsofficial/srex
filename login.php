<?php include 'includes/head.php'; 

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
<?php
$conn = $pdo->open();
try{
	$stmt = $conn->prepare("SELECT * FROM about WHERE id = 1");
	$stmt->execute();
	$about = $stmt->fetch();
}
catch(PDOException $e){
	echo "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
$now = date('d F, Y');
?>
<body class="login">
<?php
if(isset($_SESSION['user'])){
	echo "<script>window.location.assign('user/home')</script>";
}
elseif(isset($_SESSION['admin'])){
	echo "<script>window.location.assign('admin/home')</script>";
}
?>
<h1 class="rubikEBold">SREX</h1>
<section>
<h3>Welcome Back</h3>
<p>Sign in to your account</p>

<form action="verify" method="post">
<?php
if(isset($_SESSION['error'])){
	echo "
	<div class='alert alert-danger fade show'>
	<strong>Oops! 😕</strong> <br>".$_SESSION['error']."
	</div>
	";
	unset($_SESSION['error']);
}
if(isset($_SESSION['block'])){
	echo "
	<div class='alert alert-warning fade show'>
	<strong>Oh-Uh! 😒</strong> <br>".$_SESSION['block']."
	</div>
	";
	unset($_SESSION['block']);
}
if(isset($_SESSION['warning'])){
	echo "
	<div class='alert alert-warning fade show'>
	<strong>Hugh 😒</strong><br>".$_SESSION['warning']."
	</div>
	";
	unset($_SESSION['warning']);
}
if(isset($_SESSION['success'])){
	echo "
	<div class='alert alert-success fade show'>
	<strong>Hurray 🥳</strong><br>".$_SESSION['success']."
	</div>
	";
	unset($_SESSION['success']);
}
?>
<div>
<label for="email" class="label">Email address</label>
<?php
if(isset($_SESSION['username'])){
	echo "
	<input type='email' name='email' id='emai' class='input' placeholder='srexuser@gmail.com' value='".$_SESSION['username']."' required>
	";
	unset($_SESSION['username']);
}else {
	echo "
	<input type='email' name='email' id='emai' class='input' placeholder='srexuser@gmail.com' required>
	";
}
?>
</div>
<div>
<label for="password" class="label">Password</label>
<input type="password" name="password" id="password"	class="input" placeholder="Enter a password"/>
</div>
<div class="remember">
<span>
<input type="checkbox" id="remember" />
<label for="remember">Remember me</label>
</span>
<a href="./forget">Forgot password?</a>
</div>

<button type="submit" name="login" class="button">Login</button>
<span class="dont">
Don't have an account?
<a href="./register"> Sign up </a>
</span>
</form>
</section>
</body>
</html>
