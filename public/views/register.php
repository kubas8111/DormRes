<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="register page">
    <meta name="keywords" content="logowanie">
    <meta name="author" content="Jakub Swies">
    <link rel="stylesheet" type="text/css" href="public/css/style_register.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form action="register" method="post">
                <h2>REJESTRACJA</h2>
                <div class="message">
                    <?php if(isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <input name="email" type="email" placeholder="Email">
                <input name="password" type="password" placeholder="Hasło">
                <input name="name" type="text" placeholder="Imię">
                <input name="surname" type="text" placeholder="Nazwisko">
                <input name="telephone" type="tel" placeholder="Telefon">
                <input name="studentCard" type="number" placeholder="Numer karty studenta">
                <button>REGISTER</button>
            </form>
            <div class="registration">
                <input type="submit" id="loginPage" formaction="loginPage" value="Masz już konto? Zaloguj się">
            </div>
        </div>
    </div>
</body>