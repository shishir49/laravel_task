$(document).ready(function(){
    $('.menu-item').on('click', function() {
        $(this).parent('.primary-menu').find('.dropdown-content').toggleClass('invisible', 1000);
    });
});