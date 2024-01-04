<?php
include 'include/session.php';
include 'includes/slugify.php';

if(isset($_GET['return'])){
  $return = $_GET['return'];

}
else{
  $return = 'account-settings';
}

if(isset($_POST['save'])){
  $adminid = $admin['id'];
  $photo = $_FILES['photo']['name'];
  $photosize = $_FILES['photo']['size'];

  // echo $photosize;

  // var_dump($_POST);

  $conn = $pdo->open();

  $stmt = $conn->prepare("SELECT * FROM drivers WHERE id=:userid");
  $stmt->execute(['userid'=>$adminid]);
  $row = $stmt->fetch();

  if($photosize < 800*1024){
    $ext = pathinfo($photo, PATHINFO_EXTENSION);
    // echo $ext;
    if ($ext == 'jpg' OR $ext == 'png' OR $ext == 'jpeg' OR $ext == 'gif') {
      $new_filename = slugify($row['username'].'_'.time()).'.'.$ext;
      move_uploaded_file($_FILES['photo']['tmp_name'], '../assets/img/avatars/'.$new_filename);
      $filename = $new_filename;

      unlink('../assets/img/avatars/'.$row['photo']);

      try{
        $stmt = $conn->prepare("UPDATE drivers SET photo=:photo WHERE id=:id");
        $stmt->execute(['photo'=>$filename, 'id'=>$admin['id']]);

        $_SESSION['success'] = 'Profile Image updated successfully';
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }

      $pdo->close();

    }
    else {
      $_SESSION['error'] = "Allowed JPG, GIF or PNG.";
      echo "<script>window.location.assign('$return')</script>";
    }

  }
  else{
    $_SESSION['error'] = "File size is greater than 800KB";
    echo "<script>window.location.assign('$return')</script>";
  }
}
else{
  $_SESSION['error'] = 'Fill up required details first';
}

header('location:'.$return);
?>
