<?php
    use BettingRUs\Models\{Database, User};

    require_once "vendor/autoload.php";

    if(isset($_POST['addUser'])) {
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['user_password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $dob = $_POST['date_of_birth'];

        $db = Database::getDb();
        $userObj = new User();
        $money=$token=0;
        $count = $userObj->addUser($username, $firstname, $lastname, $email, $passwordHash, $dob, $db);


        if($count) {
        	$id = $userObj->getLastUserID($db);
        	$userid = (int)$id->id;
					$wallet = $userObj->createWallet($money,$token,$userid,$db);
            header("Location: index.php");

        } else {
            echo "<p>User was not added to database!</p>";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link  rel="stylesheet" type="text/css" href="css/main.css">
        <title>Register</title>
    </head>
    <body>
        <?php include 'Views/header.php'; ?>
        <main>
            <div class="forms">
                <h1>Sign Up for a free Account!</h1>
                <form id="registerForm" action="" method="POST">
                    <div class="formFields">
                        <label for="username">Username:</label>
                        <input id="username" type="text" name="username" />
                    </div>
                    <div class="formFields">
                        <label for="firstname">First Name:</label>
                        <input id="firstname" type="text" name="firstname" />
                    </div>
                    <div class="formFields">
                        <label for="lastname">Last Name:</label>
                        <input id="lastname" type="text" name="lastname" />
                    </div>
                    <div class="formFields">
                        <label for="email">Email:</label>
                        <input id="email" type="email" name="email" />
                    </div>
                    <div class="formFields">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="user_password" />
                    </div>
                    <div class="formFields">
                        <label for="dob">Date of Birth:</label>
                        <input id="dob" type="date" name="date_of_birth" />
                    </div>
                    <button class="profileBtn" type="submit" name="addUser">Register</button>
                </form>
            </div>
        </main>
        <?php require_once 'Views/footer.php'; ?>
    </body>
</html>