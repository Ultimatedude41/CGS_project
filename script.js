
// Slideshow JS
document.addEventListener('DOMContentLoaded', function() {
    let slides = document.querySelectorAll(".slide");
    
    // Only run if slides exist on the page
    if (slides.length > 0) {
        let index = 0;
        
        function changeSlide() {
            slides[index].classList.remove("active");
            index = (index + 1) % slides.length;
            slides[index].classList.add("active");
        }
        
        setInterval(changeSlide, 5000); // change every 5 seconds
    }
});

