<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Salon de coiffure</title>
    <link rel="stylesheet" href="css/accueil.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<header>
    <nav class="menu menu-1">
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="prestations.php">Prestations</a></li>
    
            <li><a href="avis.php">Avis</a></li>
        </ul>
    </nav>
</header>

<body>
<section id="about" class="about-section">
    <div class="myvideo">
        <video autoplay muted loop id="">
            <source src="img/okok.mp4" type="video/mp4"> 
        </video>
    </div>
        <div class="container">
            <h2 class="animated-heading">À Propos de Moi</h2> <div class="about-content">
                <p>Bienvenue chez Sab'arber, votre destination ultime pour une expérience de coiffure inoubliable.<br> Fondé par Sabri, un passionné de l'art capillaire avec plus de 5 ans d'expérience, mon salon se dédie à offrir des services de qualité supérieure dans une ambiance accueillante et professionnelle.</p>
                <p>Chez Sab'arber, nous croyons en la beauté de l'individualité et travaillons avec vous pour créer des looks qui reflètent votre personnalité unique.<br> Que vous recherchiez une coupe classique, un rasage traditionnel, ou les dernières tendances en matière de soins de la barbe, Je serai là pour répondre à tous vos besoins.</p>
                <p>Venez vivre l'expérience Sab'arber - où tradition et innovation se rencontrent pour célébrer votre style.</p>
            </div>
        </div>
        <button type="button" class="firstbutton" onclick="window.location.href='reservation.php'">Réservez</button>
    </section>
    <div class="separator"></div>

    <section id="realisations" class="realisations-section">
    <div class="container">
        <h2 class="animated-headings">Mes Réalisations</h2>
        <div class="carousel">
            <div class="slides">
                <div class="slide">
                    <img src="img/image1.jpeg" alt="Image 1">
                </div>
                <div class="slide">
                    <img src="img/image2.jpg" alt="Image 2">
                </div>
                <div class="slide">
                    <img src="img/image3.jpg" alt="Image 3">
                </div>
            </div>
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div>
    </div>
    <button type="button" class="secondbutton" onclick="window.location.href='prestations.php'">Mes prestations</button>
</section>

<footer class="footer">
<div class="separator"></div>
  	 <div class="container">
  	 	<div class="row">
  	 		<div class="footer-col">
  	 			<h4>Mes Services</h4>
  	 			<ul>
  	 				<li><a href="prestations.php">Barbe</a></li>
  	 				<li><a href="prestations.php">Coupe</a></li>
  	 				<li><a href="prestations.php">Soins visage</a></li>
  	 				<li><a href="prestations.php">Coupe + Barbe</a></li>
  	 				<li><a href="prestations.php">Coupe + Barbe + Soins</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>Suivez-moi</h4>
  	 			<div class="social-links">
                   <a href="https://wa.me/0783296346"><i class="fab fa-whatsapp"></i></a>
  	 				<a href="#"><i class="fab fa-facebook-f"></i></a>
  	 				<a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
  	 			</div>
                   <a href="mailto:amine.chikh@ynov.com">amine.chikh@ynov.com</a>
  	 		</div>
  	 	</div>
  	 </div>
       <button class="custom-button">Réservez</button>
  </footer>
<script>document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelector('.slides');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    let slideWidth = slides.firstElementChild.clientWidth;
    let slideIndex = 0;

    function slideLeft() {
        slideIndex++;
        if (slideIndex >= slides.children.length) {
            slideIndex = 0;
        }
        slides.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
        slides.style.transition = 'transform 0.5s ease';
    }

    function slideRight() {
        slideIndex--;
        if (slideIndex < 0) {
            slideIndex = slides.children.length - 1;
        }
        slides.style.transform = `translateX(-${slideWidth * slideIndex}px)`;
        slides.style.transition = 'transform 0.5s ease';
    }

    nextBtn.addEventListener('click', () => {
        slideLeft();
    });

    prevBtn.addEventListener('click', () => {
        slideRight();
    });
});

</script>
</body>
</html>
