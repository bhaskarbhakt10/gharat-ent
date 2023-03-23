<form action="" method="POST">

    <?php
    require_once 'admin-patient-primary-details.php';
    ?>
    <?php if(!empty($_GET['p_id'])){?>
    <input type="hidden" name="update_id" value="<?php echo $_GET['p_id'];?>">
        <?php } ?>
    <div class="">
        <button class="btn btn-blue d-block w-20 mx-auto d-fieldset" name="add-patient" id="add-patient" type="submit" data-attr="edit">Add Patient</button>
    </div>
</form> 