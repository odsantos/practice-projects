<?php
include_once './commonFunctions.php';

/* if logged in, log out */
if (isset($_SESSION['user_id'])) {
    processLogout();
}