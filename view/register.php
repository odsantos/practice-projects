<?php include_once '../model/db_connection.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once '../metaLinks.php'; ?>
        <title>Sign Up</title>
    </head>
    <body>
        <?php require_once '../navbar.php'; ?>
        <div class="container">
            <h1 class="mt-5 mb-4">Sign Up</h1>
            <div class="row">
                <form class="col-md-6" id="reg_form" method="post" action="/controller/processRegister.php">
                    <div class="row py-2">
                        <label for="fname" class="form-label col-3 fw-bold">First name</label>
                        <div class="col">
                            <input type="text" name="fname" class="form-control" id="fname" aria-describedby="fname_err">
                            <p class="form-text text-danger" id="fname_err">&nbsp;</p>
                        </div>
                    </div>

                    <div class="row py-2">
                        <label for="lname" class="form-label col-3 fw-bold">Last name</label>
                        <div class="col">
                            <input type="text" name="lname" class="form-control" id="lname" aria-describedby="lname_err">
                            <p class="form-text text-danger" id="lname_err">&nbsp;</p>
                        </div>
                    </div>

                    <div class="row py-2">
                        <label for="country" class="form-label col-3 fw-bold">Country</label>
                        <div class="col">
                            <select name="country" class="form-select" id="country" aria-describedby="country_err">
                                <?php
                                foreach($dbh->query('SELECT id, name FROM countries') as $country) { ?>
                                    <option value="<?= $country['id']; ?>"><?= $country['name']; ?></option>
                                <?php }
                                $dbh = null; ?>
                            </select>
                            <p class="form-text text-danger" id="country_err">&nbsp;</p>
                        </div>
                    </div>

                    <div class="row py-2">
                        <label class="form-label col-3 fw-bold">Email address</label>
                        <div class="col">
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email_err">
                                <p class="form-text text-danger" id="email_err">&nbsp;</p>
                            </div>

                            <div>
                                <label for="conf_email" class="form-label">Confirm Email</label>
                                <input type="email" name="conf_email" class="form-control" id="conf_email" aria-describedby="conf_email_err">
                                <p class="form-text text-danger" id="conf_email_err">&nbsp;</p>
                            </div>
                        </div>
                    </div>

                    <div class="row py-2">
                        <label class="form-label col-3 fw-bold">Password</label>
                        <div class="col">
                            <div class="mb-2">
                                <label for="pwd" class="form-label">Password</label>
                                <input type="password" name="pwd" class="form-control" id="pwd" aria-describedby="pwd_err">
                                <p class="form-text text-danger" id="pwd_err">&nbsp;</p>
                            </div>

                            <div>
                                <label for="conf_pwd" class="form-label">Confirm Password</label>
                                <input type="password" name="conf_pwd" class="form-control" id="conf_pwd" aria-describedby="conf_pwd_err">
                                <p class="form-text text-danger" id="conf_pwd_err">&nbsp;</p>
                            </div>
                        </div>
                    </div>

                    <div class="row py-5 form_end">
                        <button type="submit" name="register" value="register" class="btn btn-primary col-3 mb-2">Submit</button>
                        <p class="form-text text-danger">All fields are required.</p>
                        <p class="form-text text-danger" id="form_err">Please, check your form for errors.</p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
