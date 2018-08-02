<?php
include 'header.php';
include 'db_auth.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($db, $_POST['Username']);
    $mypassword = md5((mysqli_real_escape_string($db, $_POST['Password'])));
    echo $mypassword;

    $sql = "SELECT * FROM user WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        $_SESSION['user'] = $myusername;
        $_SESSION['role'] = $row['designation'];

        header("location: index.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}

?>
<br>
<br>
<style>
    body {
    }
</style>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary" style="height: 85vh">
            <div class="text-center">
                <P style="font-weight:bold; color:white; background-image: linear-gradient(to left bottom, #005de9, #008dff, #00b5ff, #00d7fb, #00f6eb); padding:10px;">
                    Murang'a Hospital Login</P>
            </div>
            <div class="panel-body">
                <div class="text-center"><img style="width:30%;" src="cust/images/logo.png"/></div>

                <section>
                    <form ur method="post">
                        <h4>Use you facility local account to log in.</h4>
                        <hr/>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Username</span>
                            <input type="text" name="Username" class="form-control" placeholder="Systems"
                                   aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Password</span>
                            <input type="Password" name="Password" class="form-control" placeholder="Password"
                                   aria-describedby="basic-addon1">
                        </div>
                        <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                        <div class="input-group">
                            <button type="submit" class="btn btn-sm btn-primary">Login</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>

