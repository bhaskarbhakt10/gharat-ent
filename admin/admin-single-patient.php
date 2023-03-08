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
            $medicalHistory = $row['hospital_PatientMedicalHistory'];
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
    <fieldset class="mt-3">
        <h2>Medical History</h2>
        <div class="row">
            <?php
            //converting the json to array
            $medicalHistoryArr = json_decode($medicalHistory, true);
            //setting to new varibale to create two diffrent array one for tretments and other for surgery
            $medicalHistoryTableArr = $medicalHistoryArr;
            //unsetting the addiction and healting condition field in new array
            unset($medicalHistoryTableArr['patient_addiction']);
            unset($medicalHistoryTableArr['patient_health_condition']);

            $past_treatment_arr = array();
            $past_surgery_arr = array();
            foreach ($medicalHistoryTableArr as $med) {

                foreach ($med as $tk => $tv) {
                    if (preg_match('/past_treatment/', $tk)) {
                        $past_treatment_arr[$tk] = $tv;
                    }
                }
                foreach ($med as $ps => $pv) {
                    if (preg_match('/past_surgeries/', $ps)) {
                        $past_surgery_arr[$ps] = $pv;
                    }
                }
            }
            // print_r($past_treatment_arr);
            // print_r($past_surgery_arr);

            ?>
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="">Addiction/Habbit</label>
                        <input type="text" name="" id="" class="form-control form-field" readonly value="<?php echo $medicalHistoryArr['patient_addiction']; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Chronic Ailments/Health Condition</label>
                    <input type="text" name="" id="" class="form-control form-field" readonly value="<?php echo $medicalHistoryArr['patient_health_condition']; ?>">
                </div>
            </div>
            <div class="col-md-12">
                    <table class="table align-middle mb-3 table-striped table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th class="th-width-33">Past Treatment</th>
                                <th class="th-width-33">Past Treatment Start</th>
                                <th class="th-width-33">Past Treatment End Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (!empty($past_treatment_arr)) {
                                foreach ($past_treatment_arr as $treatmentHis => $treatmentValue) {
                                    if (preg_match('/past_treatment_\d/', $treatmentHis)) {
                                        echo "<tr open here>";
                                    }
                            ?>
                                    <td><?php echo $treatmentValue; ?></td>
                                <?php
                                    if (preg_match('/past_treatment_end_date_\d/', $treatmentHis)) {
                                        echo "</tr close here>";
                                    }
                                }
                            } else {
                                ?>
                                <tr>
                                    <td>
                                        <h3>
                                            No TreatMent Found
                                        </h3>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>


            </div>
            <div class="col-md-12">

                <table class="table align-middle mb-3 table-striped table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th class="th-width-33">Past Surgery</th>
                            <th class="th-width-33">Past Surgery Start</th>
                            <th class="th-width-33">Past Surgery End Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (!empty($past_surgery_arr)) {
                            foreach ($past_surgery_arr as $surgeryHis => $surgeryValue) {
                                if (preg_match('/past_surgeries\d/', $surgeryHis)) {
                                    echo "<tr open here>";
                                }
                        ?>
                                <td><?php echo $surgeryValue; ?></td>
                            <?php
                                if (preg_match('/past_surgeries_end_date_\d/', $surgeryHis)) {
                                    echo "</tr close here>";
                                }
                            }
                        } else {

                            ?>
                            <tr>
                                <td colspan="3">
                                    <h3 class="text-center">
                                        No Surgery Found
                                    </h3>

                                </td>
                            </tr>
                        <?php

                        }
                        ?>

                    </tbody>
                </table>



            </div>
        </div>
    </fieldset>

</form>