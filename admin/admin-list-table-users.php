<?php
if(array_key_exists('user-rank', $_GET)){
    $user_rank = $_GET['user-rank'];
    $all_details = $admin->details_by_role($user_rank);
}
else{
    exit();
}
?>
<table class="w-100 table table-borderd">
    <thead>
        <th>
            UserId
        </th>
        <th>
            First Name 
        </th>
        <th>
            Last Name 
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
        if($all_details->num_rows > 0){
            while($row = $all_details->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['hospital_UserId']; ?></td>
                    <td><?php echo $row['hospital_UserFirstName']; ?></td>
                    <td><?php echo $row['hospital_UserLastName']; ?></td>
                    <td><?php echo $row['hospital_UserPhone']; ?></td>
                    <td><?php echo $row['hospital_UserEmail']; ?></td>
                    <td>
                        <button class="btn btn-primary">edit</button>
                        <button class="btn btn-warning">Suspend</button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>