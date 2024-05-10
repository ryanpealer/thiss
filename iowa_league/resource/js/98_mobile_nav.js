jQuery(document).ready(function ($) {
    $(document).on('click', '.mobile-menu-toggle', function (e) {
        e.preventDefault();
        $('body,html').toggleClass('mobile-menu-show');
    });
    $(document).on('click', '.mobile-search-toggle', function (e) {
        e.preventDefault();
        if($('body,html').hasClass('mobile-menu-show')){
            $('body,html').removeClass('mobile-menu-show')
        } else {
            $('body,html').toggleClass('mobile-search-show');
        }
    });
    $('.menu-item-has-children > a').append('<span class="btn-toggle-submenu"><svg width="8" height="6" viewBox="0 0 8 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6L1.00137e-06 -6.99382e-07L8 0L4 6Z" fill="#005395"/></svg></span>');
    $(document).on('click', '.menu-item-has-children .btn-toggle-submenu', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).toggleClass('is-active');
        console.log($(this).closest('.menu-item-has-children'));
        $('.menu-item-has-children.is-active').not($(this).parents('.menu-item-has-children')).removeClass('is-active');
        $(this).closest('.menu-item-has-children').toggleClass('is-active');
        $(this).closest('.menu-item-has-children').find('.is-active').removeClass('is-active');
    });
})