<?php
    session_start();

    use BettingRUs\Models\{Database, MovieInfo};
    require_once "vendor/autoload.php";
		if(isset($_SESSION['userid'])){
			$userID = $_SESSION['userid'];
			$username = $_SESSION['username'];
			$userType = $_SESSION['accounttype'];
			$userFullName = $_SESSION['userrealname'];
			$useremail = $_SESSION['useremail'];
			$userdob = $_SESSION['userdob'];
			$accountage = $_SESSION['accountage'];
		}


    $db = Database::getDb();
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a href="index.php"><img class="logo" src="./images/BetsRUs_Logo.png" alt="Logo for bets r us"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggleNav" aria-controls="toggleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="toggleNav">
                <ul id="topNavLinks" class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="current-bet.php">Bets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list-movies.php">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="donations.php">Donate</a>
                    </li>
                </ul>
                <?php
                    if(isset($userID)){
                ?>
                <div class="btn">
                    <a class="username" href="user_profile.php" type="button"><?= $username ?></a>
                    <a class="profileBtn" href="logout.php" type="button">Logout</a>
                </div>
                <?php
                    } else {
                ?>
                <div class="btn">
                    <a href="login.php" class="profileBtn" type="button">Login</a>
                    <a href="register.php" class="profileBtn" type="button">Register</a>
                </div>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>
