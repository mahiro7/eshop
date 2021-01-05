<?php
require "db_functions.php";
require "authenticate.php";

$error = false;
$password = $email = "";

if (!$login && $_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["email"]) && isset($_POST["password"])) {

    $conn = connect_db();

    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $password = md5($password);

    $sql = "SELECT id,name,email,password FROM $table_users
            WHERE email = '$email';";

    $result = mysqli_query($conn, $sql);
    if($result){
      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user["password"] == $password) {

          $_SESSION["user_id"] = $user["id"];
          $_SESSION["user_name"] = $user["name"];
          $_SESSION["user_email"] = $user["email"];

          header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/index.php");
          exit();
        }
        else {
          $error_msg = "Usuário ou senha inválido!";
          $error = true;
        }
      }
      else{
        $error_msg = "Usuário ou senha inválido!";
        $error = true;
      }
    }
    else {
      $error_msg = mysqli_error($conn);
      $error = true;
    }
  }
}
?>

<!--Header-->
<?php 
    $PageTitle="Login";

    function head(){?>
        <link rel="stylesheet" href="../style/header.css">
        <link rel="stylesheet" href="../style/footer.css">
    <?php }

    include_once('header.php');
?>



    <!--HTML Body-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Login</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../style/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<body>
  <!-- CABEÇALHO -->
  <div id="header"></div>

  <?php if ($login): ?>
    <p class="row1" style="margin-top: 50px;">Você já está logado!</p>
    <p class="row1"><a href="logout.php">Logout</a></p>
    <div id="footer" style="margin-top: 100px"></div>
  </body>
  </html>
  <?php exit(); ?>
<?php endif; ?>

<?php if ($error): ?>
  <p class="row1"><?php echo $error_msg; ?></p>
<?php endif; ?>


  <form action="login.php" method="post" class="row1" style="margin-top: 100px;">
        <label for="e-mail" class="">E-mail</label>
        <input type="text" name="email" placeholder="example@example.com" value="<?php echo $email;?>" required/>

        <label class="" for="Senha">Senha:</label>
		    <input id="Senha" type="password" name="password" value="" required/>
          
        <!--<a href"">Esqueci a senha</a>-->
        <button type="submit" name="submit" value="Entrar">Entrar</button>
<p>Primeiro acesso? <br>Faça o cadastro clicando abaixo:</p>

    </form>
    <form class="row1" action="register.php" method="post" style="padding-top: 0">
      <button type="submit" name="submit">Cadastro</button>
    </form>

    <div id="footer" style="margin-top: 100px"></div>

    <script src="../js/login.js"></script>
</body>
</html>

<!--Footer-->
<?php
    include_once('footer.php');
?>