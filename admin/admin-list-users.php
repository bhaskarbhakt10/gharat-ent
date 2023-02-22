
<div class="d-flex flex-wrap gap-20">
<?php
$json_file = file_get_contents('../admin/json/roles.json');
$json_obj = json_decode($json_file);
foreach ($json_obj as $array) {
?>
    <div class="users-wrap">
        <a href="index.php?q=admin-list-table-users&user-rank=<?php echo $array->rank;?>">
            <div class="d-flex flex-wrap gap-10">
                <div class="user-icon d-flex">
                    <i class="<?php echo $array->icon; ?>"></i>
                </div>
                <div class="user-count d-flex">
                <p>
                    <?php echo $admin->get_user_count_by_role($array->rank);?>    
                </p>    
                </div>
            </div>
            <div class="user-heading">
                <h3>
                    <?php echo $array->role ;?>
                </h3>
            </div>
        </a>
    </div>
<?php
}
?>
</div>