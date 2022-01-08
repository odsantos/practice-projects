<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function assignValue($value) {
    return ($value === '' ? '' : htmlentities($value, ENT_QUOTES, "UTF-8"));
}

function displayError($error) {
    $msg = '&nbsp;';

    if ($error !== '&nbsp;') {
        $msg_arr = ['email address' => 'exist', 'password' => 'match the value'];
        $msg = "Your $error does not $msg_arr[$error] in our records.";
    }

    return $msg;
}
?>

<!DOCTYPE html>
<html>
    <head>
<?php require_once '../metaLinks.php'; ?>
        <title>Login</title>
    </head>
    <body>
<?php require_once '../navbar.php'; ?>
        <div class="container">
            <h1 class="mt-3">Login</h1>
            <div class="row">
                <form class="col-md-6" id="login_form" method="post" action="/controller/processLogin.php">
                    <div class="row py-2">
                        <label for="email" class="form-label col-3 fw-bold">Email address</label>
                        <input type="email" name="email" class="form-control col" id="email" required="" value="<?= assignValue($_SESSION['email'] ?? ''); ?>" aria-describedby="form_err">
                    </div>

                    <div class="row py-2">
                        <label for="pwd" class="form-label col-3 fw-bold">Password</label>
                        <input type="password" name="pwd" class="form-control col" id="pwd" required="" aria-describedby="form_err">
                    </div>
                    
                    <div class="row py-5 form_end">
                        <button type="submit" name="login" value="login" class="btn btn-primary col-3 mb-2">Submit</button>
                        <p class="form-text text-danger" id="form_err"><?= displayError($_SESSION['err'] ?? '&nbsp;'); ?></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
