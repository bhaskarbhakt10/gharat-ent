<?php
if (array_key_exists('p_id', $_GET)) {
    $patient_id = $_GET['p_id'];
    $patients = new Patients();
    $patient_genral_details = $patients->get_genral_detials($patient_id);
    if ($patient_genral_details->num_rows > 0) {
        while ($row = $patient_genral_details->fetch_assoc()) {
            $full_name = $row['hospital_PatientSuffix'] . " " . $row['hospital_PatientFirstName'] . " " . $row['hospital_PatientMiddleName'] . " " . $row['hospital_PatientLastName'];
            $phone_number = $row['hospital_PatientContactNumber'];
            $email = $row['hospital_PatientEmail'];
            $gender = $row['hospital_PatientGender'];
            $date_of_birth = $row['hospital_PatientDOB'];
            $address = $row['hospital_PatientAddress'];
        }
    }
} else {
    exit();
}

?>
<form action="" method="post">

    <fieldset>
        <h2>Primary Information</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="">First Name</label>
                    <input type="text" name="" id="" class="form-control form-field" readonly value="<?php echo $full_name ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="">Gender</label>
                    <input type="text" name="" id="" class="form-control form-field" readonly value="<?php echo $gender; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="">DOB</label>
                    <input type="text" name="" id="" class="form-control form-field" readonly value="<?php echo $date_of_birth; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="">Age</label>
                    <?php
                    $date = new DateTime();
                    $current_year = $date->format('Y-m-d');
                    $origin = date_create($date_of_birth);
                    $target = date_create($current_year);
                    $interval = date_diff($origin, $target);
                    $age = $interval->y;
                    ?>
                    <input type="text" name="" id="" class="form-control form-field" readonly value="<?php echo $age; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Contact Number</label>
                    <input type="text" name="" id="" class="form-control form-field" readonly value="<?php echo $phone_number; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" name="" id="" class="form-control form-field" readonly value="<?php echo $email; ?>">
                </div>
            </div>
        </div>
    </fieldset>

    
</form>