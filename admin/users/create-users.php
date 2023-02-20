<?php require_once '../../components/header.php'; ?>
<?php require_once '../../backend/constants/constants-static.php'; ?>

<main class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                sidebar goes here
            </div>
            <div class="col-md-10">
                <div class="wrapper viewport w-80">
                    <form action="../../backend/actions/users/create-users.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="First-name"> First Name</label>
                                    <input type="text" name="first_name" id="First-name" class="form-control form-field" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Last-name">Last Name</label>
                                    <input type="text" name="last_name" id="Last-Name" class="form-control form-field" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Phone-Number"> Phone Number</label>
                                    <input type="tel" name="phone_number" id="Phone-number" class="form-control form-field" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Email"> Email </label>
                                    <input type="email" name="email" id="Email" class="form-control form-field" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="UserName">User Name</label>
                                    <input type="text" name="username" id="UserName" class="form-control form-field" placeholder="User name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="UserPassword"> Password</label>
                                    <input type="password" name="password" id="UserPassword" class="form-control form-field" placeholder="Create Password">
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

                                <label for="Select-rank"></label>
                                <select name="rank" id="Select-rank" class="form-select form-field">
                                    <option value="" hidden disabled selected></option>
                                    <option value="1">Admin</option>
                                    <option value="2">Staff</option>
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
            </div>
        </div>
    </div>
</main>
<?php require_once '../../components/footer.php'; ?>