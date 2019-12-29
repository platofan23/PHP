<?php
//Funktion definmierem
function crsfValidate($token, $hashToken)
{
    //Crsf-Token Überprüfen
    if ($token != validateForm($_SESSION['_csrf_token']) or password_verify(validateForm($_SESSION['token']), $hashToken) == false) {
        //Protokollieren fail
        CRSFFail($token);
        //Zum Login
        header("Location: Login.php");
        exit();
    } else {
        //Protokollieren Erfolg
        CRSFErfolg($token);
    }
}
?>
