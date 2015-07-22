<!DOCTYPE html>
<html>
<head>

    <title>Taraita!</title>
    <link rel="stylesheet" href="css/modal.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/login_styles.css" type="text/css" media="screen">

</head>
<body>

<div class="centerBlock">
    <div align="center">
        <h1>Welcome!</h1>

                <?php
                include('login.php');
                if(isset($_SESSION['login_user'])){
                    header("location: content/welcome.php");
                }
                ?>

    </div>

    <p style="text-align:left;">
        <a class="pure-button" href="#openModalLogin">
            <button>Login</button>
        </a>
        <span style="float:right;"><a href="#openModalRegister" class="pure-button">
                <button>Register</button>
            </a></span>
    </p>
</div>

<div id="openModalLogin" class="modalDialog">
    <div>
        <a href="#close" title="Close" class="close">X</a>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
                <label for="name">Username:</label>
                <input type="text" name="name"/>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
            <div>
                <input type="checkbox" name="set_cookie">Save
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</div>

<div id="openModalRegister" class="modalDialog">
    <div>
        <a href="#close" title="Close" class="close">X</a>

        <form action="register.php" method="post">
            <div>
                <label for="name">Username:</label>
                <input type="text" name="name"/>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="text" name="email">
            </div>
            <div>
                <input type="checkbox" name="set_cookie">Save your password
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</div>

</body>
</html>
