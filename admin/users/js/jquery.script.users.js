
jQuery.noConflict();
(function ($) {

$('body').on('change','.image-upload',function(event){
    let $image_prev = $(this).parent().find('.image-preview');
    if($($image_prev).children().length === 0){
        $image_prev.append('<img class="preview" src=""/>')
    }
    $('.preview').attr('src', URL.createObjectURL(event.target.files[0]));
});
})(jQuery);