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
    $("#add-patient").closest('form').attr('id','patient-form');
    $('#patient-form input,#patient-form select ').addClass("patient_field");
    let $required_field = $('.patient_field:required');
    $('body').on('click', '#add-patient', function (event) {
        event.preventDefault();
        let form = $(this).closest('form');
        let form_data = $(form).serializeArray();
        // console.log(form_data);
        $post = [];
        for (let index = 0; index < form_data.length; index++) {
            let name = form_data[index]['name'];
            let value = form_data[index]['value'];
            
            for (let j = 0; j < $required_field.length; j++) {
                let req_name = $($required_field[j]).attr('name');
                let req_value = $($required_field[j]).attr('value');
                console.log(req_value);
                if(name === req_name){
                    if(req_value !== '' && req_value !== null && req_value !== undefined){
                        console.log(name, value);
                        $post.push({ [req_name]: req_value });
                    }
                    else{
                        console.log(name,"is a required field");
                    }
                }
            }


            // let is_required;
            // if ($('[name=' + name + ']').attr('type') === 'radio') {
            //     is_required = $('[name=' + name + ']').is(":checked");
            // }
            // else {
            //     is_required = $('[name=' + name + ']').is(":required");
            // }
            
            // if (is_required === true) {
                // $post.push({ [name]: value });
            // }
            // else {
                
            //     console.error(name, value);
                
            // }
            console.log($post);
        } 
    })











})(jQuery);