<section class="homemenus reservation">
 
   <div class="text_menu">
      <h2>Reservez chez BBQ.</h2>
      <p> Notre objectif c'est de vous faire voyager a travers les saveurs authentiques de notre cuisine</p>

   </div>

 </section>

<!-- message derreur pour lajout de lannonce -->
<?php if (isset($_SESSION['user'])&& !empty($_SESSION['user'])):?>
<h2 class="h2reservation">Nous avons le plaisir de vous accueillir chez nous  cher  <strong><?= $_SESSION['user']['firstname'] ?> <?= strtoupper($_SESSION['user']['lastname'])?> </strong> </h2>
<?= $reserverform?>

<?php endif ?>
