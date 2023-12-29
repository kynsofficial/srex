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
?>
<h1 class="rubikEBold">SREX</h1>
<section>
<h3>Account Activation</h3>
<p>Here, we know if you're real.</p>

<?php
$output = '';
if(!isset($_GET['code']) OR !isset($_GET['user'])){
	$output .= '
	<div class="alert alert-danger">
	<h4>😕 Error!</h4>
	Code to activate account not found.
	</div>
	<h4 class="font-weight-light">You may <a href="register">Signup</a> or back to <a href="index">Homepage</a>.</h4>
	';
}
else{
	$conn = $pdo->open();
	
	$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE activate_code=:code AND id=:id");
	$stmt->execute(['code'=>$_GET['code'], 'id'=>$_GET['user']]);
	$row = $stmt->fetch();
	
	if($row['numrows'] > 0){
		if($row['status']){
			$output .= '
			<div class="alert alert-danger">
			<h4>😕 Error!</h4>
			Account already activated.
			</div>
			<h4 class="font-weight-light">You may <a href="login.php">Login</a> or back to <a href="index">Homepage</a>.</h4>
			';
		}
		else{
			try{
				$stmt = $conn->prepare("UPDATE users SET status=:status WHERE id=:id");
				$stmt->execute(['status'=>1, 'id'=>$row['id']]);
				$output .= '
				<div class="alert alert-success">
				<h4>🥳 Success!</h4>
				Account activated - Email: <b>'.$row['email'].'</b>.
				</div>
				<h4>You can <a href="login">Login</a> now or back to the <a href="index">Homepage</a>.</h4>
				';
				// header('location: login.php');
			}
			catch(PDOException $e){
				$output .= '
				<div class="alert alert-danger">
				<h4>😕 Error!</h4>
				'.$e->getMessage().'
				</div>
				';
			}
			
		}
		
	}
	else{
		$output .= '
		<div class="alert alert-danger">
		<h4>😕 Error!</h4>
		Cannot activate account. Wrong code.
		</div>
		<h4 class="font-weight-light">Check your email again or <a href="register">Signup</a> again.</h4>
		';
	}
	
	$pdo->close();
}
?>
<div class="pt-3">
	<?php echo $output; ?>
</div>
</section>
</body>
</html>