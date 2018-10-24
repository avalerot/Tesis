<script src="recursos/js/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php
session_start();
include 'conection.php';
?>
 



 
<?php
 
if(isset($_SESSION["session_username"])){
	session_start();
session_destroy();
echo 'Cerraste sesión';
echo '<script> window.location="login.php"; </script>';

}
 
if(isset($_POST["login"])){
 
if(!empty($_POST['username']) && !empty($_POST['password'])) {
 $username=$_POST['username'];
 $password=$_POST['password'];
 
$query =$mysqli->query("SELECT * FROM usuarios WHERE Nomuser='".$username."' AND pass='".$password."'");
 
$numrows=mysqli_num_rows($query);
 if($numrows!=0)
 
{
 while($row=mysqli_fetch_assoc($query))
 {
 $dbusername=$row['Nomuser'];
 $dbpassword=$row['pass'];
 }
 
if($username == $dbusername && $password == $dbpassword)
 
{
 
 $_SESSION['session_username']=$username;
	$secc=$_SESSION["session_username"];
$usr =  $mysqli->query("SELECT Nomuser,tipo,RutEmpre FROM Usuarios WHERE Nomuser='$secc'");
$row = mysqli_fetch_array($usr, MYSQLI_NUM);
		$tipo=$row[1];
		$rutE=$row[2];
		$usr=$row[0];
	


	if($tipo==0){
		 $_SESSION['session_username0']=$username;
  echo'<script>window.location="UserContador/index.php";</script>';

	}


	if ($tipo==1) {
		 $_SESSION['session_username1']=$username;
		 echo '<script> window.location="Userempresarios/index.php?rutE=$rutE";   </script>';

	}
/* Redirect browser */





 }
 } else {
 
$message = "Nombre de usuario ó contraseña invalida";
 }
 
} else {
 $message = "Complete todos los campos";
}
}
?>

 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <div style="margin: 50px 0px 0px 0px"  class="col-sm-12 col-xs-12  col-md-12 col-lg-12"></div>
 <div class="col-sm-12 col-xs-12  col-md-4 col-lg-4"></div>
<div style="border: solid;" class="col-sm-12 col-xs-12  col-md-4 col-lg-4">
<center>
<div class="col-sm-12 col-xs-12  col-md-12 col-lg-12">
 <h1>Ingreso</h1>
 </div>
 </center>
<form name="loginform" id="loginform" action="" method="POST">

 <p>
 <label for="user_login">Nombre De Usuario<br />
 <div class="col-sm-12 col-xs-12  col-md-12 col-lg-12">
 <input type="text" name="username" id="username"  class="form-control" value=""  /></label>
 </p>
 </div>

 <p>
 <label for="user_pass">Contraseña<br />
  <div class="col-sm-12 col-xs-12  col-md-12 col-lg-12">
 <input type="password" name="password" id="password"  class="form-control"value=""/></label>
 </p>
 </div>
 <p style="float: left;" class="submit">
 <input type="submit" name="login" class="btn btn-primary"  value="Entrar" />
 </p>

</form>

 
</div>
<center>
 <div style="margin-top: 30px" class="col-sm-12 col-xs-12  col-md-12 col-lg-12">
<p class="bg-primary">
 
 <?php if (!empty($message)) {echo $message ;} ?>

 	</p>
 	</div>
 	</center>
