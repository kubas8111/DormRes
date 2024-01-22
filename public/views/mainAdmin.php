<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style_main.css">
    <title>main</title>
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