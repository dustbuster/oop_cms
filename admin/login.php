<?php include("includes/header.php"); ?>
<?php
require_once('includes/init.php');

if($session->is_signed_in()){
    redirect('index.php');
}

if(isset($_POST['submit'])):
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);



    // Method to check the database user
    $user_found = User::verify_user($user_name, $password);
    

    if($user_found):
        $session->login($user_found);
        redirect('index.php?dingle=true');
    else:
        $the_message = 'You got the wrong password and/or user name!';
    endif;
else:
    $the_message = 'login please!';
    $username = '';
    $password = '';
endif;

?>
<div class="col-md-4 col-md-offset-3">
    <h4 class="warning-mess">
        <?=$the_message?>
    </h4>
    <form id="login-id" action="" method="post">
        <div class="form-group">
            <label style="color: #efefef" for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?=htmlentities($username)?>" >
        </div>
        <div class="form-group">
            <label style="color: #efefef" for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?=htmlentities($password)?>">   
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>
</div>
<?php include("includes/footer.php"); ?>