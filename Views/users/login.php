<?php if(isset($_SESSION['flash'])): ?>
 <?php foreach ($_SESSION['flash'] as $key => $value):?>
 
  <?php if ($key == 'success'):?>
  <div class="success">
  <i class="fas fa-check-circle"></i> <?=$value ?>
  </div>
  <?php else: ?>
  <div class="erreur">
  <i class="fas fa-exclamation-circle"></i> <?=$value ?>
  </div>
  <?php endif ?>
  <?php unset($_SESSION['flash'])?>
 <?php endforeach?> 
 <?php endif?> 


 <section class="homemenus inscription">
 
  <div class="text_menu">
      <h2>
     bienvenue chez BBQ </h2>
    <p>
     Connecter

    </p>

   
 </div>

</section>

<h2 class="connect"> Se connecter</h2>

<?= $loginform ?>
<a class="forgot" href="/users/forgot">Mot de passe oublié</a>
