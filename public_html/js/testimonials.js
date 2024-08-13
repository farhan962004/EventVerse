document.addEventListener('DOMContentLoaded', () => {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.testimonial-slide');
    const totalSlides = slides.length;
    const visibleSlides = 2;

    function showSlides() {
        slides.forEach((slide, index) => {
            slide.style.opacity = '0';
            slide.style.transition = 'opacity 1s ease-in-out';
            slide.style.display = 'none';
            if (index >= currentSlide && index < currentSlide + visibleSlides) {
                slide.style.display = 'block';
                setTimeout(() => {
                    slide.style.opacity = '1';
                }, 10);
            }
        });
    }

    function changeSlide(direction) {
        currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
        showSlides();
    }

    let autoScroll = setInterval(() => changeSlide(visibleSlides), 3000);

    document.querySelector('.testimonial-container').addEventListener('mouseenter', () => clearInterval(autoScroll));
    document.querySelector('.testimonial-container').addEventListener('mouseleave', () => autoScroll = setInterval(() => changeSlide(visibleSlides), 3000));

    showSlides();
});
