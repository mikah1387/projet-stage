<h1> GESTION DES MENUS</h1>

<!-- <?php var_dump($annonces) ?> -->
  <table>
    <thead>

    <th>Id_menu</th>
    <th>Titre</th>

    <!-- <th>CONTENU</th>
    <th>PRIX</th> -->

    <th>Actif</th>
    <th>Date</th>
    <th>Id_admin</th>
    <th>Nom</th>
    <th>Action</th>
    </thead>

    <tbody>
   
    <?php foreach ($annonces as  $annonce):?>
      
       <tr>
        <td> <?= $annonce['id_annonces']?></td>
        <td><?= $annonce['titre']?></td>
        <!-- <td><?= $annonce['detail']?></td>  -->
        <!-- <td><?= $annonce['prix']?></td> -->

        <td>
        <input  type="checkbox" class="checkboxAnnonces" <?=$annonce['actif']? 'checked' :"" ?> data-id ="<?= $annonce['id_annonces']?>">
         </td>
        <td><?= $annonce['date_creation']?></td>
        <td><?= $annonce['users_id']?></td>
        <td><?= $annonce['lastname']?></td>

        <td> 
        <a  href="/Annonces_fr/Public/annonces/modifier/<?= $annonce['id_annonces'] ?>" class="btn">Modifier</a>
         <a href="/Annonces_fr/Public/annonces/delete/<?= $annonce['id_annonces'] ?>" class="btn">Suprimer</a>
        </td>
       </tr>
       <?php endforeach ?>

    </tbody>

    </table>
    <p><a href="/Annonces_fr/Public/annonces/ajouter" class="btn"> Ajouter </a></p>



<!-- <a class="btn_annonces" href="/Annonces_fr/Public/annonces/ajouter"> Ajouter </a> -->
<!-- <a href="/Annonces_fr/Public/annonces/delete/<?= $annoncebyid['id'] ?>" class="btn_annonces">Suprimer</a>

<a href="/Annonces_fr/Public/annonces/modifier/<?= $annoncebyid['id'] ?>" class="btn_annonces">Modifier</a> -->