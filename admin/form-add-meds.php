<form action="" method="post" data-formid="<?php echo $_SESSION['user']['id']; ?>" id="meds-form" novalidate>
    <fieldset class="mt-3 bg_form_blue">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="manufacturer-name">Manufacturer Name</label>
                    <input type="text" name="manufacturer-name" id="manufacturer-name" class="form-control form-field" placeholder="Medicine name" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="medicine-name">Medicine Name</label>
                    <input type="text" name="medicine-name" id="medicine-name" class="form-control form-field" placeholder="Medicine name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="expiry-date"> Expiry Date</label>
                    <input type="date" name="expiry-date" id="expiry-date" class="form-control form-field" placeholder="" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="expiry-date">Power</label>
                    <input type="text" name="med-power" id="med-power" class="form-control form-field" placeholder="5 mg" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label for="expiry-date">Quantity</label>
                    <input type="number" name="quantity" id="expiry-date" class="form-control form-field" placeholder="10" required>
                </div>
            </div>
            <div class="col-md-12" id="">
                <div class="mb-3">
                    <label class="mb-0 mandatory-mark">Select type of medicine</label>
                    <div class="d-flex flex-wrap gap-10">
                        <div class="d-flex align-items-center ">
                            <input type="checkbox" name="is-type-of" id="is-type-of-syrup" class="form-check-input form-field" value="syrup" required>
                            <label for="is-type-of-syrup">Syrup</label>
                        </div>
                        <div class="d-flex align-items-center ">
                            <input type="checkbox" name="is-type-of" id="is-type-of-capsule" class="form-check-input form-field" value="capsule" required>
                            <label for="is-type-of-capsule">Capsule</label>
                        </div>
                        <div class="d-flex align-items-center ">
                            <input type="checkbox" name="is-type-of" id="is-type-of-tablet" class="form-check-input form-field" value="tablet" required>
                            <label for="is-type-of-tablet">Tablet</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <input type="checkbox" name="" id="add-same-med" class="form-check-input form-field" data-append="#same-meds-diffrent-qty">
                    <label for="add-same-med">Add same meds with different power</label>
                </div>
            </div>
            <div class="col-md-12" id="same-meds-diffrent-qty">
                <div class="d-flex flex-wrap flex-100 gap-10 mb-3">
                    <div class="d-flex item-same-meds flex-col">
                        <label for="same-meds-expiry">Date Expiry</label>
                        <input type="date" name="same-meds-expiry" id="same-meds-expiry" class="form-control form-field" required>
                    </div>
                    <div class="d-flex item-same-meds flex-col">
                        <label for="same-meds-qty">Quantity</label>
                        <input type="number" name="same-meds-qty" id="same-meds-qty" class="form-control form-field" required placeholder="12">
                    </div>
                    <div class="d-flex item-same-meds flex-col">
                        <label for="same-meds-power">Power</label>
                        <input type="text" name="same-meds-power" id="same-meds-power" class="form-control form-field" required placeholder="5 mg">
                    </div>
                    <div class="d-flex item-same-meds flex-col">
                        <div class="d-flex gap-10 actions">
                            <div class="">
                                <button class="btn btn-outline-primary add">Add</button>
                            </div>
                            <div class="">
                                <button class="btn btn-outline-danger remove">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="text-center my-3">
                    <button class="btn btn-blue btn-bg-blue-theme w-20 w-m80 mx-auto add-meds">Button</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>