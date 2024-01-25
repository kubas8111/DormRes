<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dormitory Room Reservation System - Reserve your room in university dormitories.">
    <meta name="keywords" content="dormitory, room reservation, university, accommodation">
    <meta name="author" content="Jakub Święs">

    <title>Dormitory Room Reservation</title>
    <link rel="stylesheet" type="text/css" href="public/css/style_main.css">
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
                        <input formaction="reservationList" type="submit" value="Lista rezerwacji" class="center">
                    </li>
                    <li>
                        <input formaction="users" type="submit" value="Lista użytkowników" class="center">
                    </li>
                    <li>
                        <input formaction="mainAdmin" type="submit" value="Informacje o akademikach" class="center">
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
                        <input type="submit" value="Wyloguj" formaction="logout">
                    </form>
                </div>
            </div>
        </nav>
        <main>
            <section class="container">
                <h2>
                    Rezerwacje
                </h2>
                <?php
                $reservationRepository = new ReservationRepository();
                $reservations = $reservationRepository->getReservationView();

                if($reservations) { 
                    echo '<table>';
                    echo '<tr>';
                    foreach($reservations[0] as $key => $value) {
                      echo '<th>' . $key . '</th>';
                    }
                    echo '</tr>';
                  
                    foreach($reservations as $reservation) {
                      echo '<tr>';
                      foreach ($reservation as $value) {
                        echo '<td>' . $value . '</td>';
                      }
                      echo '</tr>';
                    }
                  
                    echo '</table>';
                  } else {
                    echo 'Brak danych do wyświetlenia.';
                  }

                ?>
            </section>
        </main>
    </div>
</body>
</html>