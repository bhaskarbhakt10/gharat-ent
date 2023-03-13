<?php
if (array_key_exists('p_id', $_GET)) {
    $patient_id = $_GET['p_id'];
    $patientTreatSym = new PatientsTreatmentSymptom();
    $all_cols = $patientTreatSym->get_Db_cols($patient_id);
    if ($all_cols !== false) {
        if ($all_cols->num_rows > 0) {
            while ($row = $all_cols->fetch_assoc()) {
                $hospital_pMeds = $row['hospital_pMeds'];
            }
        }
    }
}
else{
    exit();
}

?>
<div class="d-flex flex-wrap gap-10">
    <?php
if(!empty($hospital_pMeds)){
$prescription = json_decode($hospital_pMeds, true);
foreach ($prescription as $key => $value) {
    ?>
    <div class="mb-3 text-center">
        <a class="btn btn-primary" href="index.php?q=template-prescription&ID=<?php echo $value['ID'];?>">Visit on <?php echo $value['date'];?></a>
        <p>Visit at <b><?php echo $value['time'];?></b></p>
    </div>
    <?php
}
}
else{
    ?>
    <h2 class="text-center">No Prescription Found</h2>
    <?php
}
?>
</div>
