<form action="" id="treatment-container-medicine-form">
<fieldset class="mt-3">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-2">Treatment</h2>
        </div>
        <div class="col-md-12">
            <div class="treatment-container" id="treatment-container-medicine">
                <div class="d-flex flex-wrap gap-10 py-3">
                    <div class="d-flex flex-50">
                        <div class="mb-3 w-100">
                            <label for="">Medicine name</label>
                            <input type="text" class="form-control form-field" required name="medicine_name">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-40">
                        <div class="d-flex flex-50">
                            <div class="mb-3 w-100">
                                <label for="">Qty</label>
                                <input type="number" class="form-control form-field" placeholder="Enter a number" required name="medicine_qty">
                            </div>
                        </div>
                        <div class="d-flex flex-50">
                            <div class="mb-3 w-100">
                                <label for="">Weight/Volume</label>
                                <select class="form-select form-field" required name="medicine_volume">
                                    <option value="">Select a Unit</option>
                                    <option value="mg">mg</option>
                                    <option value="ml">ml</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-40">
                        <div class="mb-3 w-100">
                            <label for="">Dosage Pattern</label>
                            <select class="form-select form-field" required name="medicine_pattern">
                                <option value="">Select a pattern</option>
                                <option value="1-0-0">1-0-0</option>
                                <option value="1-0-1">1-0-1</option>
                                <option value="1-1-1">1-1-1</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-30">
                        <div class="mb-3 w-100">
                            <label for="">Additional Notes</label>
                            <textarea name="medicine_notes" rows="1" class="form-control form-field" placeholder="Additional Notes"  value="N/A"></textarea>
                        </div>
                    </div>
                    <div class="d-flex flex-25 align-items-center">
                        <div class="w-100 text-center">
                            <button class="btn btn-primary add-medicine w-60" role="button">Add Medicine</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex gap-10 ">
            <button class="btn btn-blue w-20 d-flex justify-content-center save-and-pdf">Save and pdf</button>
            <button class="btn btn-blue w-20 d-flex justify-content-center preview">Preview</button>
        </div>
    </div>
</fieldset>
</form>