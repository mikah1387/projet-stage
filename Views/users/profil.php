
<section class="homemenus profil">
 
  <div class="text_menu">
       <h2>
      Mon Profil </h2>
     <p>
      bienvenu cher <?= htmlentities(strtoupper($user['lastname'])) ?> <?=   htmlentities($user['firstname']) ?>

     </p>

     <div class="imageprofil">
       <img  src="<?= htmlentities(($user  ['imageprofil'])) ?>" alt="imageprofil">
    </div>
  </div>

</section>
 <?php $count = 0;

     $decount = 0;
       foreach ($Allreservs as  $reserv) {
        if ($reserv['etat'] == 1) {
        $count++;
         } else {
         $decount++;
      }
     } 
  
?>
   
   <div class="modal-container">
  <div class="overly "></div>
  <div class="modal modal-modifier">
    <button class="close-modal modal-triggerModifier"> X</button>
    <h2><h2>

    
    <a  class="btn_modifier"> oui </a>

  </div>
  
  <div class="modal modal-annuler">
    <button class="close-modal modal-triggerAnnuler"> X</button>
    <h2></h2>
    
    
    <a  class="btn_annuler"> oui </a>

  </div>
  <!-- <div class="modal modal-suprimer">
    <button class="close-modal modal-triggersuprimer"> X</button>
    <h2>Voulez vous vraiment suprimer votre Menu !</h2>
   
    
    <a  class="btn_suprimer"> oui </a>

  </div> -->
</div>


<div class="btns">
    <!-- <div class="btn">
        <a href="/Annonces_fr/Public/users/modifier/<?= $user['id_users'] ?>">Modifier mon profil</a>
    </div> -->
    <div class="btn btn_modif" data-button="1">
       Modifier mon profil
    </div>
    <div class="btn btn_modif active " data-button="2">
        Vos reservations
    </div>
    <div class="btn btn_modif"  data-button="3">
        Vos avis
    </div>
    

<!-- <div class="btn btn-modale modal-trigger">
   open 
</div> -->
   
<div class="modifierprofil" id="info1">
   <?= $modifierprofil?>
</div>

<div class="infotab active" id="info2">
    <div class="info">

        <div class="inforeserv">
            <h3>Réservations annulées
            </h3>
            <p class="count">
                <?= $decount  ?>
            </p>

        </div>
        <div class="inforeserv">
            <h3>Réservations Confirmées
            </h3>

            <p class="count">
                <?= $count  ?>
            </p>
        </div>
    </div>


  <table>
     <thead>

      <th>Ref_Reservation</th>
      <th>Date</th>
      <th>Heure</th>
      <th>Nombre</th>
      <th>Etat</th>
      <th>Action</th>

     </thead>

     <tbody>

       <?php foreach ($Allreservs as  $reserv) : ?>

         <tr>
            <td> <?= $reserv['id_reservations'] ?></td>

            <td><?= $reserv['date_reservation'] ?></td>
            <td><?= $reserv['heure'] ?></td>
            <td><?= $reserv['nombres'] ?></td>
            <td  <?php if ($reserv['etat']):?>style="color: green;"<?php else:?> style="color: red;" <?php endif?> >
               
               <?= $reserv['etat'] ? 'Validée' : "Annulée" ?>
            </td>

            <td>
            <!-- href="/Annonces_fr/Public/reservations/modifier/<?= $reserv['id_reservations'] ?>" -->
               <a class="icon iconeedit modal-triggerModifier" data-url ="/reservations/modifier/<?= $reserv['id_reservations'] ?>" > </a>
          
            
               <?php if ($reserv['etat']) : ?>
                  
                  <!-- <a class="icon iconecancel modal-triggerAnnuler" data-url ="/Annonces_fr/Public/reservations/annuler/<?= $reserv['id_reservations'] ?>" ></a> -->
                  <a class="icon iconecancel modal-triggerAnnuler" data-url="/reservations/annuler/<?= $reserv['id_reservations'] ?>"></a>
                 
               <?php endif ?>

            </td>
           </tr>
        <?php endforeach ?>

       </tbody>

       </table>
</div>

<div class="comments commentprofil" id="info3">
  <h3> Vos avis </h3>
 <!-- <?= var_dump($Allcomments) ?> -->
   <?php foreach ($Allcomments  as $comment) : ?>

     <div class="commentone">
            
         
          <h3 ><?= $comment['titre'] ?> </h3>
         <p class="datecomment"> <?= $comment['date_creation'] ?></p>
         <div class="textcomment">
         <h3><?= $comment['titrecomment'] ?></h3>

         <p class="">
            <?= $comment['comment'] ?>
         </p>
         </div>
          <div class="btn delate_comment" data-id=<?= $comment['id_comments']?>>
            <a href="" > Suprimer</a>
          </div>
      </div> 
   <?php endforeach ?>

</div>