<?php

$patients = new Patients();
$all_details = $patients->get_list_patients();
?>
<div class="row">
    <div class="col-md-12">
        <h2 class="page-heading text-center ">Patients List</h2>
    </div>
    <div class="col-md-12">
        <a href="index.php?q=admin-add-patients" class="btn btn-primary text-uppercase border-radius-50p">Add Patient</a>
    </div>
</div>
<table class="w-100 table table-borderd table-blue table-blue-striped datatable display nowrap responsive">
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
                    <td>
                        <div class="d-flex justify-content-between action-buttons">
                            <a class="btn btn-primary border-radius-50p" href="index.php?q=admin-single-patient&p_id=<?php echo $row['hospital_PatientId']; ?>">Prescription</a>
                            <a class="btn btn-success border-radius-50p" href="index.php?q=admin-update-daily-check-up&p_id=<?php echo $row['hospital_PatientId']; ?>">Checkup</a>
                            <a class="btn btn-outline-primary border-radius-50p" href="index.php?q=admin-edit-patients&p_id=<?php echo $row['hospital_PatientId']; ?>">Edit Data</a>
                        </div>
                    </td>
                </tr>
        <?php
            }
        }
    }
        ?>
    </tbody>
</table>