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

    $patientTreatSym = new PatientsTreatmentSymptom();
    $all_cols = $patientTreatSym->get_Db_cols($patient_id);
    if ($all_cols !== false) {
        if ($all_cols->num_rows > 0) {
            while ($row = $all_cols->fetch_assoc()) {
                $hospital_pMeds = $row['hospital_pMeds'];
                $hospital_pSym = $row['hospital_pSym'];
                $hospital_phistory = $row['hospital_phistory'];
            }
        }
    }
} else {
    exit();
}

?>

<input type="hidden" value="<?php echo $patient_id; ?>" id="patient-id">
<fieldset>
    <div class="row">
        <div class="col-md-6">
            <h2>Primary Information</h2>
        </div>
        <div class="col-md-6">
            <div class="text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-edit="primary-information"><i class="fa fa-pencil"></i></button>
            </div>
        </div>
    </div>
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
<div class="row">
        <div class="col-md-6">
            <h2>Medical History</h2>
        </div>
        <div class="col-md-6">
            <div class="text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-edit="medical-history"><i class="fa fa-pencil"></i></button>
            </div>
        </div>
    </div>
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
                            <td colspan="3">
                                <h3 class="text-center">
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
<fieldset>
    <div class="mt-3" id="">
        <h2>Regular checkup</h2>
        <table class="table table-bordered table-responsive table-striped" id="RegularCheckup">
            <thead class="bg-light">
                <tr>
                    <th class="th-width-20">Date</th>
                    <th class="th-width-20">Height</th>
                    <th class="th-width-20">Weight</th>
                    <th class="th-width-20">Bp</th>
                    <th class="th-width-20">Diabetes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($hospital_phistory)) {
                    $hospital_phistory_arr = json_decode($hospital_phistory, true);
                    foreach ($hospital_phistory_arr as $key => $value) {
                ?>
                        <tr>
                            <td>
                                <?php
                                $datetime = explode('_', $key);
                                unset($datetime[5]);
                                unset($datetime[4]);
                                unset($datetime[3]);
                                $date_ = '';
                                foreach ($datetime as $date) {
                                    $date_ .= $date . "-";
                                }
                                echo rtrim($date_, '-');
                                ?>
                            </td>
                            <?php
                            foreach ($value as $k => $v) {
                                echo  "<td>" . $v . "</td>";
                            }
                            ?>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td>
                            <h3>
                                No Data availabale
                            </h3>
                        </td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
        </table>
    </div>
</fieldset>
<fieldset class="mt-3">
    <h2>Hospital TreatMent History</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table align-middle mb-3 table-striped table-bordered" id="symptom-table">
                <thead class="bg-light">
                    <tr>
                        <th class="th-width-16">Date</th>
                        <th class="text-center" colspan="5"><b>Meds Data</b></th>
                        <th class="th-width-16">Follow up</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($hospital_pMeds)) {
                        $meds = json_decode($hospital_pMeds, true);
                        foreach ($meds as $key => $value) {
                    ?>
                            <tr>
                                <td>
                                    <?php echo $value['date']; ?>
                                </td>
                                <td colspan="5">
                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <th class="th-width-16">Medicine Name</th>
                                                <th class="th-width-16">Dosage</th>
                                                <th class="th-width-16">Pattern</th>
                                                <th class="th-width-16">Notes</th>
                                                <th class="th-width-16">Tests</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                <?php
                                                    $medicine_name = explode(",", $value['medicine_name']);
                                                    for ($i=0; $i < count($medicine_name) ; $i++) { 
                                                        ?>
                                                        <li class="list-style-none"><?php echo $medicine_name[$i];?></li>
                                                        <?php
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php
                                                    $meds_qty = explode(",", $value['medicine_qty']);
                                                    $meds_vol = explode(",", $value['medicine_volume']);
                                                    for ($i=0; $i < count($meds_qty) ; $i++) { 
                                                        ?>
                                                        <li class="list-style-none"><?php echo $meds_qty[$i] . $meds_vol[$i];?></li>
                                                        <?php
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php
                                                    $pattern_arr =  explode(',',$value['medicine_pattern']);
                                                    for ($i=0; $i < count($pattern_arr) ; $i++) { 
                                                        ?>
                                                        <li class="list-style-none"><?php echo $pattern_arr[$i];?></li>
                                                        <?php
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php
                                                    $notes = explode(',',$value['medicine_notes']);
                                                    for ($i=0; $i < count($notes) ; $i++) { 
                                                        ?>
                                                        <li class="list-style-none"><?php echo $notes[$i];?></li>
                                                        <?php
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($value['medicine-test'])) {
                                                        echo preg_replace('/-/', ' ', $value['medicine-test']);
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <?php echo $value['follow_up_date']; ?>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7">
                                <h3 class="text-center">
                                    No Medicine History Found
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
<fieldset class="mt-3">
    <h2>Hospital Symptom History</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table align-middle mb-3 table-striped table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th class="th-width-20">Symptoms</th>
                        <th class="th-width-20">Status</th>
                        <th class="th-width-20">No of Days</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($hospital_pSym)) {
                        $syms = json_decode($hospital_pSym, true);
                        foreach ($syms as $key => $value) {
                    ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $value['symptom_name'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $value['symptom_type'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $value['symptom_days'];
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">
                                <h3 class="text-center">
                                    No Symptom History Found
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

<?php require_once './form-symptoms.php'; ?>
<?php require_once './form-treatment.php'; ?>




<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>