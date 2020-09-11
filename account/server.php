<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$id    = "";

$errors = array();

// connect to the database
include '../conn.php';

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $first_name=mysqli_real_escape_string($db, $_POST['first_name']);
  $last_name=mysqli_real_escape_string($db, $_POST['last_name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $mobile= mysqli_real_escape_string($db, $_POST['mobile']);
  $_SESSION['first_name'] = $first_name;
  $_SESSION['last_name'] = $last_name;
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $email;
  $_SESSION['mobile'] = $mobile;

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($first_name)) { array_push($errors, "First Name is required"); }
  if (empty($last_name)) { array_push($errors, "Last Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($mobile)) { array_push($errors, "Mobile is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM account WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
  	$date = date("Y-m-d");
  	$query = "INSERT INTO account (username,email,password_1,first_name,last_name,mobile,role,date_update) 
  			  VALUES('$username', '$email', '$password','$first_name','$last_name','$mobile',2,'$date')";
  	mysqli_query($db, $query);
    $sql="SELECT * FROM account WHERE username='$username'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_assoc($result);
    $_SESSION['role'] = $row['role'];
    $_SESSION['id'] = $row['id'];
  	$_SESSION['username'] = $username;
  	$_SESSION['time']=time();
  	$_SESSION['email']=$row['email'];
  	header('location: ../home');
  }
}

// LOGIN USER
if(isset($_POST['submit']))
{

  //mysql_select_db($dbDatabase, $db)or die("Couldn't select the database.");

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0)
  {
    $password = md5($password);
    if (md5($_POST['password']) !== $password)
    {
      echo "Password is invalid";
    }
    $sql="SELECT * FROM account WHERE username='$username'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_assoc($result);

    $query = "SELECT * FROM account WHERE username='$username' AND password_1 ='$password'";
    $results = mysqli_query($db, $query);
    $res=mysqli_num_rows($results);
    if ($res)
    {

      $_SESSION['username'] = $username;
      $_SESSION['id'] = $row['id'];
      $_SESSION['role'] = $row['role'];
	  $_SESSION['email']=$row['email'];
      $_SESSION['time']=time();
      header('location: ../home');
    }
    else
    {
      array_push($errors, "Wrong username/password");
    }
  }
}

  ?>
  