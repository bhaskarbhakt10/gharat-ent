<form action="" method="POST">

    <h2 class="mb-3">
        Add Patient
    </h2>
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="Patient-suffix">Select a Suffix</label>
                        <select name="patient_suffix" id="patient_suffix" class="form-select form-field" required>
                            <option value="">select</option>
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
                            <input type="radio" name="patient_gender" id="Gender-Male" class="form-check-input form-field" value="male" required checked>
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
                </div>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <div class="patient-history-wrap">
                    <h2 class="mb-3">
                        Patient History
                    </h2>
                    <div class="d-flex flex-wrap gap-20 justify-content-center ">
                        <div class="d-flex flex-48">
                            <div class="mb-3 d-flex w-100">
                                <div class="w-100 flex-50 ">
                                    <label for="patient_height_foot"> Patient Height(in foot)</label>
                                    <select name="patient_height_foot" id="patient_height_foot" class="form-select form-field" required>
                                        <option value="">Select foot</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                                <div class="w-100 flex-50 ">
                                    <label for="patient_height_inch">Patient Height(in inches)</label>
                                    <select name="patient_height_inch" id="patient_height_inch" class="form-field form-select">
                                        <option value="">Select inches</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <!-- <input type="text" name="patient_height" id="Patient-Height" class="form-control form-field" required> -->
                            </div>
                        </div>
                        <div class="d-flex flex-48">
                            <div class="mb-3 w-100">
                                <label for="Patient-Weight">Patient Weight</label>
                                <input type="text" name="patient_weight" id="Patient-Weight" class="form-control form-field" required>
                            </div>
                        </div>
                        <div class="d-flex flex-48">
                            <div class="mb-3 w-100">
                                <label for="Patient-bp">Patient Bp</label>
                                <input type="text" name="patient_bp" id="Patient-bp" class="form-control form-field" required>
                            </div>
                        </div>
                        <div class="d-flex flex-48">
                            <div class="mb-3 w-100">
                                <label for="Patient-Diabetes">Patient Diabetes</label>
                                <input type="text" name="patient_diabetes" id="Patient-Diabetes" class="form-control form-field" required>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <h2>Medical history</h2>
                <div class="d-flex ">
                    <div class="d-flex flex-wrap gap-20 flex-100">
                        <div class="mb-3 flex-48">
                            <label for="">Addictions/Habits</label>
                            <select name="" id="" class="form-select form-field">
                                <option value="">Select a Condition</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                        <div class="d-flex flex-48 mb-3 ">
                            <div class="mb-3 w-100">
                                <label for="">Chronic Ailments/Health Condition </label>
                                <select name="" id="" class="form-select form-field">
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-100 flex-wrap flex-container">
                            <div class="d-flex flex-100 gap-20 align-items-center">
                                <div class="d-flex flex-30 flex-column">
                                    <div class="mb-3">
                                        <label for="">Past treatmets</label>
                                        <input type="text" name="" id="" class="form-control form-field">
                                    </div>
                                </div>
                                <div class="d-flex flex-25 flex-column">
                                    <div class="mb-3">
                                        <label for="">Past treatmet start date</label>
                                        <input type="date" name="" id="" class="form-control form-field">
                                    </div>
                                </div>
                                <div class="d-flex flex-25 flex-column">
                                    <div class="mb-3">
                                        <label for="">Past treatmet End date</label>
                                        <input type="date" name="" id="" class="form-control form-field">
                                    </div>
                                </div>
                                <div class="d-flex col flex-column">

                                    <button class="btn btn-primary duplicate-row">Add treatments</button>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-100 flex-wrap flex-container">
                            <div class="d-flex flex-100 gap-20 align-items-center">
                                <div class="d-flex flex-30 flex-column">
                                    <div class="mb-3">
                                        <label for="">Past Surgeries</label>
                                        <input type="text" name="" id="" class="form-control form-field">
                                    </div>
                                </div>
                                <div class="d-flex flex-25 flex-column">
                                    <div class="mb-3">
                                        <label for="">Past Surgeries start date</label>
                                        <input type="date" name="" id="" class="form-control form-field">
                                    </div>
                                </div>
                                <div class="d-flex flex-25 flex-column">
                                    <div class="mb-3">
                                        <label for="">Past Surgeries End date</label>
                                        <input type="date" name="" id="" class="form-control form-field">
                                    </div>
                                </div>
                                <div class="d-flex col flex-column">

                                    <button class="btn btn-primary duplicate-row d-fieldset">Add Past Surgeries</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>


    <div class="">
        <button class="btn btn-blue d-block w-20 mx-auto d-fieldset" name="add-patient" id="add-patient" type="submit">Add Patient</button>
    </div>
</form>