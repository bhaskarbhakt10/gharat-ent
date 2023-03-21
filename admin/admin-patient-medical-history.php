
<div class="row">
    <div class="col-md-12">
        <fieldset>
            <h2>Medical history</h2>
            <div class="d-flex ">
                <div class="d-flex flex-wrap gap-20 flex-100">
                    <div class="mb-3 flex-48">
                        <label for="addiction">Addictions/Habits</label>
                        <select name="patient_addiction" id="addictions" class="form-select form-field select-two" multiple required>
                            <!-- <option value="">Select a Condition</option> -->
                            <option value="None" selected="selected">None</option>
                            <option value="Smoking">Smoking</option>
                            <option value="Alcohol">Alcohol</option>
                        </select>
                    </div>
                    <div class="flex-48 mb-3 ">
                        <div class="mb-3 w-100">
                            <label for="health-conditions">Chronic Ailments/Health Condition </label>
                            <select name="patient_health_condition" id="health-conditions" class="form-select form-field select-two" multiple required>
                                <option value="None" selected="selected">None</option>
                                <!-- <option value="">Health Condition</option> -->
                                <option value="Sinusitis">Sinusitis</option>
                                <option value="Back Pain">Back Pain</option>
                                <option value="IBS">IBS</option>
                                <option value="Allergies">Allergies</option>
                                <option value="Diabetes">Diabetes</option>
                                <option value="Cancer">Cancer </option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex gap-10">
                        <div class="mb-3">
                            <input type="checkbox" name="" id="add-treatments" class="form-check-input medical-history-check" value="treatment-container">
                            <label for="add-treatments">Add Treatment/s ?</label>
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" name="" id="add-surgeries" class="form-check-input medical-history-check" value="surgery-container">
                            <label for="add-surgeries">Add Surgerie/s ?</label>
                        </div>
                    </div>
                    <div class="d-flex flex-100 flex-wrap flex-container" id="treatment-container">
                        <div class="d-flex flex-100 gap-20 align-items-center">
                            <div class="d-flex flex-30 flex-column">
                                <div class="mb-3">
                                    <label for="">Past treatmets</label>
                                    <input type="text" class="form-control form-field" name='past_treatment' required>
                                </div>
                            </div>
                            <div class="d-flex flex-25 flex-column">
                                <div class="mb-3">
                                    <label for="">Past treatment start date</label>
                                    <input type="date" class="form-control form-field" name='past_treatment_start_date' required>
                                </div>
                            </div>
                            <div class="d-flex flex-25 flex-column">
                                <div class="mb-3">
                                    <label for="">Past treatment End date</label>
                                    <input type="date" class="form-control form-field" name='past_treatment_end_date' required>
                                </div>
                            </div>
                            <div class="d-flex col flex-column">

                                <button class="btn btn-primary duplicate-row">Add treatments</button>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-100 flex-wrap flex-container" id="surgery-container">
                        <div class="d-flex flex-100 gap-20 align-items-center">
                            <div class="d-flex flex-30 flex-column">
                                <div class="mb-3">
                                    <label for="past_surgeries">Past Surgeries</label>
                                    <input type="text" name="past_surgeries" id="" class="form-control form-field" required>
                                </div>
                            </div>
                            <div class="d-flex flex-25 flex-column">
                                <div class="mb-3">
                                    <label for="past_surgeries_start_date">Past Surgeries start date</label>
                                    <input type="date" name="past_surgeries_start_date" id="" class="form-control form-field" required>
                                </div>
                            </div>
                            <div class="d-flex flex-25 flex-column">
                                <div class="mb-3">
                                    <label for="past_surgeries_end_date">Past Surgeries End date</label>
                                    <input type="date" name="past_surgeries_end_date" id="past_surgeries_end_date" class="form-control form-field" required>
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
