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
<h3>You forgot your password</h3>
<p>Enter email used to register.</p>

<form action="reset" method="post">
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
if(isset($_SESSION['email'])){
	echo "
	<input type='email' name='email' id='emai' class='input' placeholder='srexuser@gmail.com' value='".$_SESSION['username']."' required>
	";
	unset($_SESSION['email']);
}else {
	echo "
	<input type='email' name='email' id='emai' class='input' placeholder='srexuser@gmail.com' required>
	";
}
?>
</div>

<button type="submit" name="reset" class="button">Reset</button>
<span class="dont">
Remebered Password?
<a href="./login"> Login </a>
</span>
</form>
</section>
</body>
</html>
