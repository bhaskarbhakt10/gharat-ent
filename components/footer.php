<?php require_once 'title.php' ;?>
<?php require_once '../../backend/constants/constants-static.php'; ?>

<footer>
    <script src="<?php echo BASE_URL ;?>assets/js/jquery.script.jQuery.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL ;?>assets/js/script.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL ;?>assets/js/script.select2.min.js" type="text/javascript"></script>
    
    <script src="<?php echo BASE_URL ;?>assets/js/jquery.script.main.js" type="text/javascript"></script>
    
    
    <?php
    $file_name_script = "./js/script." . enqueue_script_css() . ".js";
    $file_name_script_jquery = "./js/jquery.script." . enqueue_script_css() . ".js";
    if (file_exists($file_name_script)) {
    ?>
        <script src="<?php echo $file_name_script; ?>" type="text/javascript"></script>
    <?php }
    if (file_exists($file_name_script_jquery)) {

    ?>
        <script src="./js/jquery.script.<?php echo enqueue_script_css(); ?>.js" type="text/javascript"></script>
    <?php } ?>

    <script src="<?php echo BASE_URL ;?>components/js/jquery.script.component.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL ;?>components/js/script.component.js" type="text/javascript"></script>
</footer>
</body>

</html>