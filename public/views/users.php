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
                    Użytkownicy
                </h2>
                <?php
                $userRepository = new UserRepository();
                $users = $userRepository->getUserView();

                if($users) { 
                    echo '<table>';
                    echo '<tr>';
                    foreach($users[0] as $key => $value) {
                      echo '<th>' . $key . '</th>';
                    }
                    echo '</tr>';
                  
                    foreach($users as $user) {
                      echo '<tr>';
                      foreach ($user as $value) {
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