// Medical Boons - JavaScript

document.addEventListener('DOMContentLoaded', function () {

    /* ===============================
       MOBILE MENU FINAL FIX
    =============================== */
    const navToggle = document.querySelector('.navbar-toggle');
    const navMenu = document.querySelector('.navbar-menu');

    if (navToggle && navMenu) {
        const navIcon = navToggle.querySelector('i');

        function openMenu() {
            navMenu.classList.add('active');
            navToggle.setAttribute('aria-expanded', 'true');

            if (navIcon) {
                navIcon.classList.remove('fa-bars');
                navIcon.classList.add('fa-times');
            }
        }

        function closeMenu() {
            navMenu.classList.remove('active');
            navToggle.setAttribute('aria-expanded', 'false');

            if (navIcon) {
                navIcon.classList.remove('fa-times');
                navIcon.classList.add('fa-bars');
            }
        }

        navToggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            if (navMenu.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });

        navMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });

        document.addEventListener('click', function (e) {
            if (
                navMenu.classList.contains('active') &&
                !navMenu.contains(e.target) &&
                !navToggle.contains(e.target)
            ) {
                closeMenu();
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 992) {
                closeMenu();
            }
        });
    }


    /* ===============================
       SMOOTH SCROLL
    =============================== */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            if (!href || href === '#') return;

            const target = document.querySelector(href);

            if (target) {
                e.preventDefault();

                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });


    /* ===============================
       ANIMATE ON SCROLL
    =============================== */
    const animateOnScroll = function () {
        const elements = document.querySelectorAll('.animate');

        elements.forEach(function (element) {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;

            if (elementTop < window.innerHeight - 80 && elementBottom > 0) {
                const delay = element.getAttribute('data-delay') || 0;

                setTimeout(function () {
                    element.classList.add('show');
                }, delay);
            }
        });
    };

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();


    /* ===============================
       COUNTER ANIMATION
    =============================== */
    const animateCounters = function () {
        const counters = document.querySelectorAll('.stat-number');

        counters.forEach(function (counter) {
            if (counter.classList.contains('counted')) return;

            const target = parseInt(counter.textContent.replace(/\D/g, ''), 10);

            if (isNaN(target)) return;

            const elementTop = counter.getBoundingClientRect().top;

            if (elementTop < window.innerHeight) {
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const updateCounter = function () {
                    current += step;

                    if (current < target) {
                        counter.textContent = Math.floor(current) + '+';
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target + '+';
                        counter.classList.add('counted');
                    }
                };

                updateCounter();
            }
        });
    };

    window.addEventListener('scroll', animateCounters);
    animateCounters();


    /* ===============================
       WHATSAPP BUTTON PULSE
    =============================== */
    const whatsappBtn = document.querySelector('.whatsapp-float');

    if (whatsappBtn) {
        setInterval(function () {
            whatsappBtn.classList.add('pulse');

            setTimeout(function () {
                whatsappBtn.classList.remove('pulse');
            }, 1000);
        }, 5000);
    }

});


/* ===============================
   TESTIMONIALS SLIDER
   Keep this only if jQuery is loaded
================================ */
if (typeof jQuery !== 'undefined') {
    jQuery(document).ready(function ($) {
        const track = $('.testimonial-track');
        const cards = $('.testimonial-card');
        const totalCards = cards.length;
        const dotsContainer = $('.slider-dots');

        if (!track.length || !cards.length) return;

        let currentIndex = 0;
        let cardsToShow = 3;
        let totalDots = 1;

        function updateCardsToShow() {
            if ($(window).width() < 768) {
                cardsToShow = 1;
            } else if ($(window).width() < 992) {
                cardsToShow = 2;
            } else {
                cardsToShow = 3;
            }

            totalDots = Math.ceil(totalCards / cardsToShow);
        }

        function createDots() {
            dotsContainer.empty();

            for (let i = 0; i < totalDots; i++) {
                dotsContainer.append(
                    `<span class="slider-dot ${i === 0 ? 'active' : ''}" data-index="${i}"></span>`
                );
            }
        }

        function updateSlider() {
            const cardWidth = $('.testimonial-card').outerWidth(true);
            const offset = -(currentIndex * cardWidth * cardsToShow);

            track.css('transform', `translateX(${offset}px)`);

            $('.slider-dot').removeClass('active');
            $(`.slider-dot[data-index="${currentIndex}"]`).addClass('active');

            $('.prev-btn').prop('disabled', currentIndex === 0);
            $('.next-btn').prop('disabled', currentIndex >= totalDots - 1);
        }

        $('.next-btn').on('click', function () {
            if (currentIndex < totalDots - 1) {
                currentIndex++;
                updateSlider();
            }
        });

        $('.prev-btn').on('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        $(document).on('click', '.slider-dot', function () {
            currentIndex = $(this).data('index');
            updateSlider();
        });

        setInterval(function () {
            if (currentIndex < totalDots - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }

            updateSlider();
        }, 5000);

        $(window).on('resize', function () {
            updateCardsToShow();
            createDots();
            currentIndex = 0;
            updateSlider();
        });

        updateCardsToShow();
        createDots();
        updateSlider();
    });
}