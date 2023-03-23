<?php
if (array_key_exists('p_id', $_GET)) {
    $patient_id = $_GET['p_id'];
    $patients = new Patients();
    $patient_genral_details = $patients->get_genral_detials($patient_id);
    if ($patient_genral_details->num_rows > 0) {
        while ($row = $patient_genral_details->fetch_assoc()) {
            $suffix = $row['hospital_PatientSuffix'];
            $first_name = $row['hospital_PatientFirstName'];
            $middle_name = $row['hospital_PatientMiddleName'];
            $last_name = $row['hospital_PatientLastName'];
            $phone_number = $row['hospital_PatientContactNumber'];
            $email = $row['hospital_PatientEmail'];
            echo $gender = $row['hospital_PatientGender'];
            $date_of_birth = $row['hospital_PatientDOB'];
            $address = $row['hospital_PatientAddress'];
           
        }
    }
}
?>



    <div class="row">
        <div class="col-md-12">
            <fieldset>
            <h2 class="mb-3">
                Add Patient
            </h2>
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="Patient-suffix">Select a Suffix</label>
                            <select name="patient_suffix" id="patient_suffix" class="form-select form-field" required >
                                <option value="<?php echo !empty($suffix) ? $suffix : '' ; ?>"> <?php echo !empty($suffix) ? $suffix : 'select' ; ?></option>
                                <option value="Mr">Mr</option>
                                <option value="Mr">Mr</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="First-Name">First Name</label>
                            <input type="text" name="patient_first_name" id="First-Name" class="form-control form-field " placeholder="John" required  value="<?php echo !empty($first_name) ? $first_name : '' ; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="Middle-Name">Middle Name</label>
                            <input type="text" name="patient_middle_name" id="Middle-Name" class="form-control form-field" placeholder="Daniel" value="<?php echo !empty($middle_name) ? $middle_name : '' ; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="Last-Name">Last Name</label>
                            <input type="text" name="patient_last_name" id="Last-Name" class="form-control form-field" placeholder="Doe" required value="<?php echo !empty($last_name) ? $last_name : '' ; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="">Select Gender</label>
                        <div class="mb-3 d-flex gap-10 flex-wrap">
                            <div class="d-flex flex-30  align-items-center justify-content-center">
                                <input type="radio" name="patient_gender" id="Gender-Male" class="form-check-input form-field" value="male" required 
                                <?php  echo (!empty($gender) && $gender === "male") ? 'checked' : 'checked' ; ?>>
                                <label for="Gender-Male">Male</label>
                            </div>
                            <div class="d-flex flex-30 align-items-center justify-content-center">
                                <input type="radio" name="patient_gender" id="Gender-Female" class="form-check-input form-field" value="female" 
                                <?php  echo (!empty($gender) && ($gender === "female")) ? 'checked' : '' ; ?>>
                                <label for="Gender-Female">Female</label>
                            </div>
                            <div class="d-flex flex-30 align-items-center justify-content-center">
                                <input type="radio" name="patient_gender" id="Gender-Other" class="form-check-input form-field" value="other" 
                                <?php  echo ((!empty($gender)) && ($gender !== "male" && $gender !== "female") ) ? 'checked' : '' ; ?>>
                                <label for="Gender-Other">Other</label>
                            </div>
                            <input type="text" name="patient_other_gender" id="Gender-Other-value" class="form-control form-field" placeholder="Please Specify" required value="<?php echo  ((!empty($gender)) && ($gender !== "male" && $gender !== "female") ) ? explode('-',$gender)[1] : '' ; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="DOB">DOB</label>
                            <input type="date" name="patient_dob" id="DOB" class="form-control form-field" required value="<?php echo !empty($date_of_birth) ? $date_of_birth : '' ; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="Contact-number">Contact Number</label>
                            <input type="tel" name="patient_contact_number" id="Contact-number" class="form-control form-field" placeholder="1234567890" required value="<?php echo !empty($phone_number) ? $phone_number : '' ; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="Email">Email</label>
                            <input type="email" name="patient_email" id="Email" class="form-control form-field" placeholder="jhondoe@example.com" value="<?php echo !empty($email) ? $email : '' ; ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label for="Address">Address</label>
                            <textarea name="patient_address" id="Address" cols="30" rows="1" class="form-control form-field"><?php echo !empty($address) ? $address : '' ; ?></textarea>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
