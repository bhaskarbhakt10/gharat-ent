<?php
    if(!empty($hospital_pMeds)){

        $meds_arr = json_decode($hospital_pMeds, true);
        // print_r($meds_arr);
    }
?>
<?php
if(!empty($meds_arr)){
?>
<fieldset class="bg_form_grey">
    <div class="d-flex gap-20 flex-wrap">
        <div>
            <input type="checkbox" name="meds-repeat" value="no" id="prescribe-meds" class="form-check-input" checked>
            <label for="prescribe-meds">Prescribed meds ?</label>
        </div>
        <div class="">
            <input type="checkbox" name="meds-repeat" value="yes" id="repeat-previous-meds" class="form-check-input">
            <label for="repeat-previous-meds">Repeat Previous prescribed meds ?</label>
        </div>
        <div class="flex-100" id="repeat-precribe-meds">
            <div class="mb-3">
                <select name="" id="repeat-precribe-field" class="form-select form-field">
                    <option value="">Select a Date</option>
                    <?php 
                    foreach($meds_arr as $key=>$value) {
                        ?>
                        <option value="<?php echo $value['ID']?>"><?php echo $value['date'] ." " .$value['time'];?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</fieldset>
<?php } ?>
<form action="" id="treatment-container-medicine-form" method="post" data-formid="<?php echo $_SESSION['user']['id'];?>">
<fieldset class="mt-3 bg_form_grey">
    <div class="row">
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
                            <button class="btn btn-danger remove-duplicate-row w-60" role="button">Remove Medicine</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="treatment-checkbox d-flex flex-wrap gap-20 mb-3 align-items-center">
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="cbc" id="cbc" class="form-check-input form-field">
                    <label for="cbc">CBC</label>
                </div>
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="gastric-fluid-analysis" id="gastric-fluid-analysis" class="form-check-input form-field">
                    <label for="gastric-fluid-analysis">Gastric fluid analysis</label>
                </div>
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="kidney-function-test" id="kidney-function-test" class="form-check-input form-field">
                    <label for="kidney-function-test">Kidney function test</label>
                </div>
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="liver-function-test" id="liver-function-test" class="form-check-input form-field">
                    <label for="liver-function-test">Liver function test</label>
                </div>
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="lumbar-puncture" id="lumbar-puncture" class="form-check-input form-field">
                    <label for="lumbar-puncture">Lumbar puncture</label>
                </div>
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="pap-smear" id="pap-smear" class="form-check-input form-field">
                    <label for="pap-smear">Pap smear</label>
                </div>
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="sonography" id="sonography" class="form-check-input form-field">
                    <label for="sonography">Sonography</label>
                </div>
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="USG" id="USG" class="form-check-input form-field">
                    <label for="USG">USG</label>
                </div>
                <div class="d-flex">
                    <input type="checkbox" name="medicine-test" value="other" id="other" class="form-check-input form-field">
                    <label for="other">Other</label>
                </div>
            </div>
            <div class="d-flex flex-fill mb-3" id="other-medicine-test">
                <div class="d-flex flex-column flex-fill">
                    <label for="other_medicine_test">Other Test name</label>
                    <input type="text" name="other_medicine_test" id="other_medicine_test" class="form-control form-field" required placeholder="Use comma(,) to seprate multiple test">
                </div>
            </div>
            <div class="follow-up d-flex">
                <div class="mb-4 w-100">
                    <label for="follow-up-date">Follow up Date</label>
                    <input type="date" name="follow_up_date" id="previous-dates" class="form-control form-field">
                </div>
            </div>
        </div>
        <div class="d-flex gap-10 ">
            <button class="btn btn-blue btn-bg-blue-theme  w-20 d-flex justify-content-center save-and-pdf">Save and pdf</button>
            <button class="btn btn-blue btn-bg-blue-theme w-20 d-flex justify-content-center preview">Preview</button>
        </div>
    </div>
</fieldset>
</form>