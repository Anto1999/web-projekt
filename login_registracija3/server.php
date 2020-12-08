<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// variable declaration
$username ="";
$email="";
$lname="";
$fname="";
$address="";
$password_1="";
$password_2="";
$errors=array();

// call the register() function if register_btn is clicked
if (isset($_POST['register'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email,$lname,$fname,$address;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username = mysqli_real_escape_string($db,$_POST['username']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $fname = mysqli_real_escape_string($db,$_POST['fname']);
    $lname = mysqli_real_escape_string($db,$_POST['lname']);
    $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);
	$address = mysqli_real_escape_string($db,$_POST['address']);      

	// form validation: ensure that the form is correctly filled
	if (isset($_POST['register'])){
		if(empty($username)) {
    	array_push($errors, "Popuni username !");
    	} 

   	 	if(empty($fname)) {
    	array_push($errors, "Popuni ime !");
		} 

		if(empty($email)) {
			array_push($errors, "Popuni email !");
		}

    	if(empty($lname)) {
    	array_push($errors, "Popuni prezime !");
    	} 

    	if(empty($password_1)) {
    	array_push($errors, "Popuni lozinku !");
    	} 

    	if($password_1 != $password_2) {
    	array_push($errors, "Lozinke nisu jednake !");
    	} 

    	if(empty($address)) {
    	array_push($errors, "Popuni adresu !");
		} 
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		if (isset($_POST['username'])){
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, fname, lname, password, address) 
						VALUES('$username', '$email', '$fname','$lname', '$password','$address')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: profil.php');
		}else{
			$query = "INSERT INTO users (username, email, fname, lname, password, address) 
						VALUES('$username', '$email', '$fname','$lname', '$password','$address')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
		}	header('location: profil.php');				
	}
	
}






// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}


/*------------Login---------*/



if (isset($_POST['login'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in";
			header('location: profil.php');
			
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}




