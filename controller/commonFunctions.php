<?php

function processLogout() {
    /* in comments, 3 steps for logout */

    /* unset session data */
    $_SESSION = [];

    /* expire the session cookie */
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, 
                $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    /* destroy session */
    session_destroy();

    header('Location: ../index.php');
}

