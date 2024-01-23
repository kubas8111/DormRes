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
                    Informacje o akademikach
                </h2>
                <?php
                $dormitoryRepository = new DormitoryRepository();
                $dormitories = $dormitoryRepository->getDormitories();

                if(!empty($dormitories)) {
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Address</th>';
                    echo '<th>City</th>';
                    echo '<th>Postcode</th>';
                    echo '<th>Telephone</th>';
                    echo '</tr>';
                
                    foreach($dormitories as $dormitory) {
                    echo '<tr>';
                    echo '<td>' . $dormitory['Address'] . '</td>';
                    echo '<td>' . $dormitory['City'] . '</td>';
                    echo '<td>' . $dormitory['Postcode'] . '</td>';
                    echo '<td>' . $dormitory['Telephone'] . '</td>';
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