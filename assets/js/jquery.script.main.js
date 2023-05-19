jQuery.noConflict();
(function ($) {
    // #### for side bar menu ### //

    //adding classes to submenu
    $("#aside-menu >li").addClass('aside-main-menu');
    let main_link = $("#aside-menu >li>a").toArray();
    let count = 0;
    for (let index = 0; index < main_link.length; index++) {
        $(main_link[index]).addClass('aside-main-menu-link');
        $(main_link[index]).attr('role', 'button');
        $(main_link[index]).attr('id', $(main_link[index]).text().trim());
        $(main_link[index]).attr('data-id', 'data-' + $(main_link[index]).text().trim());
        if ($(main_link[index]).next().closest('ul').length !== 0) {
            $(main_link[index]).attr('data-number-get', count);
            count = count + 1;
        }
    }


    let sub_menus = $('#aside-menu ul').toArray();
    for (let index = 0; index < sub_menus.length; index++) {
        $(sub_menus[index]).addClass('submenu-item-list submenu_' + [index]);
        $(sub_menus[index]).attr('data-get', 'data-' + $(sub_menus[index]).prev().text().trim());
        $(sub_menus[index]).attr('id', 'submenu_' + [index]);
        $(sub_menus[index]).attr('data-number', $(sub_menus[index]).prev().attr('data-number-get'));
        $(sub_menus[index]).find('li').addClass('submenu-item');
        $(sub_menus[index]).find('li a').addClass('submenu-item-link');
    }


    //detaching all the submenu_classes;
    let sub_menus__ = $('.submenu-item-list').toArray();
    for (let index = 0; index < sub_menus__.length; index++) {
        let $expand_close_sub_menu = '<div class="open_close"><i class="fa-duotone fa-angle-up"></i></div>';
        console.log($(sub_menus__[index]).parent().append($expand_close_sub_menu));
        if($(window).width() >= 992){
            $(sub_menus__[index]).detach();
        }
    }
    $('body').on('click', '.aside-main-menu-link', function (e) {
        
        $('.aside-main-menu-link.active--submenu').removeClass('active--submenu');
        $(this).addClass('active--submenu');
        let data_id = $(this).attr('data-number-get');
        if ($(this).hasClass('active--submenu')) {
            $(sub_menus__).detach();
            $(this).parent().append(sub_menus__[data_id]);
            $(this).parent().find('i').removeClass('fa fa-angle-up');
            $(this).parent().find('i').addClass('fa fa-angle-down');
        }
    })

    $('body').on('click', '.open_close' , function(){
        $('.aside-main-menu-link.active--submenu').removeClass('active--submenu');
        $(this).parent().find('.aside-main-menu-link').addClass('active--submenu');
        let data_id = $(this).parent().find('.aside-main-menu-link').attr('data-number-get');
        // console.log(data_id);
        if ($(this).parent().find('.aside-main-menu-link').hasClass('active--submenu') && jQuery(this).parent().find('ul').length ===0) {
            $(sub_menus__).detach();
            $(this).parent().append(sub_menus__[data_id]);
            $(this).find('i').removeClass('fa fa-angle-up');
            $(this).find('i').addClass('fa fa-angle-down');
        }
        else if($(this).parent().find('.aside-main-menu-link').hasClass('active--submenu') && jQuery(this).parent().find('ul').length <= 1){
            $(this).parent().find('.aside-main-menu-link').removeClass('active--submenu');
            $(sub_menus__).detach();
            $(this).find('i').removeClass('fa fa-angle-down');
            $(this).find('i').addClass('fa fa-angle-up');

        }
    });

    // #### for side bar menu ### //


    // #### datatables ### //

    $('.datatable').DataTable({
        autoWidth: false,
        // order: [[0, 'desc']],
        responsive: true
    });





    // #### datatables ### //


})(jQuery);


// ### for image preview ###//
jQuery.noConflict();
(function ($) {

    $('body').on('change', '.image-upload', function (event) {
        let $image_prev = $(this).parent().find('.image-preview');
        if ($($image_prev).children().length === 0) {
            $image_prev.append('<img class="preview" src=""/>')
        }
        $('.preview').attr('src', URL.createObjectURL(event.target.files[0]));
    });
})(jQuery);
// ### for image preview ###//


// ## responsive
(function($){
    let width = $(window).width();
    //side menu parent element
    let side_menu = $('#aside-menu');

    //top menu
    let top_menu = $('#navbarLeftAlignExample >ul');
    $(window).on('resize', function(){
        window.location.reload();
        chnageSideMenuToTopMenu(width)
    })
    $(window).on('load', function(){
        chnageSideMenuToTopMenu(width)
    })

    function chnageSideMenuToTopMenu(width){
        if(width <= 991){
            // console.log("chnage menu")
            const new_items = addclasstoli();
            // console.log(new_items);
            top_menu.prepend(new_items);
        }
    }
    
    function addclasstoli(){
        let new_to_menu_items = '';
        for (let index = 0; index < side_menu.length; index++) {
            $(side_menu[index]).removeClass();
            $(side_menu[index]).find('a').removeClass();
            $(side_menu[index]).find('.open_close').remove();
            $(side_menu[index]).find('li').removeClass()
            $(side_menu[index]).find('li').addClass('nav-item dropdown')
            $(side_menu[index]).find('li ul li').removeClass()
            $(side_menu[index]).find('li ul li>a').removeClass()
            $(side_menu[index]).find('li>a:not(a.dropdown-item)').addClass('nav-link ')
            $(side_menu[index]).find('li ul li>a').removeClass('dropdown-toggle')
            $(side_menu[index]).find('li ul li>a').addClass('dropdown-item')
            if($(side_menu[index]).find('li>a').next('ul').length !== 0){
                $(side_menu[index]).find('li>a:not(a.dropdown-item)').addClass('dropdown-toggle');
                $(side_menu[index]).find('li>a:not(a.dropdown-item)').attr('data-mdb-toggle' ,'dropdown');
            }
            $(side_menu[index]).find('.dropdown ul').addClass('dropdown-menu')
           
        }
        // new_to_menu_items += '<li class="nav-item dropdown">';
        new_to_menu_items += $(side_menu).html();
        $(side_menu).parent().parent().parent().detach();
        // new_to_menu_items += '</li>';
        return new_to_menu_items ;
    }
    
    
})(jQuery)
// ## responsive
