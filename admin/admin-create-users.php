<?php 
$json_file = file_get_contents('./json/roles.json');
$json_obj = json_decode($json_file);



?>
                <div class="w-80">
                    <form action="../backend/actions/users/create-users.php" method="POST" enctype="multipart/form-data">
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
                                    foreach($json_obj as $arr){
                                        ?>
                                        <option value="<?php echo $arr->rank;?>"><?php echo $arr->role; ?></option>
                                        <?php
                                        
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-5">
                                    <button class="btn btn-blue d-block w-50" name="create-user" type="submit">Create User</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            