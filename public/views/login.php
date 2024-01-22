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
            <form action="login" method="POST">
                <h2>LOGOWANIE</h2>
                <div class="message">
                    <?php if(isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="email" required>
                <input name="password" type="password" placeholder="password" required>
                <button>LOGIN</button>
            </form>
            <form>
                <div class="registration">
                    <input type="submit" id="registerPage" formaction="registerPage" value="Nie masz konta? Zarejestruj się">
                </div>
            </form>
        </div>
    </div>
</body>