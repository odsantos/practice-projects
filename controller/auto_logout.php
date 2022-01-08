<?php
include_once './commonFunctions.php';

/* initialize variables */
$maxTime = 60 * 60 * 2; /* maximum session time (sec) = 60s ª 60m * 2h */ 
$newTime = time();
$oldTime = $newTime;
$timerDir = __DIR__ . '/time';
$timerFile = $timerDir . session_id() . 'timer.log';

/* read / write time to timer file */
if (file_exists($timerFile)) {
    $oldTime = file_get_contents($timerFile);
} else {
    file_put_contents($timerFile, $oldTime);
}

/* logout if ellapsed time > max time */
if (($newTime - $oldTime) > $maxTime) {
    /* delete timer file */
    if (file_exists($timerFile)) {
        unlink($timerFile);
    }
    
    processLogout();
}