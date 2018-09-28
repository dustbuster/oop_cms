<?php include("includes/header.php"); ?>
<?php
require_once('includes/init.php');
$session->logout();
redirect('login.php?logout=true');
?>
<div class="col-sm-6">
    <h4 class="warning-mess">
        logging out...
    </h4>    
</div>
    

<?php include("includes/footer.php"); ?>