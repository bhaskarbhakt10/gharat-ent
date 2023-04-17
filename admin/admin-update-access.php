<form action="" id="update-access">
    <fieldset class="my-3">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Users
                </h3>
            </div>
            <div class="col-md-12">
                <div class="d-flex gap-10">
                    <div class="">
                        <input type="checkbox" name="admin-create-users" id="create-users" class="form-check-input" value="admin-create-users">
                        <label for="create-users">Can Create Users</label>
                    </div>
                    <div class="">
                        <input type="checkbox" name="admin-create-users" id="update-users" class="form-check-input" value="">
                        <label for="update-users">Can update Users</label>
                    </div>
                    <div class="">
                        <input type="checkbox" name="admin-list-table-users" id="suspend-users" class="form-check-input" value="">
                        <label for="suspend-users">Can Suspend Users</label>
                    </div>
                    <div class="">
                        <input type="checkbox" name="admin-list-users" id="view-users" class="form-check-input" value="admin-list-users">
                        <label for="view-users">Can View Users</label>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="my-3">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Patients
                </h3>
            </div>
            <div class="col-md-12">
                <div class="d-flex gap-10">
                    <div class="">
                        <input type="checkbox" name="" id="create-patients" class="form-check-input">
                        <label for="create-patients">Can Create Patients</label>
                    </div>
                    <div class="">
                        <input type="checkbox" name="" id="update-patients" class="form-check-input">
                        <label for="update-patients">Can update Patients</label>
                    </div>
                    <div class="">
                        <input type="checkbox" name="" id="suspend-patients" class="form-check-input">
                        <label for="suspend-patients">Can Delete Patients</label>
                    </div>
                    <div class="">
                        <input type="checkbox" name="" id="view-patients" class="form-check-input">
                        <label for="view-patients">Can View Patients</label>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="text-center">
        <button class="btn btn-primary update-access">Update Access</button>
    </div>
</form>