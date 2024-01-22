<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style_main.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="base-container">
    <nav>
            <div class="logo">
                <img src="public/img/logo.svg">
            </div>
            <div class="list">
                <form id="menu" method="get">
                <ul>
                    <li>
                        <input formaction="reserve" type="submit" value="Zarezerwuj pokój" class="center">
                    </li>
                    <li>
                        <input formaction="reservation" type="submit" value="Pokaż rezerwację" class="center">
                    </li>
                    <li>
                        <input formaction="main" type="submit" value="Informacje o akademikach" class="center">
                    </li>
                </ul>
            </div>
            <div class="account">
                <div class="user">
                    <img src="public/img/user.png">
                    <?php
                        echo '<p>Witaj '.$_SESSION['Name'].'</p>';
                    ?>
                </div>
                <div class="logout">
                    <form method="get">
                        <input type="submit" class="logout-button" value="Wyloguj" formaction="logout">
                    </form>
                </div>
            </div>
        </nav>
        <main>
            <section class="container">
                <h2>
                    Twoja rezerwacja
                </h2>
                
                <?php
                    $reservationRepository = new ReservationRepository();
                    $reservation = $reservationRepository->getReservationDetailsByUserID((int) $_SESSION['UserId']);
                    // var_dump($reservation);

                    if($reservation) {
                        echo 'Twoja rezerwacja została złożona: '.$reservation['formattedtime'];
                        echo '<br>Akademik przy '.$reservation['dormitoryname'];
                        echo '<br>Pokój numer: '.$reservation['Roomcode'];
                        echo '
                            <form method="post">
                                <input type="submit" formaction="cancelReservation" value="Zrezygnuj z rezerwacji">
                            </form>';
                    }
                    else {
                        echo 'Nie zarezerwowałeś jeszcze pokoju';
                    }
                ?>
            </section>
        </main>
    </div>
</body>