<section class="homemenus">
 
  <div class="text_menu">
   <h2> ADMINISTARATION ET GESTION </h2>
    <p> 
     Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, delectus!

    </p>
  </div>

</section>

<h2 class="inscrip">Modifier le menu </h2>

<!-- message derreur pour lajout de lannonce -->
<?php if(isset($_SESSION['flash'])): ?>
 <?php foreach ($_SESSION['flash'] as $key => $value):?>
  <?php if ($key == 'success'):?>
  <div class="success">
  <?=$value ?>
  </div>
  <?php else: ?>
  <div class="erreur">
  <?=$value ?>
  </div>
  <?php endif ?>
  <?php unset($_SESSION['flash'])?>
 <?php endforeach?> 
 <?php endif?> 
<!-- message derreur pour le telechargement de l'image -->

 <?php if(isset($_SESSION['image'])): ?>
 <?php foreach ($_SESSION['image'] as $key => $value):?>
  <?php if ($key == 'success'):?>
  <div class="success">
  <?=$value ?>
  </div>
  <?php else: ?>
  <div class="erreur">
  <?=$value ?>
  </div>
  <?php endif ?>

  <?php unset($_SESSION['image'])?>
 <?php endforeach?> 
 <?php endif?> 

<?= $modifiermenu ?>

