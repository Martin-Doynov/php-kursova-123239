<?php
//страница home
?>

<style>
.parallax-section {
    position: relative;
    min-height: 80vh;
    overflow: hidden;
    display: flex;
    align-items: center;
    /*background-color: rgba(0, 0, 0, 0.73);*/
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    opacity: 0;
    transform: translateY(50px);
    animation: sectionAppear 1s ease-out forwards;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.2);
    box-shadow: 
        0 0 30px rgba(46, 66, 139, 0.3),
        0 0 60px rgba(182, 52, 107, 0.2),
        inset 0 0 20px rgba(255, 255, 255, 0.1);
    background: rgba(0, 0, 0, 0.2);
}

.parallax-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 110%;
    background-image: url('https://www.flyingmag.com/uploads/2022/06/AdobeStock_249454423-scaled.jpeg?auto=webp&auto=webp&optimize=high&quality=70&width=1440');
    background-size: cover;
    background-position: center 20%;
    background-repeat: no-repeat;
    z-index: -2;
    transform: translateZ(0);
    scale: 1.2;
    opacity: 0;
    animation: imageAppear 1s ease-out 0.3s forwards;
}

.parallax-bg::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.72);
    z-index: -1;
}

.content-wrapper {
    position: relative;
    z-index: 1;
    color: white;
    width: 100%;
    opacity: 0;
    transform: translateY(30px);
    animation: contentAppear 1s ease-out 0.6s forwards;
}

.custom-button {
    background: transparent;
    border: 2px solid;
    border-image: linear-gradient(45deg, #2e428b, #b6346b) 1;
    color: white;
    padding: 15px 30px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.custom-button:hover {
    background: linear-gradient(45deg, rgba(46,66,139,0.2), rgba(182,52,107,0.2));
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    color: white;
}

.info-sections {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin: 4rem auto;
    max-width: 1400px;
    padding: 0 2rem;
    opacity: 0;
}

.promo-section, .contact-section {
    position: relative;
    min-height: 400px;
    border-radius: 20px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    transform: translateY(30px);
    opacity: 0;
    border: 2px solid rgba(255, 255, 255, 0.2);
    box-shadow: 
        0 0 20px rgba(46, 66, 139, 0.3),
        0 0 40px rgba(182, 52, 107, 0.2),
        inset 0 0 15px rgba(255, 255, 255, 0.1);
    background: rgba(0, 0, 0, 0.2);
}

.section-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    z-index: -2;
}

.section-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: -1;
}

.content-box {
    color: white;
    padding: 2rem;
    text-align: center;
    z-index: 1;
}

.background-slideshow {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: -999;
    background-color: black;
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 2s ease-in-out;
    background-size: cover;
    background-position: center;
}

.slide.active {
    opacity: 1;
}

.slide::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
}

@keyframes initialFade {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

.slide.active:first-child {
    animation: initialFade 0.5s ease-in-out;
}

@keyframes sectionAppear {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes imageAppear {
    to {
        opacity: 1;
    }
}

@keyframes contentAppear {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
window.addEventListener('scroll', function() {
    const offset = window.pageYOffset;
    document.querySelector('.parallax-bg').style.transform = 'translateY(' + (offset * 0.5) + 'px)';
});
</script>

<div class="background-slideshow">
    <div class="slide active" style="background-image: url('uploads/screen1.jpg')"></div>
    <div class="slide" style="background-image: url('uploads/screen2.jpg')"></div>
    <div class="slide" style="background-image: url('uploads/screen3.jpg')"></div>
    <div class="slide" style="background-image: url('uploads/screen4.jpg')"></div>
</div>

<script>
$(document).ready(function() {
    let currentSlide = 0;
    const slides = $('.slide');
    const totalSlides = slides.length;

    function nextSlide() {
        slides.eq(currentSlide).removeClass('active');
        currentSlide = (currentSlide + 1) % totalSlides;
        slides.eq(currentSlide).addClass('active');
    }

    setInterval(nextSlide, 5000);
});
</script>

<div class="parallax-section">
    <div class="parallax-bg"></div>
    <div class="content-wrapper">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center">
            <div class="col-lg-8 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1">Открийте света на приключенията!</h1>
                <p class="lead">Изживейте незабравимо пътуване с нашите първокласни полети. Предлагаме разнообразие от полети и дестинации, съобразени с вашите нужди и предпочитания.</p>
                <a href="#" class="btn custom-button btn-primary btn-lg px-4 me-md-2" id="reserveButton">Резервирай сега</a>

            
            <script>
            $(document).ready(function() { /* realno tuk ne mi trqbva ajax, no reshih da testvam ¯\_(ツ)_/¯*/
                $('#reserveButton').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: 'pages/products.php',
                        method: 'GET',
                        success: function(response) {
                            window.location.href = 'index.php?page=products';
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });
            });
            </script>

            </div>
        </div>
    </div>
</div>

<div class="info-sections">
    <div class="promo-section">
        <div class="section-bg" style="background-image: url('uploads/santaairplane.jpg')"></div>
        <div class="content-box">
            <h2 class="display-6 fw-bold">🎄 Коледна Промоция!</h2>
            <p class="lead">Използвайте код "SANTA25" за 5% отстъпка от вашата резервация</p>
            <div class="promo-code mt-3 p-3 border border-light rounded">
                <span class="h3">SANTA25</span>
            </div>
        </div>
    </div>
    
    <div class="contact-section">
        <div class="section-bg" style="background-image: url('uploads/contactus.jpg')"></div>
        <div class="content-box">
            <h2 class="display-6 fw-bold">Имате въпроси?</h2>
            <p class="lead">Не се колебайте да се свържете с нас</p>
            <a href="?page=contacts" class="btn btn-outline-light btn-lg mt-3 hover-shadow">Контакти</a>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Animate sections when they come into view
    $(window).scroll(function() {
        let windowBottom = $(this).scrollTop() + $(this).innerHeight() + 350;
        
        $('.info-sections').each(function() {
            let objectBottom = $(this).offset().top + $(this).outerHeight();
            
            if (objectBottom < windowBottom) {
                if (!$(this).hasClass('visible')) {
                    $(this).addClass('visible').animate({
                        opacity: 1
                    }, 500);
                    
                    $('.promo-section, .contact-section').animate({
                        opacity: 1,
                        top: 0
                    }, {
                        duration: 800,
                        easing: 'swing'
                    });
                }
            }
        });
    });
    
    // Trigger scroll once on page load
    $(window).trigger('scroll');
});
</script>

