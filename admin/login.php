<?php include("includes/header.php"); ?>
<?php
require_once('includes/init.php');

if($session->is_signed_in()){
    echo 'PREVIOUSLY LOGGED IN!';
    echo $_SESSION['user_id'];
    header('Location: index.php');
}

echo $session->is_signed_in();

if(isset($_POST['submit'])):
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Method to check the database user
    $user_found = User::verify_user($username, $password);

    if($user_found):
        $session->login($user_found);
        echo 'LOGGED IN!!';
        redirect('index.php?dingle=true');
    else:
        $the_message = 'You got the wrong password and/or user name!';
    endif;
else:
    $username = '';
    $password = '';
endif;

if(isset($_GET['logout'])){
    $the_message = 'You have been logged out!';
}else{
    $the_message = 'Welcome!';
}

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