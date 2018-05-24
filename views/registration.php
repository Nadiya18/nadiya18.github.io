
<div class="content">
  <form method="POST" action="index.php?action=registration">

<?php
    $loginErr = $passwordErr1 = $passwordErr2 = $emailErr = $nameErr = "";
    $wasError = false;
     if(!empty($_POST))
     {
        if(empty($_POST['login'])||!preg_match('/^[\p{L}0-9_-]{4,}$/u', $_POST['login']))
        {
            $loginErr = "Не менше 4 літер, може містити лише латинські та кириличні літери (великі та малі), цифри, нижнє підкреслення та дефіс";
            $wasError = true;
        } 
        if((empty($_POST['password']))||strlen($_POST['password'])<7 ||!preg_match('/[a-z]/', $_POST['password']) || !preg_match('/[A-Z]/', $_POST['password']) ||!preg_match('/[0-9]/', $_POST['password']))
        {
            $passwordErr1 = "Не менше 7 літер, обов’язково має містити великі та малі літери, а також цифри";
            $wasError = true;
        }
        if ($_POST["password"]!=$_POST["password2"]) 
 
            {
                $passwordErr2 = "Паролі не співпадають";
                $wasError = true;
              }
        if(empty($_POST['email'])||!preg_match('/^[a-zA-Z0-9_\.-]{2,}@[a-zA-Z0-9-]+\.[a-zA-Z-_]{2,}$/', $_POST['email']))

        {

            $emailErr = "Некоректний email адрес"; 
            $wasError = true;
        }   
      if(!preg_match('/^[a-zA-Z\p{L}-\']{0,255}$/u', $_POST['nam']))
      {
        $nameErr = "Не правильно введено ім'я,не може містити цифр та розділових знаків, окрім дефісу та апострофа";
        $wasError = true;
      } 
     
    

      $login=$_POST['login'];
      $password=$_POST['password'];
      $email=$_POST['email'];
      $username=$_POST['nam'];

     
      
        if($wasError == false)
      {
       
$mysqli=mysqli_connect( "localhost", "root", "","breakingbad") or die(mysqli_error());
 
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
mysqli_query($mysqli, "SET NAMES 'utf8'");

    mysqli_query($mysqli, "INSERT INTO `users` (`login`,`password`,`email`,`username`)
            VALUES ('$login','$hashed_password','$email','$username')") or die(mysqli_error());  
    
    mysqli_close($mysqli);
            header("Location: index.php?action=registration_successful");
            exit();
    }
  }

?>

       
     
    
  
   
        <h3>Registration</h3>
        

        
          <label for="form_login">Login</label>
          <input type='text' id='form_login' name='login' value="<?= !empty($_POST['login'])? $_POST['login']: "" ?>">
          <span>* <?php echo $loginErr;?></span>
          <br>
          <label for='form_password'>Password</label>
          <input type='password' id='form_password' name='password' >
          <span>* <?php echo $passwordErr1;?></span>
          <br>
          <label for='form_password2'>Repeat Password</label>
          <input type='password' id='form_password2' name='password2' >
          <span >* <?php echo $passwordErr2;?></span>
          <br>
          <label for='form_email'>Email Address</label>
          <input type='text' id='form_email' name='email'>
          <span>* <?= $emailErr ?></span>
          <br>
          <label for='name'>Name</label>
          <input type='text' id='form_name' name="nam">
          <span>* <?php echo $nameErr;?></span>
          <br>
          <br>

          <h5><button type="submit"  >Register</button></h5>
  </form>
  </div>