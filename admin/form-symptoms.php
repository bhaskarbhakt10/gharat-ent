<form action="" method="post" data-formid="<?php echo $_SESSION['user']['id']; ?>">

    <fieldset class="mt-3 bg_form_blue">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="symptom-name">Symptom name</label>
                    <textarea name="symptom_name" id="symptom-name" class="form-field form-control" placeholder="Use comma(,) to seprate multiple Symptoms" required></textarea>
                </div>
            </div>
        </div>
        <?php
        if (!empty($_SESSION['user']['specialization']) &&  $_SESSION['user']['specialization'] !== "N/A") {
            $specialization = $_SESSION['user']['specialization'];
            switch ($specialization) {
                case 'GY':
                ?>
                    <div class="row">
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/admin/specialization-forms/symptom/form-' . $specialization . '.php';
                        ?>
                    </div>
                <?php
                    break;

                default:
                    # code...
                    break;
            }
        }
        ?>
        <div class="row">
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
            <div class="text-center my-3">
                <button class="btn btn-blue btn-bg-blue-theme w-20 mx-auto symptom-btn">Button</button>
            </div>
        </div>
    </fieldset>
</form>