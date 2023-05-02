<?php
$json_file = file_get_contents('./json/roles.json');
$json_obj = json_decode($json_file);

foreach ($json_obj as $arr) {
    if ($arr->rank === 2) {
        foreach ($arr->specialization as $s) {
            echo $s->specialization_name;
        }
    }
}


?>
<div class="pb-2 mb-2">
    <h2 class="page-heading">Create Users</h2>
</div>
<fieldset class="fieldset bg_form_blue">
    <div class="w-100">
        <form action="<?php $uri = explode('/', $_SERVER['REQUEST_URI']);
                        echo '/' . $uri[1] . "/backend/actions/users/create-users.php"; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="First-name"> First Name</label>
                        <input type="text" name="first_name" id="First-name" class="form-control form-field" placeholder="First Name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Last-name">Last Name</label>
                        <input type="text" name="last_name" id="Last-Name" class="form-control form-field" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Phone-Number"> Phone Number</label>
                        <input type="tel" name="phone_number" id="Phone-number" class="form-control form-field" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Email"> Email </label>
                        <input type="email" name="email" id="Email" class="form-control form-field" placeholder="Email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="UserName">User Name</label>
                        <input type="text" name="username" id="UserName" class="form-control form-field" placeholder="User name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="UserPassword"> Password</label>
                        <input type="password" name="password" id="UserPassword" class="form-control form-field" placeholder="Create Password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="image-preview"></div>
                        <div class="image-upload">
                            <label for="PictureUpload"> Upload an Image</label>
                            <input type="file" name="profile_picture" id="PictureUpload" class="form-control form-field image-upload">
                        </div>
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class="mb-3">

                        <label for="Select-rank"> Select a Role</label>
                        <select name="rank" id="Select-rank" class="form-select form-field" required>
                            <option value="" hidden disabled selected>Select a Role</option>
                            <?php
                            foreach ($json_obj as $arr) {
                            ?>
                                <option value="<?php echo $arr->rank; ?>"><?php echo $arr->role; ?></option>
                            <?php

                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class=" col-md-6" id="specialization">
                    <div class="mb-3"> 
                        <label for="Select-specialization"> Select Specialization</label>
                        <select name="specialization" id="Select-specialization" class="form-select form-field">
                            <option value="" hidden disabled selected>Select a Specialization</option>
                            <?php
                            foreach ($json_obj as $arr) {
                                if ($arr->rank === 2) {
                                    foreach ($arr->specialization as $s) {
                                        echo $s->specialization_name;
                            ?>
                                        <option value="<?php echo $s->specialization_code; ?>"><?php echo $s->specialization_name; ?></option>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="mt-5">
                        <button class="btn btn-blue d-block btn-bg-blue-theme w-50" name="create-user" type="submit">Create User</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</fieldset>