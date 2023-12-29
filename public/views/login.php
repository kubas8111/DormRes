<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style_login.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form>
                <h2>LOGOWANIE</h2>
                <div class="message">
                    <?php if(isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button>LOGIN</button>
            </form>
            <div class="registration">
                <a href="register.html">Nie masz konta? Zarejestruj się</a>
            </div>
        </div>
    </div>
</body>