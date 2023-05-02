<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/php-classes/patients/patientsHistory.php';
$pHis = new PatientHistory();
$pid = $_GET['p_id'];
$regular_checkup_obj = $pHis->get_checkupHis($pid);
$regular_checkup_arr = json_decode($regular_checkup_obj);
?>

<form action="" method="post">
    <div class="row">
        <h2 class="page-heading">
            Update Regular chekup
        </h2>
        <div class="col-md-12">
            <fieldset class="bg_form_blue">
                <div class="patient-history-wrap">


                <div class="d-flex flex-wrap gap-20 justify-content-center ">
                        <div class="d-flex flex-48">
                            <div class="mb-3 d-flex gap-20 w-100">
                                <div class="w-100 flex-48 ">
                                    <label for="patient_height_foot"> Patient Height(in foot)</label>
                                    <select name="patient_height_foot" id="patient_height_foot" class="form-select form-field" required>
                                        <option value="">Select foot</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                                <div class="w-100 flex-48 ">
                                    <label for="patient_height_inch">Patient Height(in inches)</label>
                                    <select name="patient_height_inch" id="patient_height_inch" class="form-field form-select">
                                        <option value="">Select inches</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <!-- <input type="text" name="patient_height" id="Patient-Height" class="form-control form-field" required> -->
                            </div>
                        </div>
                        <div class="d-flex flex-48">
                            <div class="mb-3 w-100">
                                <label for="Patient-Weight">Patient Weight</label>
                                <input type="text" name="patient_weight" id="Patient-Weight" class="form-control form-field" required>
                            </div>
                        </div>
                        <div class="d-flex flex-48">
                            <div class="mb-3 w-100">
                                <label for="Patient-bp">Patient Blood Pressure</label>
                                <input type="text" name="patient_bp" id="Patient-bp" class="form-control form-field" required>
                            </div>
                        </div>
                        <div class="d-flex flex-48">
                            <div class="mb-3 w-100">
                                <label for="Patient-Diabetes">Patient Diabetes</label>
                                <input type="text" name="patient_diabetes" id="Patient-Diabetes" class="form-control form-field" required>
                            </div>
                        </div>
                        <div class="d-flex flex-33">
                            <div class="mb-3 w-100">
                                <label for="Patient-pulse-rate">Pulse Rate</label>
                                <input type="text" name="pulse_rate" id="Patient-pulse-rate" class="form-control form-field" required>
                            </div>
                        </div>
                        <div class="d-flex flex-33">
                            <div class="mb-3 w-100">
                                <label for="Patient-SPOF">SPOF</label>
                                <input type="text" name="patient_SPOF" id="Patient-SPOF" class="form-control form-field" required>
                            </div>
                        </div>
                        <div class="d-flex flex-33">
                            <div class="mb-3 w-100">
                                <label for="Patient-Oxygen">Oxygen</label>
                                <input type="text" name="patient_oxygen" id="Patient-Oxygen" class="form-control form-field" required>
                            </div>
                        </div>
                    </div>

                
                    <div class="mb-3 mt-2">
                        <button class="btn btn-blue d-block w-20 mx-auto update-regular-checkup" role="button" type="submit">Update</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <input type="hidden" name="p_id" value="<?php echo $pid; ?>">
</form>
<div class="mt-3" id="">
    <table class="table align-middle mb-3 table-blue" id="RegularCheckup">
        <thead>
            <tr>
                <th colspan="5">
                    <h3 class="text-center">
                        Regular checkup History For Patient Id <?php echo $pid ;?>
                    </h3>
                </th>
            </tr>
            <tr>
                <th class="th-width-12" >Date</th>
                <th class="th-width-12">Height</th>
                <th class="th-width-12">Weight</th>
                <th class="th-width-12">Bp</th>
                <th class="th-width-12">Diabetes</th>
                <th class="th-width-12">Pulse Rate</th>
                <th class="th-width-12">SPOF</th>
                <th class="th-width-12">Oxygen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($regular_checkup_arr)){
            foreach ($regular_checkup_arr as $key => $value) {
            ?>
                <tr>
                    <td>
                        <?php
                        $datetime = explode('_',$key);
                        unset($datetime[5]);
                        unset($datetime[4]);
                        unset($datetime[3]);
                        $date_ ='';
                        foreach($datetime as $date){
                            $date_ .= $date."-";
                        }
                        echo rtrim($date_,'-');
                        ?>
                    </td>
                    <?php
                    foreach ($value as $k => $v) {
                        if($k === 'time' || $k === 'date' ){

                        }
                        else{
                            echo  "<td>" . $v . "</td>";

                        }
                    }
                    ?>
                </tr>
            <?php
            }
        }
        else{
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