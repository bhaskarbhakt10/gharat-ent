<?php require_once 'title.php'?>
<?php require_once '../../backend/constants/constants-static.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_title(); ?> | Avannah Hospital </title>
    <!-- <link rel="stylesheet" href="../../assets/css/style.bootstrap.css"> -->
    <link rel="stylesheet" href="<?php echo BASE_URL ;?>assets/css/style.material-bootstrap.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ;?>assets/css/style.font-awsome-pro.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ;?>assets/css/style.webfonts.css">
    
    
    <!-- dependicies -->
    <link rel="stylesheet" href="<?php echo BASE_URL ;?>assets/css/style.select2.min.css">
    <!-- dependicies -->
    

    <link rel="stylesheet" href="<?php echo BASE_URL ;?>assets/css/style.main.css">
    <?php 
    $file_name_css = "./css/style.".enqueue_script_css().".css";
    if(file_exists($file_name_css)){
       ?>
        <link rel="stylesheet" href="<?php echo $file_name_css ;?>">
        <?php
    }
    ?>
    
    <link rel="stylesheet" href="<?php echo BASE_URL ;?>components/css/style.component.css">
</head>
<body>