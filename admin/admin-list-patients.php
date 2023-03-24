<?php

$patients = new Patients();
$all_details = $patients->get_list_patients();
?>
<div class="">
    <h2 class="page-heading">List Patients</h2>
</div>
<table class="w-100 table table-borderd table-blue table-blue-striped datatable">
    <thead>
        <th>
            Patient ID
        </th>
        <th>
            Full Name
        </th>
        <th>
            Email
        </th>
        <th>
            Phone
        </th>
        <th>
            Action
        </th>
    </thead>
    <tbody>
        <?php
        if($all_details !== false){
        if ($all_details->num_rows > 0) {
            while ($row = $all_details->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row['hospital_PatientId']; ?></td>
                    <td><?php echo $row['hospital_PatientSuffix'] . " " . $row['hospital_PatientFirstName'] . " " . $row['hospital_PatientMiddleName'] . " " . $row['hospital_PatientLastName']; ?></td>
                    <td><?php echo $row['hospital_PatientEmail'];  ?></td>
                    <td><?php echo $row['hospital_PatientContactNumber'];  ?></td>
                    <td class="d-flex justify-content-between">
                        <a class="btn btn-primary border-radius-50p" href="index.php?q=admin-single-patient&p_id=<?php echo $row['hospital_PatientId']; ?>">Prescrition</a>
                        <a class="btn btn-success border-radius-50p" href="index.php?q=admin-update-daily-check-up&p_id=<?php echo $row['hospital_PatientId']; ?>">Checkup</a>
                        <a class="btn btn-outline-primary border-radius-50p" href="index.php?q=admin-edit-patients&p_id=<?php echo $row['hospital_PatientId']; ?>">Edit Data</a>
                    </td>
                </tr>
        <?php
            }
        }
    }
        ?>
    </tbody>
</table>