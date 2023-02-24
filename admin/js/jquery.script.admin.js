jQuery.noConflict();
(function ($) {

    // add patients
    let other_gender_val = $('#Gender-Other-value');
    other_gender_val.detach();
    $('body').on('change', '[name=patient_gender]', function () {
        if ($('#Gender-Other').is(':checked')) {
            $(this).parent().parent().append(other_gender_val);
        }
        else {
            other_gender_val.detach();
        }
    });
    $("#add-patient").closest('form').attr('id', 'patient-form');
    $('#patient-form input,#patient-form select ').addClass("patient_field");
    $('body').on('click', '#add-patient', function (event) {
        event.preventDefault();
        let this_btn = $(this);
        let form = $(this).closest('form');
        let form_data = $(form).serializeArray();
        let required_field = $('.patient_field:required').toArray();
        let $post = new Object();
        for (let k = 0; k < form_data.length; k++) {
            let name = form_data[k]['name'];
            let value = form_data[k]['value'];
            let is_required;
            if ($('[name=' + name + ']').attr('type') === 'radio') {
                is_required = $('[name=' + name + ']').is(':checked');
            }
            else {
                is_required = $('[name=' + name + ']').is(':required');
            }
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
                    $("<div class='validation-message'></div>").insertAfter(required_field[i]);
                    $(required_field[i]).parent().children('.validation-message').hide().fadeIn(3000);
                    $(required_field[i]).next('.validation-message').append("<p>mandatory</p>");
                    setTimeout(() => {
                        $(required_field[i]).next('.validation-message').remove()
                    }, 5000);
                }

            }

        }

        console.log($post);
        let $post_length = Object.keys($post).length;

        $ajax_Arr = new Array();
        for (const key in $post) {
            if ($post[key] === '') {
                console.error($post[key])
                const req = isRequired(key);
                if (req === true) {
                    $ajax_Arr.push(1);
                    console.log('cannot send to ajax');
                }
                else {
                    $ajax_Arr.push(0);
                    console.log('send to ajax');
                }
            }
            else {
                $ajax_Arr.push(0);
                console.log('send to ajax');
            }
        }
        console.log($ajax_Arr);
        if ($post_length === $ajax_Arr.length) {
            const value0 = $ajax_Arr.reduce((a, b) => a + b, 0);
            console.log(value0);
            if (value0 === 0) {
                ajax_call($post, this_btn);
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

    function ajax_call($post, this_btn) {

        console.log(this_btn);
        let data = {
            'post': $post
        }
        $.ajax({
            url: '../backend/actions/patients/add-patient.php',
            type: 'POST',
            data: data,
            success: function (data) {
                console.log(data);
                let success_html = '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert"> ';
                success_html += '<strong>Patient added Sucessfully!</strong><a href="#">View patients</a>  ';
                success_html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> '
                success_html += '</div>'
                if (data === "success") {
                    $(this_btn).parent().append(success_html);
                    setTimeout(() => {
                        $(this_btn).closest('form')[0].reset();
                        $(other_gender_val).detach();
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

})(jQuery);