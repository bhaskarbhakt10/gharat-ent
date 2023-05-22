<form action="" method="post" data-formid="<?php echo $_SESSION['user']['id']; ?>">

    <fieldset class="mt-3 bg_form_blue">
            <div class="row">
                <div class="col-md-12">
                    <label for="medicine-name" >Medicine Name</label>
                    <input type="text" name="medicine-name" id="medicine-name" class="form-control form-field" placeholder="Medicine name" required>
                </div>
                <div class="col-md-6">
                    <label for="expiry-date"> Expiry Date</label>
                    <input type="date" name="expiry-date" id="expiry-date" class="form-control form-field" placeholder="" required>
                </div>
                <div class="col-md-12">
                    <div class="text-center my-3">
                        <button class="btn btn-blue btn-bg-blue-theme w-20 w-m80 mx-auto symptom-btn">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</form>