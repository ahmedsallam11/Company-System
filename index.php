<?php 
require_once "config.php"; 
require_once "init.php";
?>
<?php require_once STYLE_DIR."/header.php" ?> 
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php require_once STYLE_DIR."/sidebar.php" ?> 
                    <aside class="right-side">
                <!-- Main content -->
     <section style="background:white;min-height:600px;" class="content">
     <!-- Main row -->
<div class="row">    
<?php 
$a = new Url();
$f = $a->get_page("page"); ?>
<?php require_once STYLE_DIR."/footer.php" ?> 