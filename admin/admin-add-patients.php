<div class="">
    <h2 class="page-heading">Add Patients</h2>
</div>
<form action="" method="POST" class="add-patients">

    <?php
    require_once 'admin-patient-primary-details.php';
    require_once 'admin-patient-medical-history.php';
    require_once 'admin-patient-regular-checkup.php';
    ?>


    <div class="">
        <button class="btn btn-blue d-block w-20 w-m80 mx-auto d-fieldset submit" name="add-patient" id="add-patient" type="submit" data-attr="add">Add Patient</button>
    </div>
</form>