document.addEventListener('DOMContentLoaded', function() {
    const breakpoint = window.matchMedia('(min-width:768px)');
    let mySwipers = [];

    const breakpointChecker = function() {
        if (breakpoint.matches === true) {
            mySwipers.forEach((swiper) => {
                if (swiper !== undefined) swiper.destroy(true, true);
            });
            mySwipers = [];
            return;
        } else if (breakpoint.matches === false) {
            return enableSwipers();
        }
    };

    const enableSwipers = function() {
        const sliders = document.querySelectorAll('.swiper');
        sliders.forEach((slider) => {
            let mySwiper = new Swiper(slider, {
                slidesPerView: 1.2,
                spaceBetween: 20,
                pagination: {
                    el: slider.querySelector('.swiper-pagination'),
                    type: 'custom',
                    renderCustom: function (swiper, current, total) {
                        const formatNumber = (number) => number.toLocaleString('fr-FR', { minimumIntegerDigits: 2, useGrouping: false });
                        return formatNumber(current) + ' - ' + formatNumber(total); 
                    }
                },
                navigation: {
                    nextEl: slider.querySelector('.swiper-button.next'),
                    prevEl: slider.querySelector('.swiper-button.prev'),
                    enabled: true,
                },
            });
            mySwipers.push(mySwiper);
        });
    };

    breakpoint.addEventListener('change', breakpointChecker);
    breakpointChecker();
});
