<?php
require "db_functions.php";

$error = false;
$success = false;
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {

    $conn = connect_db();

    $name = mysqli_real_escape_string($conn,$_POST["name"]);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn,$_POST["confirm_password"]);

    if ($password == $confirm_password) {
      $password = md5($password);

      $sql = "INSERT INTO $table_users
              (name, email, password) VALUES
              ('$name', '$email', '$password');";

      if(mysqli_query($conn, $sql)){
        $success = true;
      }
      else {
        $error_msg = mysqli_error($conn);
        $error = true;
      }
    }
    else {
      $error_msg = "Senha não confere com a confirmação.";
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


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <title>Nossa loja - Login</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../style/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
  <div id="header"></div>

  <?php if ($success): ?>
    <p class="row1" style="margin-top: 50px;">Usuário criado com sucesso!</p>
    <p class="row1">
        Seguir para <a href="login.php">login</a>.
    </p>
  <?php endif; ?>




    <form action="register.php" method="post" class="row1" style="margin-top: 100px">
     <div id="cadastro">
      <label>Nome Completo</label>
      <input type="text" name="name" value="<?php echo $name; ?>" required/>

      <label>E-mail</label>
      <input type="text" name="email" placeholder="​example@example.com" value="<?php echo $email;?>" required/>

      <label>Senha</label>
      <input type="password" name="password" value="" required/>

      <label>Repita sua senha</label>
      <input type="password" name="confirm_password" value="" required/>

      <?php if ($error): ?>
       <p class="row1"> <?php echo $error_msg;?> </p>
      <?php endif; ?>

      <button value="Confirmar" name="submit">Confirmar</button>
     </div>
     </div>
    </form>

    <div id="footer" style="margin-top: 100px"></div>

    <script src="../js/login.js"></script>
</body>
</html>

<?php
    include_once('footer.php');
?>