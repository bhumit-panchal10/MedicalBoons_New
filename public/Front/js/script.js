// Medical Boons - JavaScript

// Wait for DOM to load
document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile menu toggle
    const navToggle = document.querySelector('.navbar-toggle');
    const navMenu = document.querySelector('.navbar-menu');
    
    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }
    
    // Close mobile menu when clicking a link
    const navLinks = document.querySelectorAll('.navbar-menu a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
        });
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Animate elements on scroll
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.animate');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementBottom = element.getBoundingClientRect().bottom;
            
            if (elementTop < window.innerHeight && elementBottom > 0) {
                const delay = element.getAttribute('data-delay') || 0;
                setTimeout(() => {
                    element.classList.add('show');
                }, delay);
            }
        });
    };
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run once on load
    
    // Counter animation for stats
    const animateCounters = () => {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            if (counter.classList.contains('counted')) return;
            
            const target = parseInt(counter.textContent);
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current) + '+';
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target + '+';
                    counter.classList.add('counted');
                }
            };
            
            const elementTop = counter.getBoundingClientRect().top;
            if (elementTop < window.innerHeight) {
                updateCounter();
            }
        });
    };
    
    window.addEventListener('scroll', animateCounters);
    
    // WhatsApp button pulse animation
    const whatsappBtn = document.querySelector('.whatsapp-float');
    if (whatsappBtn) {
        setInterval(() => {
            whatsappBtn.classList.add('pulse');
            setTimeout(() => {
                whatsappBtn.classList.remove('pulse');
            }, 1000);
        }, 5000);
    }
});

// jQuery version (if jQuery is loaded)
if (typeof jQuery !== 'undefined') {
    (function($) {
        $(document).ready(function() {
            
            // Smooth scrolling
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if(target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 70
                    }, 1000);
                }
            });
            
            // Animate on scroll
            function animateOnScroll() {
                $('.animate').each(function() {
                    var elementTop = $(this).offset().top;
                    var viewportBottom = $(window).scrollTop() + $(window).height();
                    
                    if (elementTop < viewportBottom - 100) {
                        var $element = $(this);
                        var delay = $element.attr('data-delay') || 0;
                        setTimeout(function() {
                            $element.addClass('show');
                        }, delay);
                    }
                });
            }
            
            $(window).on('scroll', animateOnScroll);
            animateOnScroll();
            
            // Counter animation
            function animateCounters() {
                $('.stat-number').each(function() {
                    if ($(this).hasClass('counted')) return;
                    
                    var $this = $(this);
                    var elementTop = $this.offset().top;
                    var viewportBottom = $(window).scrollTop() + $(window).height();
                    
                    if (elementTop < viewportBottom) {
                        var countTo = parseInt($this.text());
                        
                        $({ countNum: 0 }).animate({
                            countNum: countTo
                        }, {
                            duration: 2000,
                            easing: 'swing',
                            step: function() {
                                $this.text(Math.floor(this.countNum) + '+');
                            },
                            complete: function() {
                                $this.text(countTo + '+');
                                $this.addClass('counted');
                            }
                        });
                    }
                });
            }
            
            $(window).on('scroll', animateCounters);
            
            // Mobile menu toggle
            $('.navbar-toggle').on('click', function() {
                $('.navbar-menu').toggleClass('active');
            });
            
            // Close mobile menu when clicking a link
            $('.navbar-menu a').on('click', function() {
                $('.navbar-menu').removeClass('active');
            });
            
            // WhatsApp button pulse
            setInterval(function() {
                $('.whatsapp-float').addClass('pulse');
                setTimeout(function() {
                    $('.whatsapp-float').removeClass('pulse');
                }, 1000);
            }, 5000);
            
        });
    })(jQuery);
}

// Testimonials Slider
$(document).ready(function() {
    const track = $('.testimonial-track');
    const cards = $('.testimonial-card');
    const totalCards = cards.length;
    let currentIndex = 0;
    let cardsToShow = 3;
    
    // Adjust cards to show based on screen size
    function updateCardsToShow() {
        if ($(window).width() < 768) {
            cardsToShow = 1;
        } else if ($(window).width() < 992) {
            cardsToShow = 2;
        } else {
            cardsToShow = 3;
        }
    }
    
    // Create dots
    const dotsContainer = $('.slider-dots');
    const totalDots = Math.ceil(totalCards / cardsToShow);
    for (let i = 0; i < totalDots; i++) {
        dotsContainer.append(`<span class="slider-dot ${i === 0 ? 'active' : ''}" data-index="${i}"></span>`);
    }
    
    // Update slider position
    function updateSlider() {
        const cardWidth = $('.testimonial-card').outerWidth(true);
        const offset = -(currentIndex * cardWidth * cardsToShow);
        track.css('transform', `translateX(${offset}px)`);
        
    // Update dots
    $('.slider-dot').removeClass('active');
    $(`.slider-dot[data-index="${currentIndex}"]`).addClass('active');
        
    // Update button states
    $('.prev-btn').prop('disabled', currentIndex === 0);
    $('.next-btn').prop('disabled', currentIndex >= totalDots - 1);
}
    
    // Next button
    $('.next-btn').on('click', function() {
    if (currentIndex < totalDots - 1) {
        currentIndex++;
        updateSlider();
    }
});
    
// Previous button
$('.prev-btn').on('click', function() {
    if (currentIndex > 0) {
        currentIndex--;
        updateSlider();
    }
});
    
// Dot click
$(document).on('click', '.slider-dot', function() {
    currentIndex = $(this).data('index');
    updateSlider();
});
    
// Auto-slide every 5 seconds
setInterval(function() {
    if (currentIndex < totalDots - 1) {
        currentIndex++;
    } else {
        currentIndex = 0;
    }
    updateSlider();
}, 5000);
    
// Update on window resize
$(window).on('resize', function() {
    updateCardsToShow();
    currentIndex = 0;
    updateSlider();
});
    
// Initial setup
updateCardsToShow();
updateSlider();
});