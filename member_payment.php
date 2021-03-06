<?php
use BettingRUs\Models\{Database, Currency,User};
require_once './Views/header.php';
require_once "vendor/autoload.php";
//to check if the user click on the make payment button
if(isset($_POST['makepayment'])){
    //if the user is not login then it will be redirected to the login page
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
    //if the user hasn't selected an option
    if(!isset($_POST['membership'])) {
        header('location:join_membership.php');
    }
    //if the user pressed no then will be redirected to index page
    elseif(!($_POST['membership'] === 'Yes')){
        header('location:index.php');
    }else{
        $id = $_SESSION['userid'];
        $wallet=$newwallet=$updateuser="";
        $cad=$token=0;
        $c = new Currency();
        $db = Database::getDb();
        //get the wallet details
        $wallet = $c->selectedWallet($id,$db);
        $cad = ($wallet->canadian_dollars)-100;
        //if there is no sufficient funds the user will be redirected to the payment page
        if($cad < 0){
            header('location:payment.php');
        }else{
            $token = ($wallet->token) + 10;
            //update the wallet with the money and token
            $newwallet = $c->updateWallet($id, $cad,$token, $db);
            $u = new User();
            $member = 1;
            // to calculate the expiry of the membership card
            $t = time();
            $expiry = date("Y-m-d",$t + 31536000);
            //update the user when they are registered as a member
            $updateuser = $u->updateMembership( $id, $member,$expiry, $db);
        }

    }

}
?>
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
    <!--An output message showing the details -->
    <div class="message-member">
        <p>Thank you <?php echo $_SESSION['userrealname'] ?> !</p>
        <p>You are now our valuable Member!</p>
        <p>Your remaining balance in the wallet is <?php echo $wallet->canadian_dollars ?></p>
        <p>Your remaining token in the wallet is <?php echo $wallet->token  ?></p>
    <form action="preview_membership.php" method="post">
        <input class="previewbtn" type="submit" name="preview" value="Preview"/>
    </form>
    </div>
<?php
require_once './Views/footer.php';
?>
</div>
</body>
</html>
