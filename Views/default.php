<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="http://localhost/Annonces_fr/node_modules/swiper/swiper-bundle.min.css"> -->
  <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>

  <link rel="stylesheet" href="http://localhost/Annonces_fr/Public/lib/output.css">
  <link rel="stylesheet" href="/lib/output.css">

  <title>The BBQ place</title>
</head>

<body>

  <!-- ***********header ****** -->

  <header>
    <a href="http://the-bbq-restaurant">
      <div class="logo">
        <img src="/lib/imagescss/petitlogo.png" alt="logo">
      </div>
    </a>
    <!-- ******navbar********** -->

    <nav <?= ((isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles']))) ? "style='background-color: #B19D61;'" : '' ?>>
      <div class="contain_ul">
        <ul class="ul_navbar">

          <li><a class="link " href="http://the-bbq-restaurant"> ACCUEIL</a> </li>
          <li> <a class="link" href="/annonces"> MENUS
            </a></li>
          <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>
            <?php if (isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) : ?>
              <li> <a class="link" href="/admin"> ADMIN </a></li>

            <?php endif ?>

            <li> <a class="link" href="/users/profil/<?= $_SESSION['user']['id'] ?>"> PROFIL </a></li>

          <?php else : ?>
            <li> <a class="link" href="/users/register"> INSCRIRE </a></li>

          <?php endif ?>
          <li><a class="link " href="/main/contact"> CONTACT</a> </li>
          <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>
            <li> <a class="link" href="/users/logout"> <i class="fas fa-power-off"></i> DECONNEXION </a></li>

          <?php else : ?>
            <li> <a class="link" href="/users/login"> <i class="fas fa-user"></i> CONNECTER </a> </li>
          <?php endif ?>
        </ul>
      </div>
      <div class="image_nav">
        <div class="btnexxplor">
          <div class="btn btn_explore">
            <a href="/annonces">Explorez le Menu </a>
          </div>
          <div class="btn btn_reserve">
            <a href="/reservations/reserver"> Reservez une table</a>
          </div>

        </div>
      </div>
    </nav>


    <div class="burger">
      <div class="btn-burger"></div>
    </div>

  </header>
  <!-- ******** Main ***************** -->

  <main id="swup" class="transition-fade">
    <div class=" content">

      <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $key => $value) : ?>

          <?php if ($key == 'success') : ?>
            <div class="success">
              <i class="fas fa-check-circle"></i> <?= $value ?>
            </div>
          <?php else : ?>
            <div class="erreur">
              <i class="fas fa-exclamation-circle"></i><?= $value ?>
            </div>
          <?php endif ?>
          <?php unset($_SESSION['flash']) ?>
        <?php endforeach ?>

      <?php endif ?>
      <!-- message derreur pour le telechargement de l'image -->

      <?php if (isset($_SESSION['image'])) : ?>
        <?php foreach ($_SESSION['image'] as $key => $value) : ?>
          <?php if ($key == 'success') : ?>
            <div class="successimage">
              <i class="fas fa-check-circle"></i><?= $value ?>
            </div>
          <?php else : ?>
            <div class="erreurimage">
              <i class="fas fa-exclamation-circle"></i> <?= $value ?>
            </div>
          <?php endif ?>

          <?php unset($_SESSION['image']) ?>
        <?php endforeach ?>
      <?php endif ?>
      <?php if (isset($content)) : ?>
        <!-- le chemain des fichies vues -->
        <?= $content ?>

      <?php endif ?>

    </div>
  </main>

  <!-- ************FOOTER************  -->
  <footer class="footer">

    <div class="reserve_us">
      <div class="contain">
        <p class="pfooter">Rejoignez-nous</p>
        <p> merci de reserver en ligne ou nous contacter par télephone</p>
        <p>Adresse</p>
        <p>12, quai du Port
          13002 MARSEILLE</p>
        <p> TEL : 04 91 04 71 92</p>
        <div class="btn btn_reserve">
          <a href="/reservations/reserver"> Reservez </a>
        </div>
      </div>

    </div>

    <div class="contact_us">
      <div class="contain2">

        <div class="icons">
          <a href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
              <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
            </svg></a>
          <a href="#"> <i class="fab fa-twitter fa-3x"></i></a>
          <a href="#"><i class="fab fa-instagram fa-3x"></i></a>


        </div>
      </div>
      <div class="links-footer">
        <a href="#">Copyright © 2022 BBQ Restaurant</a>
        <a href="#">Powered by BBQ Restaurant</a>

      </div> -->

    </div>
    </div>



  </footer>

  <!-- ***********links BIB************* -->

  <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
  <script src="https://unpkg.com/swup@latest/dist/SwupOverlayTheme.js"></script>
  <!-- <script src="http://localhost/Annonces_fr/node_modules/swiper/swiper-bundle.min.js"></script> -->
  <script src="https://kit.fontawesome.com/a6e90968a5.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
  <!-- <script src = "https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/gsap.min.js" ></script> <script src = "https://cdnjs.cloudflare.com /ajax/libs/gsap/3.11.2/ScrollTrigger.min.js" ></script> <script src = "https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/TextPlugin.min .js" ></script> -->
  <script src=" https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/TextPlugin.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js"></script>

  <script src="/js/APP.js"></script>

</body>

</html>