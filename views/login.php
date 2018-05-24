<div class="content">
  <form method="POST" action="index.php?action=login">
  	<label for="login">Login</label>
  	<input id="login" name="login"></input><br>
  	<label for="password">Password</label>
  	<input id="password" name="password"></input><br>
<button type="submit" action="" >Увійти</button>
<input type="button" value="Відмінити" onclick="back()" class="reg_button" style="width: 100px;" >



 <?php
$mysqli=mysqli_connect( "localhost", "root", "","breakingbad") or die(mysqli_error());
if (isset($_POST['login']) && isset($_POST['password'])) {
   $login=$_POST['login'];
   $password=$_POST['password'];
   $result=password_hash($password, PASSWORD_DEFAULT);
   if ($mysqli->connect_error) {

   	die("Connection failed:" . $mysqli->connect_error);
   };
   $sql="SELECT password,id,login,admin FROM 'users' WHERE login='admin' ";
   
   $result=$mysqli->query($sql);
   $result=$result->fetch_assoc();

   var_dump($result);

   if($result==NULL) echo "<p><br>Невірний логін або пароль<br></p>";
      else
      	if (password_verify($password , $result['password'])) {

      		$_SESSION["id"]=$result['id'];
      		$_SESSION["login"]=$result['login'];
      		$_SESSION["admin"]=$result['admin'];
      	}
      	else echo "<p><br>Невірний логін або пароль<br></p>";
}
?>
