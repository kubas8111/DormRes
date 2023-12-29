<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="login page">
    <meta name="keywords" content="logowanie">
    <meta name="author" content="Jakub Swies">
    <link rel="stylesheet" type="text/css" href="public/css/style_login.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form action="login" method="post">
                <h2>LOGOWANIE</h2>
                <div class="message">
                    <?php if(isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <input name="login" type="text" placeholder="login">
                <input name="password" type="password" placeholder="password">
                <button>LOGIN</button>
            </form>
            <div class="registration">
                <a href="register.php">Nie masz konta? Zarejestruj się</a>
            </div>
        </div>
    </div>
</body>