<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style_main.css">
    <title>LOGIN PAGE</title>

    <script src="public/js/pokoje.js"></script>
    <script src="public/js/rezerwacja.js"></script>
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
                <?php
                $reservationRepository = new ReservationRepository();
                $reservation = $reservationRepository->getReservationDetailsByUserID((int) $_SESSION['UserId']);

                if(!$reservation) {
                    echo '<form method="post">';
                    echo '
                        <h2>
                            Zarezerwuj pokój
                        </h2>';
                    
                    $dormitoryRepository = new DormitoryRepository();
                    $dormitories = $dormitoryRepository->getDormitories();

                    echo '<label>Wybierz akademik: <select name="dormitory" id="dormitory" required>';
                    echo '<option disabled selected value="">Wybierz akademik...</option>';
                    foreach($dormitories as $dormitory) {
                        echo '<option value ="'.$dormitory['DormitoryID'].'">';
                        echo $dormitory['Address'];
                        echo '</option>';
                    }
                    echo '</select></label>';
                    
                    echo '<br>';
                    
                    echo '
                        <label>Pokoje: 
                            <select name="room" id="room" disabled required>
                            </select>
                        </label>
                        <br>
                    
                        <input formaction="addReservation" type="submit" value="Zarezerwuj">
                    </form>';
                }
                else {
                    echo '<h2>Już masz zarezerwowany pokój!</h2>';
                }
                ?>
            </section>
        </main>
    </div>
</body>

