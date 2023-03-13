<?php

if (array_key_exists('ID', $_GET)) {
    $prescription_id = $_GET['ID'];
    $presc_arr = explode('_', $prescription_id);
    array_pop($presc_arr);
    $patient_id = implode('_', $presc_arr);
    $patientTreatSym = new PatientsTreatmentSymptom();
    $all_cols = $patientTreatSym->get_Db_cols($patient_id);
    if ($all_cols !== false) {
        if ($all_cols->num_rows > 0) {
            while ($row = $all_cols->fetch_assoc()) {
                $hospital_pMeds = $row['hospital_pMeds'];
            }
        }
    }
} else {
    exit();
}

if (!empty($hospital_pMeds)) {
    $prescription = json_decode($hospital_pMeds, true);
    foreach ($prescription as $key => $value) {
        if ($value['ID'] === $prescription_id) {
            // print_r($prescription[$key]);
            $medicine_name = $prescription[$key]['medicine_name'];
            $medicine_qty = $prescription[$key]['medicine_qty'];
            $medicine_volume = $prescription[$key]['medicine_volume'];
            $medicine_pattern = $prescription[$key]['medicine_pattern'];
            $medicine_notes = $prescription[$key]['medicine_notes'];
            $medicine_test = $prescription[$key]['medicine-test'];
            $follow_up_date = $prescription[$key]['follow_up_date'];
            $date = $prescription[$key]['date'];
        }
    }
    // print_r($medicine_name);
    // print_r($medicine_qty);
    // print_r($medicine_volume);
    // print_r($medicine_pattern);
    // print_r($medicine_notes);
}
?>
<button class="btn btn-primary save-pdf" onclick="generatePdf()">Download</button>
<button class="btn print print_pdf">Print Pdf</button>
<table class="table" id="download-prescription">
    <tbody>
        <tr>
            <td>
            <table class="" style="width: 85%;margin:auto">
                <thead>
                    <tr>
                        <th style="width:25%;padding:10px 0; border-bottom:1px solid #ccc;text-align:left;">Medicine Name</th>
                        <th style="width:25%;padding:10px 0; border-bottom:1px solid #ccc;text-align:left;">Dosage</th>
                        <th style="width:25%;padding:10px 0; border-bottom:1px solid #ccc;text-align:left;">Pattern</th>
                        <th style="width:25%;padding:10px 0; border-bottom:1px solid #ccc;text-align:left;">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            $medicine_name_arr = explode(',', $medicine_name);
                            foreach ($medicine_name_arr as $med_name) {
                            ?>
                                <table class="" style="width:100%; ">
                                    <tr>
                                        <td style="padding:10px 0;">
                                            <?php echo $med_name; ?>
                                        </td>
                                    </tr>
                                </table>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $medicine_qty_arr = explode(',', $medicine_qty);
                            $medicine_volume_arr = explode(',', $medicine_volume);
                            foreach ($medicine_qty_arr as $key => $med_qty) {
                            ?>
                                <table class="" style="width:100%; ">
                                    <tr>
                                        <td style="padding:10px 0;">
                                            <?php echo $med_qty .  $medicine_volume_arr[$key]; ?>
                                        </td>
                                    </tr>
                                </table>
                            <?php
                            }

                            ?>
                        </td>
                        <td>
                        <?php
                            $medicine_pattern_arr = explode(',', $medicine_pattern);
                            foreach ($medicine_pattern_arr as $key => $med_pattern) {
                            ?>
                                <table class="" style="width:100%; ">
                                    <tr>
                                        <td style="padding:10px 0;">
                                            <?php echo $med_pattern; ?>
                                        </td>
                                    </tr>
                                </table>
                            <?php
                            }

                            ?>
                        </td>
                        <td>
                        <?php
                            $medicine_notes_arr = explode(',', $medicine_notes);
                            foreach ($medicine_notes_arr as $key => $med_notes) {
                            ?>
                                <table class="" style="width:100%; ">
                                    <tr>
                                        <td style="padding:10px 0;">
                                            <?php echo $med_notes; ?>
                                        </td>
                                    </tr>
                                </table>
                            <?php
                            }

                            ?>
                        </td>

                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </tbody>
</table>

