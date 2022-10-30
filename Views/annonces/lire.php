<section class="homemenus">
  <div class="btn btn_menus">
    <a href="/Annonces_fr/Public/reservations/reserver">
      Reservez  </a>
  </div>
  <div class="text_menu">
    <h2>
      MENUS</h2>
    <p>
      S'inspirant de faits, d'événements et de recettes datant d'aussi loin que le
      XIII e siècle, la cuisine du BBQ est un menu moderne de plats inspirés de
      l'histoire francaise.

    </p>

  </div>

</section>

<div class="detailmenu">

  <h2>
    <?= htmlentities($annoncebyid['titre'])  ?>
  </h2>

  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php foreach ($imagebyannonce as $imageannonce) : ?>

        <div class="swiper-slide">
          <img src="<?= htmlentities($imageannonce['url_image'])  ?>" alt="">
        </div>
      <?php endforeach ?>

    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>
  <p><?= htmlentities($annoncebyid['detail'])  ?>
  </p>

</div>

<div class="comments">
   <h2>
    <?php $count = 0; ?>
    <?php foreach ($commentuser as $comment) : ?>

      <?php
      ($comment['actif'] == 1) ? $count++ : '' ?>
    <?php endforeach ?>
    Commentaires (<?= $count ?>)
   </h2>

     <?php foreach ($commentuser as $comment) : ?>

      <div class="commentone">
      <div class="imgprofil">
        <img src="<?= $comment['imageprofil'] ?>" alt="">
      </div>
      <p class="namecomment">

        <?= $comment['firstname'] ?>
        <?= substr(ucfirst($comment['lastname']), 0, 1) ?>
      </p>
      <p class="datecomment">
        <?= $comment['date_creation'] ?>
      </p>
      <div class="textcomment">
        <h3><?= $comment['titrecomment'] ?></h3>

        <p class="">
          <?= $comment['comment'] ?>
        </p>
      </div>

      <div class="likes">
        
        <span class="iconlike" data-id="<?= $comment['id_comments'] ?>"> </span> <span class="counter"><?= $likesss[$comment['id_comments']]['likess'] ?>
     </span>
          
        
          <span class="icondislike" data-id="<?= $comment['id_comments'] ?>"> </span>
           <span class="counter"> <?= $dislikes[$comment['id_comments']]['likess'] ?></span>
            
          
        
       </div>


      </div>
   <?php endforeach ?>
   <?php if (isset($_SESSION['user'])) : ?>
    <div class="btn btn_comment">
      <a href="/comments/commenter/<?= $annoncebyid['id_annonces'] ?>">Ajouter un commentaire</a>

    </div>
   <?php endif ?>

</div>