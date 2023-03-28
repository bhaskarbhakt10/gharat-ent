jQuery.noConflict();
(function ($) {
    //all labels 
    function all_labels() {
        $('label').addClass('label');
        $('input+label').addClass('label-radio-check');
    }
    all_labels();
    // add patients
    let other_gender_val = $('#Gender-Other-value');
    function function_other_gender_val() {
        let other_gender_val = $('#Gender-Other-value');
        console.log(other_gender_val.val());
        if ((other_gender_val.val() === "")) {
            other_gender_val.detach();
        }
    }
    function_other_gender_val();
    $('body').on('change', '[name=patient_gender]', function () {
        $('[name=patient_gender]').removeAttr('checked');
        $(this).attr('checked', 'checked');
        other_gender_val.val('');
        if ($('#Gender-Other').is(':checked')) {
            $(this).parent().parent().append(other_gender_val);
        }
        else {
            other_gender_val.detach();
        }
    });
    $("#add-patient").closest('form').attr('id', 'patient-form');
    $('#patient-form input,#patient-form select ').addClass("patient_field");
    let required = $('.patient_field:required').toArray();
    for (let index = 0; index < required.length; index++) {
        $(required[index]).addClass('required');

    }
    let required_field = $('.required').toArray();
    $('body').on('click', '#add-patient', function (event) {
        event.preventDefault();
        $('.select-two').trigger('change');
        let this_btn = $(this);
        let data_attr = $(this).attr('data-attr');
        console.log(data_attr);
        let form = $(this).closest('form');
        let form_data = $(form).serializeArray();

        let $post = new Object();
        for (let k = 0; k < form_data.length; k++) {
            let name = form_data[k]['name'];
            let value = form_data[k]['value'];
            let is_required;
            // if ($('[name=' + name + ']').attr('type') === 'radio' ) {
            //     is_required = $('[name=' + name + ']').is(':checked');
            // }
            // else {
            //     is_required = $('[name=' + name + ']').is(':required');
            // }
            if ($('[name=' + name + ']').hasClass('.required')) {
                is_required = $('[name=' + name + ']').is(':checked');
            }
            // else {
            //     is_required = $('[name=' + name + ']').is(':required');
            // }
            // console.log(name, is_required);
            $post[name] = value;
        }
        for (let i = 0; i < required_field.length; i++) {
            let name = $(required_field[i]).attr('name');
            let val = $("[name=" + name + "]").val();
            // console.log($(required_field[i]));
            if ($(required_field[i]).val() !== "") {
                // console.log($(required_field[i]).attr('type'));
                switch ($(required_field[i]).attr('type')) {
                    case "radio":
                        let radio_name = $(required_field[i]).attr('name');
                        let radios = $('[name=' + radio_name + ']').toArray();
                        for (let r = 0; r < radios.length; r++) {
                            if ($(radios[r]).is(':checked')) {
                                // console.log($(radios[r]).val());
                                $post[$(radios[r]).attr('name')] = $(radios[r]).val();
                            }

                        }
                        break;
                    default:
                        $post[$(required_field[i]).attr('name')] = $(required_field[i]).val();
                }


            }
            else {
                if ($(required_field[i]).parent().children('.validation-message').length === 0) {
                    // $("<div class='validation-message'></div>").insertAfter(required_field[i]);
                    $(required_field[i]).parent().append("<div class='validation-message'></div>");
                    $(required_field[i]).parent().children('.validation-message').hide().fadeIn(3000);
                    $(required_field[i]).parent().children('.validation-message').append("<p class='mandatory-message'>mandatory</p>");
                    setTimeout(() => {
                        $(required_field[i]).parent().children('.validation-message').remove()
                    }, 5000);
                }

            }

        }

        console.log($post);
        let $post_length = Object.keys($post).length;

        $ajax_Arr = new Array();
        for (const key in $post) {
            if ($post[key] === '') {
                // console.error($post[key])
                const req = isRequired(key);
                if (req === true) {
                    $ajax_Arr.push(1);
                    // console.log('cannot send to ajax');
                }
                else {
                    $ajax_Arr.push(0);
                    // console.log('send to ajax');
                }
            }
            else {
                $ajax_Arr.push(0);
                // console.log('send to ajax');
            }
        }
        console.log($ajax_Arr);
        if ($post_length === $ajax_Arr.length) {
            const value0 = $ajax_Arr.reduce((a, b) => a + b, 0);
            // console.log(value0);
            if (value0 === 0) {
                ajax_call($post, this_btn, data_attr);
                alert('calling ajax');
            }
        }
    })

    let isRequired_flag = false;
    function isRequired(key) {
        let required = $('[name=' + key + ']').attr('required');
        if (typeof required !== 'undefined' && required !== false) {
            console.warn($('[name=' + key + ']'));
            isRequired_flag = true;
        }
        else {
            console.error($('[name=' + key + ']'));
            isRequired_flag = false;
        }
        return isRequired_flag;
    }

    function ajax_call($post, this_btn, data_attr) {

        // console.log(this_btn);
        let data = {
            'post': $post
        }
        if (data_attr === 'add') {
            $.ajax({
                url: '../backend/actions/patients/add-patient.php',
                type: 'POST',
                data: data,
                success: function (data) {
                    console.log(data);
                    let success_html = '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert"> ';
                    success_html += '<strong>Patient added Sucessfully!</strong>  ';
                    success_html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> '
                    success_html += '</div>'
                    if (data === "success") {
                        $(this_btn).parent().append(success_html);
                        setTimeout(() => {
                            $(this_btn).closest('form')[0].reset();
                            $(other_gender_val).detach();
                            $('[data-row^=row]').detach()
                            console.log($(this_btn).parent().find('.alert').remove());
                        }, 2000);
                    }
                    else {

                    }
                },
                error: function (error) {
                    window.alert(error);
                }
            });
        }
        else if (data_attr === 'edit') {
            $.ajax({
                url: '../backend/actions/patients/update-patient-primary-details.php',
                type: 'POST',
                data: data,
                success: function (data) {
                    console.log(data);
                    let success_html = '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert"> ';
                    success_html += '<strong>Patient Updated Sucessfully!</strong>  ';
                    success_html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> '
                    success_html += '</div>'
                    if (data === "success") {
                        $(this_btn).parent().append(success_html);
                        setTimeout(() => {
                            $(this_btn).closest('form')[0].reset();
                            $(other_gender_val).detach();
                            $('[data-row^=row]').detach()
                            $(this_btn).parent().find('.alert').remove();
                            // document.location.reload();
                            $($(this_btn).closest("form")).load(document.URL + " form", function () {
                                all_labels();
                                // mark_required();
                                mark_required__();
                                function_other_gender_val();

                            });
                        }, 2000);
                    }
                    else {

                    }
                },
                error: function (error) {
                    window.alert(error);
                }
            });
        }
    }


    //disable future dates
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#DOB').attr('max', maxDate);

    //disable previous days
    var dtToday_ = new Date();
    var month_ = dtToday_.getMonth() + 1;
    var day_ = dtToday_.getDate() + 1;
    var year_ = dtToday_.getFullYear();
    if (month_ < 10)
        month_ = '0' + month_.toString();
    if (day_ < 10)
        day_ = '0' + day_.toString();
    var minDate = year_ + '-' + month_ + '-' + day_;
    $('#previous-dates').attr('min', minDate);

    $('body').on('click', '#add-patient', function (event) {

    });

    //add class to fieldset
    let $allfieldset = $('fieldset');
    for (let index = 0; index < $allfieldset.length; index++) {
        $($allfieldset[index]).addClass("fieldset filedset-" + [index]);
    }
    let parent_ele = $('.duplicate-row').closest('.flex-container');
    for (let index = 0; index < parent_ele.length; index++) {
        $(parent_ele[index]).attr('data-row', 'row-' + [index]);
    }

    $('body').on('click', '.duplicate-row', function (e) {
        e.preventDefault();
        let html = $(this).closest('[data-row]').children().toArray();
        // console.log(html[0]);
        // console.warn(html);
        let parent_to_insert_after = $(this).closest('[data-row]').attr('data-row');
        $('[data-row=' + parent_to_insert_after + ']').append("<div class='d-flex flex-100 gap-20 align-items-center apended-row'>" + html[0].innerHTML + "</div>");
        $('.apended-row button.btn-primary').replaceWith("<button class='btn btn-danger w-100 remove-duplicate-row'>Remove</button>");
        let this_field = $('[data-row=' + parent_to_insert_after + '] .form-field');
        for (let index = 0; index < this_field.length; index++) {
            if ($(this_field[index]).attr('name') !== undefined || $(this_field[index]).attr('name') !== "") {
                $(this_field[index]).attr('name', $(this_field[index]).attr('name') + "_" + [index]);
            }

        }
    });
    $("body").on('click', '.remove-duplicate-row', function (e) {
        e.preventDefault();
        $(this).closest('.apended-row').remove();
        $(this).closest('.appended-row-medicine').remove();
    });

    let treatment_container = $('#treatment-container').detach();
    let surgery_container = $('#surgery-container').detach();
    $('body').on('change', '.medical-history-check', function () {
        let value = $(this).val();
        console.warn();
        console.log("#" + value);
        if ($(this).is(':checked')) {
            if (value === 'treatment-container') {
                $(this).closest('fieldset').children().last().children().append(treatment_container);
            }
            else if (value === 'surgery-container') {
                $(this).closest('fieldset').children().last().children().append(surgery_container);

            }
        }
        else {
            if (value === 'treatment-container') {
                $(treatment_container).remove();
            }
            else {
                $(surgery_container).remove();
            }
        }

    })



    // regular checkup
    $('body').on('click', '.update-regular-checkup', function (event) {
        event.preventDefault();
        let this_btn = $(this);
        let form = $(this).closest('form');
        let form_data_ = $(form).serializeArray();
        let form_data = [];
        for (let k = 0; k < form_data_.length; k++) {
            let name = form_data_[k]['name'];
            let value = form_data_[k]['value'];
            console.log($('[name=' + name + ']'));
            if ($('[name=' + name + ']').is(':required') && value === '') {
                if ($('[name=' + name + ']').parent().children('.validation-message').length === 0) {
                    $('[name=' + name + ']').parent().append('<p class="validation-message mandatory-message">mandatory</p>');
                    setTimeout(() => {
                        $('[name=' + name + ']').next('.validation-message').remove()
                    }, 5000);

                }
            }
            else {
                form_data.push({ [name]: value });

            }
        }
        console.log(form_data);
        let data = {
            'form_data': form_data
        };
        $.ajax({
            url: '../backend/actions/patients/update-daily-checkup.php',
            type: 'POST',
            data: data,
            success: function (data) {
                if (data === 'success') {
                    window.location.reload()
                }
            },
            error: function (error) {
                window.alert(error);
            }
        });

    });

    // form treatment 
    $(' #treatment-container-medicine .remove-duplicate-row:not(.appended-row-medicine .remove-duplicate-row) ').hide();
    $('body').on('click', '.add-medicine', function (event) {
        event.preventDefault();
        let parent_container = $(this).parentsUntil('#treatment-container-medicine').toArray();
        let to_append = parent_container.pop();
        console.log(to_append)
        $('#treatment-container-medicine').append('<div class="d-flex flex-wrap gap-10 py-3 appended-row-medicine">' + to_append.innerHTML + '</div>');
        $(' #treatment-container-medicine .appended-row-medicine .remove-duplicate-row ').show();
        // $(' #treatment-container-medicine .remove-duplicate-row ').show();
        // $('.appended-row-medicine button.btn-primary').replaceWith("<button class='btn btn-danger w-60 remove-duplicate-row'>Remove</button>");
    });

    //remove code works from line number 215


    //save-and-pdf
    $('body').on('click', '.save-and-pdf, .symptom-btn', function (event) {
        event.preventDefault();
        let thisbtn = $(this);
        let patient_id = $('#patient-id').val();
        let this_form = $(this).closest('form');
        let formid = $(this).closest('form').attr('data-formid');
        let count_children_inside_container = $(this_form).find('.treatment-container').children();
        for (let index = 0; index < count_children_inside_container.length; index++) {
            $(count_children_inside_container[index]).attr('data-obj', 'data_obj_' + [index]);

        }
        let values__ = new Array();
        let names__ = new Array();
        let all_inputs = $(this_form).find('.form-field');
        for (let index = 0; index < all_inputs.length; index++) {
            let obj = $(all_inputs[index]).closest('[data-obj^=data_obj_]').attr('data-obj');
            let required = $(all_inputs[index]).is(':required');
            let value = $(all_inputs[index]).val();
            let name = $(all_inputs[index]).attr('name');
            let type = $(all_inputs[index]).attr('type');
            console.log(type);
            names__.push(name);
            if (required === true && type !== 'checkbox') {
                if (value === '') {
                    if ($(all_inputs[index]).next('.validation-message').length === 0) {
                        $(all_inputs[index]).parent().append('<div class="validation-message"><p class="mandatory-message">Mandatory</div>');
                        setTimeout(() => {
                            $(all_inputs[index]).next('.validation-message').remove()
                        }, 5000);
                    }
                }
                else {
                    console.log(name, value);
                    values__.push({ "name": name, "value": value });
                }
            }
            else if (required === false && type === 'checkbox') {
                if ($(all_inputs[index]).is(':checked')) {
                    values__.push({ "name": name, "value": value });
                }
            }
            else {
                values__.push({ "name": name, "value": value });

            }

        }
        console.log(values__);
        const map = new Map(values__.map(({ name, value }) => [name, { name, value: [] }]));
        for (let { name, value } of values__) map.get(name).value.push(...[value].flat());
        const merged_array = [...map.values()];
        console.log(merged_array);
        console.log(patient_id);
        console.log(formid);
        const unique_names = [... new Set(names__)];
        let data = {
            'merged_array': merged_array,
            'unique_names': unique_names,
            'patient_id': patient_id,
            'formid': formid

        };
        if ($(this).hasClass('save-and-pdf')) {
            $.ajax({
                url: '../backend/actions/patients/medicine.php',
                type: 'POST',
                data: data,
                success: function (data) {
                    console.log(data);
                },
                error: function (error) {
                    window.alert(error);
                }
            });
        }
        else if ($(this).hasClass('symptom-btn')) {
            console.log($(this));
            $.ajax({
                url: '../backend/actions/patients/symptom.php',
                type: 'POST',
                data: data,
                success: function (data) {
                    let success_html = '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert"> ';
                    success_html += '<strong>Symptom added Sucessfully!</strong>  ';
                    success_html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> '
                    success_html += '</div>'
                    if (data === "success") {
                        $(success_html).insertAfter(thisbtn);
                        setInterval(() => {
                            $('#symptom-table').load(window.location.href + " #symptom-table");
                            $(this_form).find('.alert').remove();
                            $(this_form)[0].reset();
                        }, 2000);
                    }
                },
                error: function (error) {
                    window.alert(error);
                }
            });
        }
    });

    $('body').on('click', '.print_pdf', function (e) {
        window.print();
    })

    // select 2 for addictions and habbits

    $(".select-two").select2();
    $('.select2.select2-container').addClass('form-control form-field form-select-multiple');

    let count = 0;
    $('.select-two').parent().append('<input type="hidden" class="hidden_select_two patient_field">');
    $('body').on('change', '.select-two', function () {
        count = count + 1;
        let select2_value = $(this).select2('data');
        let selectname = $(this).attr('name');
        let selectclasses = $(this).attr('class');
        $(this).parent().children().last().attr('name', selectname);
        // $(this).next('.hidden_select_two').addClass(selectclasses);
        $(this).removeAttr('name');
        console.log(count);
        let select2_value_arr = [];
        select2_value.forEach(value => {
            if (select2_value_arr.includes(value.text)) {

            }
            else {
                select2_value_arr.push(value.text)
            }
        });
        console.log(select2_value_arr);
        $(this).parent().children().last().attr('value', select2_value_arr.toString());

        if ($(this).prop('required') === true) {
            $(this).parent().children().last().attr('required', 'required');
            $(this).parent().children().last().addClass('required');
        }
    })



    //mandatory mark for add patients
    function mark_required() {
        let all_input = $('.form-field.required');
        for (let index = 0; index < all_input.length; index++) {
            let type = $(all_input[index]).attr('type');
            switch (type) {
                case 'radio':
                    if ($(all_input[index]).prop('required')) {
                        console.log($(all_input[index]).parent().parent().parent().find('label:first-child'));
                        $(all_input[index]).parent().parent().parent().find('label:first-child').addClass('mandatory-mark');
                    }
                    break;

                default:
                    if ($(all_input[index]).prop('required')) {
                        $(all_input[index]).parent().find('label').addClass('mandatory-mark');
                    }
                    $('input[type="radio"]').next('label').removeClass('mandatory-mark');
                    break;
            }
        }
    }

    //for single patients 
    function mark_required__() {
        let all_input = $('.form-field');
        for (let index = 0; index < all_input.length; index++) {
            if ($(all_input[index]).prop("required")) {
                let type = $(all_input[index]).attr('type');
                switch (type) {
                    case 'checkbox':
                        if ($(all_input[index]).prop('required')) {
                            $(all_input[index]).parent().parent().parent().find('label:first-child').addClass('mandatory-mark');
                        }
                        break;
                    case 'radio':
                        if ($(all_input[index]).prop('required')) {
                            console.log($(all_input[index]).parent().parent().parent().find('label:first-child'));
                            $(all_input[index]).parent().parent().parent().find('label:first-child').addClass('mandatory-mark');
                        }
                        break;
                    default:
                        if ($(all_input[index]).prop('required')) {
                            $(all_input[index]).parent().find('label').addClass('mandatory-mark');
                        }
                        $('input[type="radio"]').next('label').removeClass('mandatory-mark');
                        break;
                }
            }

        }
    }


    mark_required();
    mark_required__();
    $("body").on('change', function () {
        mark_required__();
        mark_required();
    })

    //check if name exists with the same patient name also validates the number id number length is 10 or not
    $('body').on('change', '[name="patient_contact_number"]', function () {
        let number = $(this).val();
        if (number.length === 10) {
            $(this).removeClass('border-red');
            $(this).css('border', '0');
            let patient_first_name = $('[name="patient_first_name"]').val();
            let patient_last_name = $('[name="patient_last_name"]').val();
            $(this).closest('form').find('button.submit').removeAttr('disabled');

            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop),
            });


            if (params.q === 'admin-add-patients') {
                CheckNumberExists(number, patient_first_name, patient_last_name);
            }
        }
        else {
            alert("Length of Phone can not be less and more than. Avoid Using prefix or Country Codes");
            $(this).addClass('border-red');
            $(this).css('border', '1px solid red');
            $(this).closest('form').find('button.submit').attr('disabled', 'disabled');
        }
    });

    function CheckNumberExists(number, patient_first_name, patient_last_name) {
        let data = {
            number: number,
            first_name: patient_first_name,
            last_name: patient_last_name
        };
        $.ajax({
            url: '../backend/actions/patients/check-number-data.php',
            type: 'POST',
            data: data,
            success: function (data) {
                let success_modal = '<div class="modal fade" id="PatientsExistModal" tabindex="-1" aria-labelledby="PatientsExistModalLabel" aria-hidden="true">';
                success_modal += '<div class="modal-dialog modal-xl">';
                success_modal += '<div class="modal-content">';
                success_modal += '<div class="modal-header">';
                success_modal += '<h5 class="modal-title" id="PatientsExistModalLabel">Modal title</h5>';
                success_modal += '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                success_modal += ' </div>';
                success_modal += '<div class="modal-body bg_form_grey">'
                success_modal += '<table class="table align-middle mb-3 table-blue" id="table_patients"><thead><tr><th>PatientID</th><th>First Name</th><th>Last Name</th></tr></thead><tbody></tbody></table>'
                success_modal += '</div>'
                success_modal += '<div class="modal-footer">'
                success_modal += '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
                success_modal += '<button type="button" class="btn btn-primary">Save changes</button>'
                success_modal += '</div>'
                success_modal += '</div>'
                success_modal += '</div>'
                success_modal += '</div>';
                if (data !== '') {
                    $('body').append(success_modal);
                    $('#PatientsExistModal').modal('show');
                    let json_obj = JSON.parse(data);
                    console.log(json_obj);
                    let row = '';
                    for (const key in json_obj) {
                        row +="<tr>";
                        row +="<td>"+json_obj[key]['hospital_PatientId'];
                        row +="</td>";
                        row +="<td>"+json_obj[key]['hospital_PatientFirstName'];
                        row +="</td>";
                        row +="<td>"+json_obj[key]['hospital_PatientLastName'];
                        row +="</td>";
                        row +="</tr>";
                    }
                        $('#PatientsExistModal table>tbody').html(row);
                }
                /*
                let success_html = '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert"> ';
                success_html += '<strong>Patient added Sucessfully!</strong>  ';
                success_html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> '
                success_html += '</div>'
                if (data === "success") {
                    $(this_btn).parent().append(success_html);
                    setTimeout(() => {
                        $(this_btn).closest('form')[0].reset();
                        $(other_gender_val).detach();
                        $('[data-row^=row]').detach()
                        console.log($(this_btn).parent().find('.alert').remove());
                    }, 2000);
                }
                else {

                }
                */
            },
            error: function (error) {
                window.alert(error);
            }
        });
    }



})(jQuery);

