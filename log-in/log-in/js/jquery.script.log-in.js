
jQuery.noConflict();
(function ($) {

    $('body').on('click', '.log-in', function (event) {
        event.preventDefault();
        let form = $(this).closest('form');
        let form_data = $(form).serializeArray();
        console.log(form_data);
        $post = [];
        for (let index = 0; index < form_data.length; index++) {
            let name = form_data[index]['name'];
            let value = form_data[index]['value'];
            let is_required = $('[name=' + name + ']').is(':required');
            if (value !== '' && value !== null && is_required === true) {
                $post.push({ [name]: value });
            }
            else {
                console.error(name, value);
            }
        }
        console.log($post);
        let data = {
            'post': $post,
        }
        $.ajax({
            url: '../../backend/actions/log-in/log-in.php',
            type: 'POST',
            data: data,
            success: function (data) {
                if (data === '1') {
                    if ($('.log-in-wrapper').parent().children('.success').length === 0) {
                    $('.log-in-wrapper').parent().prepend('<div class="success"><p class="success-message">Login Success</p></div>')
                    $('.log-in-wrapper').parent().children('.success').hide().fadeIn(1000);
                    setTimeout(function () {
                        $('.log-in-wrapper').parent().children('.success').fadeOut(1000, function () {
                            $('.log-in-wrapper').parent().children('.success').remove();
                        })
                    }, 5000);
                    window.setTimeout(function(){
                        window.location.assign( "../../admin/index.php?q=admin-list-patients");
                    }, 5000);
                    
                    }
                }
                else {
                    if ($('.log-in-wrapper').parent().children('.failure').length === 0) {
                        $('.log-in-wrapper').parent().prepend('<div class="failure"><p class="failure-message">Invalid Username & Password</p></div>');
                        $('.log-in-wrapper').parent().children('.failure').hide().fadeIn(1000);
                        setTimeout(function () {
                            $('.log-in-wrapper').parent().children('.failure').fadeOut(1000, function () {
                                $('.log-in-wrapper').parent().children('.failure').remove();
                            })
                        }, 5000);
                    }
                }
            },
            error: function (error) {
                window.alert(error);
            }
        })

    });



})(jQuery);