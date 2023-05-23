(function($){
    let same_meds_block = $('#same-meds-diffrent-qty');
    let same_meds = $('#same-meds-diffrent-qty>*');
    same_meds.detach();
    $(document.body).on('change','#add-same-med', function(e){
        e.preventDefault();
        if($(this).prop('checked') === true){
            let to_display = $(this).data('append');
            $(same_meds_block).append(same_meds);
            childrenName();
        }
        else{
            same_meds.detach();
        }
    });

    $(document.body).on('click', 'button.add', function(e){
        e.preventDefault();
        // console.log()
        $(same_meds_block).append("<div class='d-flex flex-wrap flex-100 gap-10 mb-3'>"+same_meds.html()+"</div>");
        childrenName();
        
    });
    $(document.body).on('click','button.remove', function(e){
        e.preventDefault();
        $(this).closest('[data-children]').remove();
        const check = zero_children();
        if(check === true){
            $('#add-same-med').prop('checked', false);
        }
    });

    function zero_children(){
        console.log($(same_meds_block).length);
        if($(same_meds_block).children().length === 0){
            return true;
        }
        else{
            return false;
        }
    }

    function childrenName(){
        let childrens = $(same_meds_block).children().toArray();
        for (let index = 0; index < childrens.length; index++) {
            $(childrens[index]).attr('data-children','data-children-'+[index]);
        }
    }


    $(document.body).on('change', '[name="is-type-of"]',function(){
        $('[name="is-type-of"]').prop('checked', false);
        $(this).prop('checked', true);
    })

    // meds form
    $(document.body).on('submit','#meds-form', function(e){
        e.preventDefault();
        let form = $(this).closest('form');
        let form_data = $(form).serializeArray();
        let all_fields = $(form).find('.form-field');
        for (let index = 0; index < all_fields.length; index++) {
            if($(all_fields[index]).prop('required') === true ){
                let this_type = $(all_fields[index]).attr(type);
                switch (this_type) {
                    case 'text':
                        
                        break;
                
                    default:
                        break;
                }
            }
            
        }
        console.log(form_data)
        let data = {

        };
        $.ajax({
            url: '../backend/actions/meds/add-meds.php',
            type: 'POST',
            data: data,
            success: function (data) {
                console.log(data);
                let success_html = '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert"> ';
                success_html += '<strong>Patient Updated Sucessfully!</strong>  ';
                success_html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> '
                success_html += '</div>'
                /*
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
                            

                        });
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
    });


})(jQuery);