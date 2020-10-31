<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= isset($PageTitle)  ? $PageTitle : "eshop default" ?></title>
    <!--HTML Tags-->
    <?php if (function_exists('head')){
        head();
    } ?>
</head>

<body>
    <ul class="images">
        <li><img src="../images/search-icon.png" alt="Magnifier icon" class="mag" usemap="#magmap"></li>
        <map name="magmap" id="magmap"><area shape="circle" coords="70,70,35" href=""></map>
        
        <li><a href="index.php"><div class="logo">LOGO</div></a></li>

        <div class="login">
            <li class="login"><p><a href="login.php">Login | Cadastre-se</a></p></li>
            <li><a href="cart.php"><img src="../images/bag-icon.png" alt="Bag icon" class="bag"></a></li>
        </div>
    </ul>
    
    <ul class="list">
        <a href=""><li>CAMISETAS</li></a>
        <a href=""><li>BLUSÃO</li></a>
        <a href=""><li>MOLETONS</li></a>
        <a href=""><li>MANGA LONGA</li></a>
        <a href=""><li>CALÇAS</li></a>
        <a href=""><li>CALÇADOS</li></a>
        <a href=""><li>ACESSÓRIOS</li></a>
    </ul>
    