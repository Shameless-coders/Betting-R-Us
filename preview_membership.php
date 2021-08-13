<?php
session_start();
if(isset($_POST['preview'])){
    if($_POST['membership'] === 'No') {
        header('location:index.php');
    }
$name = $_SESSION['userrealname'];
$t = time();
$expiry = date("Y-m-d",$t + 31536000);
$username = $_SESSION['username'];
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/members.css">
    <title>Membership Card</title>
</head>
<body>
<div class="container-fluid">
    <?php
    require_once './Views/header.php';
    ?>
    <section class="membershipcard">
        <div class="membercard">
    <img src="./images/membership.jpg" alt="image of a membership card" width="650" height="450"/>
        </div>
        <div class="membername">
            <p><?php echo $name ?> </p>
        </div>
        <div class="memberusername">
            <p><?php echo $username ?></p>
        </div>
        <div class="memberexpiry">
            <p>Valid Until:<?php echo $expiry ?></p>
        </div>
    </section>
    <div class="btncontainer">
        <form action="payment.php" method="post">
            <input class="paymentbtn" type="submit" name="payment" value="Pay Your Fees"/>
        </form>
        <a class="previewbtn" href="index.php" >Back to Homepage</a>
    </div>
<?php
require_once './Views/footer.php';
?>
</div>
</body>
</html>