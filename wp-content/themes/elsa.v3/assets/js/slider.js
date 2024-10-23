document.addEventListener('DOMContentLoaded', function() {

    const breakpoint = window.matchMedia( '(min-width:768px)' );
    let mySwiper;

    const breakpointChecker = function() {

        if ( breakpoint.matches === true ) {            
            if ( mySwiper !== undefined ) mySwiper.destroy( true, true );
            return;

        } else if ( breakpoint.matches === false ) {
            return enableSwiper();
        }
    };
    

    const enableSwiper = function() {

        mySwiper = new Swiper('.ressources.swiper', {
            slidesPerView: 1.2,
            spaceBetween: 20,
            // autoplay: true,
            pagination: {
            el: ".swiper-pagination",
            type: 'custom',
                renderCustom: function (swiper, current, total) {
                    const formatNumber = (number) => number.toLocaleString('fr-FR', { minimumIntegerDigits: 2, useGrouping: false });
                    return formatNumber(current) + ' - ' + formatNumber(total); 
                }
            },
            navigation: {
            nextEl: '.swiper-button.next',
            prevEl: '.swiper-button.prev',
            enabled: true,
            },
        });

    };

    breakpoint.addEventListener('change', breakpointChecker);

    breakpointChecker();
});