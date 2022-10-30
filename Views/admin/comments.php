<h1> GESTION DES COMMENTAIRES</h1>


<table>
    <thead>

    <th>ID_COMMENT</th>
    <th>TITRE</th>
    <th>CONTENU</th>
    <th>DATE_CREATION</th>
    <th>ACTIF</th>
    <th>REF_CLIENT </th>
    <th>REF_MENU</th>
    <th>ACTION</th>
    </thead>
    <tbody>
   
   <?php foreach ($Allcomments as  $comment):?>
     
      <tr>
       <td> <?= $comment['id_comments']?></td>
       <td><?= $comment['titrecomment']?></td>
       <td><?= $comment['comment']?></td>
       <td><?= $comment['date_creation']?></td>
       <td>
       <input  type="checkbox" class="checkboxComments" <?=$comment['actif']? 'checked' :"" ?> data-id ="<?= $comment['id_comments']?>">
        </td>
       <td><?= $comment['users_id']?></td>
       <td><?= $comment['annonces_id']?></td>
       <td> 
       
        <a href="/Annonces_fr/Public/comments/delete/<?= $comment['id_comments'] ?>" class="btn_annonces">Suprimer</a>
       </td>
      </tr>
      <?php endforeach ?>

   </tbody>

   </table>