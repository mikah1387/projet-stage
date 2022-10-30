<section class="pagemenu">

  <section class="homemenus">
    <div class="btn btn_menus">
      <a href="/Annonces_fr/Public/reservations/reserver"> Reservez une table</a>
    </div>
    <div class="text_menu">
      <h2> MENUS</h2>
      <p>
        S'inspirant de faits, d'événements et de recettes datant d'aussi loin que le XIII e siècle, la cuisine du BBQ est un menu moderne de plats inspirés de l'histoire francaise.

      </p>
    </div>

  </section>

  <section class="entree">
    <h2>Nos entrées</h2>

    <div class="container">

      <?php if (!empty($imgmenuentree)) : ?>

        <?php foreach ($imgmenuentree
          as  $annonce) : ?>

          <a href="/annonces/lire/<?= $annonce[0]['id_annonces'] ?> ">
            <div class="article ">
              <img class="img_menu" src="<?= htmlentities($annonce[0]['url_image']) ?>" alt="">
              <div class="text_card">
                <h3> <?= htmlentities($annonce[0]['titre'])  ?> </h3>
                <p class="prix"> prix : <?= htmlentities($annonce[0]['prix']) ?> €
                </p>

              </div>
            </div>
          </a>

        <?php endforeach ?>
      <?php endif ?>

    </div>

  </section>

  <section class="plat">
    <h2>Nos plats</h2>

    <div class="container">

      <?php foreach ($imgmenuplat as  $annonce) : ?>

        <a href="/annonces/lire/<?= $annonce[0]['id_annonces'] ?> ">
          <div class="article ">
            <img class="img_menu" src="<?= htmlentities($annonce[0]['url_image']) ?>" alt="">
            <div class="text_card">
              <h3> <?= htmlentities($annonce[0]['titre'])  ?> </h3>
              <p class="prix"> prix : <?= htmlentities($annonce[0]['prix']) ?> €
              </p>

            </div>
          </div>
        </a>

      <?php endforeach ?>

    </div>

  </section>
  <section class="dessert">
    <h2>Nos desserts</h2>

    <div class="container">

      <?php foreach ($imgmenudessert as  $annonce) : ?>

        <a href="/annonces/lire/<?= $annonce[0]['id_annonces'] ?> ">
          <div class="article ">
            <img class="img_menu" src="<?= htmlentities($annonce[0]['url_image']) ?>" alt="">
            <div class="text_card">
              <h3> <?= htmlentities($annonce[0]['titre'])  ?> </h3>
              <p class="prix"> prix : <?= htmlentities($annonce[0]['prix']) ?> €
              </p>

            </div>
          </div>
        </a>

      <?php endforeach ?>

    </div>

  </section>
  <section class="dessert">
    <h2>Nos boissons</h2>

    <div class="container">

      <?php foreach ($imgmenuboisson as  $annonce) : ?>

        <a href="/annonces/lire/<?= $annonce[0]['id_annonces'] ?> ">
          <div class="article ">
            <img class="img_menu" src="<?= htmlentities($annonce[0]['url_image']) ?>" alt="image_menu">
            <div class="text_card">
              <h3> <?= htmlentities($annonce[0]['titre'])  ?> </h3>
              <p class="prix"> prix : <?= htmlentities($annonce[0]['prix']) ?> €
              </p>

            </div>
          </div>
        </a>

      <?php endforeach ?>

    </div>

  </section>



</section>