<form action="" method="post">
<fieldset class="mt-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-2">Symptoms</h2>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="symptom-name">Symptom name</label>
                <textarea name="symptom_name" id="symptom-name" class="form-field form-control" placeholder="Coughing, Fever" required></textarea>
                <span><i>Use comma(,) to seprate multiple Symptoms</i></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="symptom-type">Symptom name</label>
                <select name="symptom_type" id="symptom-type" class="form-field form-select" required>
                    <option value="">Select</option>
                    <option value="chronic">Chronic</option>
                    <option value="acute">Acute</option>
                    <option value="sudden">Sudden</option>
                    <option value="severe">Severe</option>
                    <option value="mild">Mild</option>
                    <option value="recurring">Recurring</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="symptom-days">No of Days</label>
                <input type="number" name="symptom_days" id="symptom-days" class="form-control form-field" placeholder="How long the symptoms have been occuring" required>
            </div>
        </div>
        <div class="d-flex my-3">
            <button class="btn btn-blue w-20 mx-auto">Button</button>
        </div>
    </div>
</fieldset>
</form>