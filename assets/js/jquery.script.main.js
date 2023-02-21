
jQuery.noConflict();
(function ($) {

    //adding classes to submenu
    $("#aside-menu >li").addClass('aside-main-menu');
    let main_link = $("#aside-menu >li>a").toArray();
    let count = 0;
    for (let index = 0; index < main_link.length; index++) {
        $(main_link[index]).addClass('aside-main-menu-link');
        $(main_link[index]).attr('role', 'button');
        $(main_link[index]).attr('id', $(main_link[index]).text().trim());
        $(main_link[index]).attr('data-id', 'data-'+$(main_link[index]).text().trim());
        if($(main_link[index]).next().closest('ul').length !== 0){
            $(main_link[index]).attr('data-number-get', count );
            count = count + 1;
        }
        
        
    }
    
    
    let sub_menus = $('#aside-menu ul').toArray();
    for (let index = 0; index < sub_menus.length; index++) {
        $(sub_menus[index]).addClass('submenu-item-list submenu_' + [index]);
        $(sub_menus[index]).attr('data-get', 'data-'+$(sub_menus[index]).prev().text().trim());
        $(sub_menus[index]).attr('id', 'submenu_' + [index]);
        $(sub_menus[index]).attr('data-number', $(sub_menus[index]).prev().attr('data-number-get'));
        $(sub_menus[index]).find('li').addClass('submenu-item');
        $(sub_menus[index]).find('li a').addClass('submenu-item-link');
    }


    //detaching all the submenu_classes;
    let sub_menus__ = $('.submenu-item-list').toArray();
    for (let index = 0; index < sub_menus__.length; index++) {
        $(sub_menus__[index]).detach();
    }
    $('body').on('click','.aside-main-menu-link', function(){
        $('.aside-main-menu-link.active--submenu').removeClass('active--submenu');
        $(this).addClass('active--submenu');
        let data_id = $(this).attr('data-number-get');
        if ($(this).hasClass('active--submenu')) {
            $(sub_menus__).detach();
            $(this).append(sub_menus__[data_id]);
        }
        else{
            
            
        }
    })

    






})(jQuery);