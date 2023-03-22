<?php @include 'config.php'; ?>
<?php session_start(); ?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>home</title>

  <link rel="stylesheet" href="css/style.css" />
</head>
<?php
if (isset($_SESSION['admin_name'])) {
  include "admin_navigation.php";
  $username = $_SESSION['admin_name'];
} else {
  include "user_navigation.php";
  $username = $_SESSION['user_name'];
}
?>
<?php


$query = "SELECT * FROM user_form WHERE username = '{$username}'";
$select_user_profile_query = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($select_user_profile_query)) {
  $user_id = $row['user_Id'];
  $user_name = $row['username'];
  $user_password = $row['user_password'];
  $user_email = $row['user_email'];
}

if (isset($_POST['update'])) {
  $user_name = $_POST['name'];
  $user_password = $_POST['password'];
  $user_email = $_POST['email'];
  $query = "UPDATE user_form SET ";
  $query .= "username = '{$user_name}', ";
  $query .= "user_password = '{$user_password}', ";
  $query .= "user_email = '{$user_email}' ";
  $query .= "WHERE user_id = {$user_id} ";
  $select_user_profile_query = mysqli_query($conn, $query);
  if (!$select_user_profile_query) {
    die("Query Failed" . mysqli_error($conn));
  }
}
?>


<body>
  <div class="form-container">

    <form action="" method="post">
      <h3>Profile</h3>
      <h4>Username</h4>
      <input type="text" name="name" value="<?php echo $username; ?>">
      <h4>User_Password</h4>
      <input type="text" name="password" value="<?php echo $user_password; ?>">
      <h4>User_Email</h4>
      <input type="email" name="email" value="<?php echo $user_email; ?>">
      <!-- <h4></h4> -->
      <input type="submit" name="update" value="Update Now" class="form-btn">
    </form>

  </div>


</body>

</html>