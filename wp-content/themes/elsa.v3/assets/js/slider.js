document.addEventListener('DOMContentLoaded', function() {
    const breakpoint = window.matchMedia('(min-width:768px)');
    let mySwipers = []; // Stocker plusieurs instances de Swiper

    const breakpointChecker = function() {
        if (breakpoint.matches === true) {
            // Détruire tous les sliders si l'écran est large
            mySwipers.forEach((swiper) => {
                if (swiper !== undefined) swiper.destroy(true, true);
            });
            mySwipers = []; // Réinitialiser le tableau
            return;
        } else if (breakpoint.matches === false) {
            return enableSwipers(); // Activer les sliders sur les petits écrans
        }
    };

    const enableSwipers = function() {
        // Sélectionner tous les éléments ayant la classe swiper-container
        const sliders = document.querySelectorAll('.swiper');
        sliders.forEach((slider) => {
            let mySwiper = new Swiper(slider, {
                slidesPerView: 1.2,
                spaceBetween: 20,
                pagination: {
                    el: slider.querySelector('.swiper-pagination'), // Pagination spécifique à chaque slider
                    type: 'custom',
                    renderCustom: function (swiper, current, total) {
                        const formatNumber = (number) => number.toLocaleString('fr-FR', { minimumIntegerDigits: 2, useGrouping: false });
                        return formatNumber(current) + ' - ' + formatNumber(total); 
                    }
                },
                navigation: {
                    nextEl: slider.querySelector('.swiper-button.next'), // Boutons de navigation spécifiques à chaque slider
                    prevEl: slider.querySelector('.swiper-button.prev'),
                    enabled: true,
                },
            });
            mySwipers.push(mySwiper); // Ajouter l'instance au tableau
        });
    };

    breakpoint.addEventListener('change', breakpointChecker);
    breakpointChecker(); // Initial check
});
