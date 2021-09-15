<?php

// user registration

function signUp(){
    if (isset($_GET['signup'])) {

        $userEmail = mysqli_escape_string($GLOBALS['conn'], $_POST['userEmail']);
        $userMobNo = mysqli_escape_string($GLOBALS['conn'], $_POST['userMobNo']);
        $userPassword = mysqli_escape_string($GLOBALS['conn'], $_POST['userPassword']);
        $userName = mysqli_escape_string($GLOBALS['conn'], $_POST['userName']);

        $query = "INSERT INTO `user`(`userEmail`, `userMobNo`, `userPassword`, `userName`) VALUES ('$userEmail', '$userMobNo', '$userPassword', '$userName')";
        $query = mysqli_query($GLOBALS['conn'],$query);
        
        queryErrorCheck($query,"registration");

        header("location: ./sign.php?userregistered");
    }
}

function successMsg($key1,$key2){
    if(isset($_GET[$key1])){
        echo "<div class='success'><p>$key2</p></div>";
    }
}
function errorMsg($key1,$key2){
    if(isset($_GET[$key1])){
        echo "<div class='error'><p>$key2</p></div>";
    }
}

function notAllowedIfSessionStart(){
    if(isset($_SESSION['signIn']) || isset($_SESSION['signIn']) == true){
        header("location: ./index.php?userAlreadySignIn");
    }
}
function notAllowedIfSessionNotStart(){
    if(!isset($_SESSION['signIn']) || isset($_SESSION['signIn']) != true){
        header("location: ./index.php?userAlreadySignIn");
    }
}

// user login

function signIn(){

if (isset($_GET['signIn'])) {
    $userMobileEmail = mysqli_escape_string($GLOBALS['conn'], $_POST['userMobileEmail']);
    $userPassword = mysqli_escape_string($GLOBALS['conn'], $_POST['userPassword']);

    $query = "SELECT * from `user` WHERE (`userEmail` = '$userMobileEmail' OR `userMobNo` = '$userMobileEmail') AND `userPassword` = '$userPassword'";
    $query = mysqli_query($GLOBALS['conn'],$query);

    queryErrorCheck($query, "Sign In Form");

    if(mysqli_num_rows($query) === 1){
        $row = mysqli_fetch_assoc($query);

        session_start();

        $_SESSION['signIn'] = true;
        $_SESSION['userId'] = $row['userId'];
        $_SESSION['userName'] = $row['userName'];
        $_SESSION['userEmail'] = $row['userEmail'];
        $_SESSION['userMobNo'] = $row['userMobNo'];
        $_SESSION['userType'] = $row['userType'];

        echo $_SESSION['userName'];
        echo $row['userId'];

        header("location: ./index.php");
    } else {
        header("location: ./sign.php?invalid");
    }

}
}


function logout(){
    if(isset($_GET['logout'])){
        session_start();
        session_unset();
        session_destroy();
    header("Location: ./sign.php");
    }
}

