<form action="" method="POST">
    <h2 class="mb-3">
        Add Patient
    </h2>
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <label for="Patient-suffix">Select a Suffix</label>
                <select name="patient_suffix" id="patient_suffix" class="form-select form-field" required>
                    <option value="" >select</option>
                    <option value="Mr">Mr</option>
                    <option value="Mr">Mr</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="First-Name">First Name</label>
                <input type="text" name="patient_first_name" id="First-Name" class="form-control form-field " placeholder="Jhon" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="Middle-Name">Middle Name</label>
                <input type="text" name="patient_middle_name" id="Middle-Name" class="form-control form-field" placeholder="Daniel">
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="Last-Name">Last Name</label>
                <input type="text" name="patient_last_name" id="Last-Name" class="form-control form-field" placeholder="Doe" required>
            </div>
        </div>
        <div class="col-md-3">
            <label for="">Select Gender</label>
            <div class="mb-3 d-flex gap-10 flex-wrap">
                <div class="d-flex flex-30  align-items-center justify-content-center">
                    <input type="radio" name="patient_gender" id="Gender-Male" class="form-check-input form-field" value="male" required  checked>
                    <label for="Gender-Male">Male</label>
                </div>
                <div class="d-flex flex-30 align-items-center justify-content-center">
                    <input type="radio" name="patient_gender" id="Gender-Female" class="form-check-input form-field" value="female">
                    <label for="Gender-Female">Female</label>
                </div>
                <div class="d-flex flex-30 align-items-center justify-content-center">
                    <input type="radio" name="patient_gender" id="Gender-Other" class="form-check-input form-field" value="other">
                    <label for="Gender-Other">Other</label>
                </div>
                <input type="text" name="patient_other_gender" id="Gender-Other-value" class="form-control form-field" placeholder="Please Specify" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="DOB">DOB</label>
                <input type="date" name="patient_dob" id="DOB" class="form-control form-field" required value="">
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="Contact-number">Contact Number</label>
                <input type="tel" name="patient_contact_number" id="Contact-number" class="form-control form-field" placeholder="1234567890" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="Email">Email</label>
                <input type="email" name="patient_email" id="Email" class="form-control form-field" placeholder="jhondoe@example.com">
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-5">
                <label for="Address">Address</label>
                <textarea name="patient_address" id="Address" cols="30" rows="1" class="form-control form-field"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-blue d-block w-20 mx-auto" name="add-patient" id="add-patient" type="submit">Add Patient</button>
        </div>
    </div>
</form>