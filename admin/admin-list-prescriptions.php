

<?php

$patients = new Patients();
$all_details = $patients->get_list_patients();
?>
<table class="w-100 table table-borderd">
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
                        <a class="btn btn-primary" href="index.php?q=admin-single-prescription&p_id=<?php echo $row['hospital_PatientId']; ?>">View All</a>
                    </td>
                </tr>
        <?php
            }
        }
    }
        ?>
    </tbody>
</table>