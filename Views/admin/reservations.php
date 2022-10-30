<h1> GESTION DES RESERVATIONS</h1>

<?php $count=0; $decount=0;
    foreach ($reservations as  $reserv) {
      if ($reserv['etat']==1) {
         $count++;
       }else{
         $decount++;
       } 

    }?>
    <span class="btn"> Réservations annulées :<span class="count"> <?=$decount  ?> </span></span>
   <span class="btn">Réservations Confirmées : <span class="count"> <?=$count  ?></span></span>
   <div class="btn"><a href="/Annonces_fr/Public/reservations" > Ajouter </a></div>

<table>
    <thead>

    <th>Ref_Reservation</th>
    <th>Ref_CLIENT</th>
    <th>NOM</th>

    <th>PRENOM</th>
    <th>DEMANDE</th>

    <th>DATE_DEMANDE</th>

    <th>DATE_RESERVATIONS</th>
    <th>HEURE</th>
    <th>NOMBRE_PERSONNES</th>
    <th>CREER_PAR</th>
    <th>ETAT</th>
    <th>ACTION</th>

    </thead>

    <tbody>
   
    <?php 
    foreach ($reservations as  $reserv):?>
      
       <tr>
         <td> <?= $reserv['id_reservations']?></td>
         <td><?= $reserv['id_users']?></td>
         <td><?= $reserv['lastname']?></td>
         <td><?= $reserv['firstname']?></td>

        
         <td><?= $reserv['demande']?></td>
         <td><?= $reserv['date_creation']?></td>
         <td><?= $reserv['date_reservation']?></td>
         <td><?= $reserv['heure']?></td>
         <td><?= $reserv['nombres']?></td>
         <td><?= $reserv['roles']?></td>
         <td>
       
         <?=$reserv['etat']? 'Validée' :"Annulée" ?> 
         </td>
         <td> 
         <a  href="/Annonces_fr/Public/reservations/modifier/<?= $reserv['id_reservations']?>" class="btn_annonces">Modifier</a>
         <a href="/Annonces_fr/Public/reservations/delete/<?= $reserv['id_reservations']?>" class="btn_annonces">Suprimer</a>
         <?php if ($reserv['etat']):?>

         <a href="/Annonces_fr/Public/reservations/annuler/<?= $reserv['id_reservations']?>" class="btn_annonces annuler" >Annuler</a>
         <?php endif?> 

          </td>
       </tr>
       
       <?php endforeach ?>

    </tbody>

    </table>
    <div>
   

</div>
    