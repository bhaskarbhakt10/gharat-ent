<?php
$users = $admin->List_users();


?>
<h2>Access control </h2>
<table class="w-100 table table-borderd">
    <thead>
        <tr>
            <th>
                User Id
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
                Role
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($users !== false){
            if($users->num_rows> 0){
                while($row = $users->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['hospital_UserId'] ;?></td>
                        <td><?php echo $row['hospital_UserFirstName']. " " . $row['hospital_UserLastName'] ;?></td>
                        <td><?php echo $row['hospital_UserEmail'] ;?></td>
                        <td><?php echo $row['hospital_UserPhone'] ;?></td>
                        <td><?php echo $admin->get_users_role_to_access($row['hospital_UserId']);?></td>
                        <td><a href="index.php?q=admin-update-access&id=<?php echo $row['hospital_UserId'] ;?>" class="btn btn-primary">Update Access</a></td>
                    </tr>
                <?php
            }
            }
        }
        ?>
    </tbody>
</table>