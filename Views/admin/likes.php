<h1> GESTIONS DES LIKES</h1>

<table>
    <thead>

    <th>ID_LIKES</th>
    <th>LIKE</th>
    <th>DISLIKE</th>
    <th>REF_COMMENT</th>
    <th>REF_CLIENT </th>
    <th>ACTIF</th>
    </thead>
    <tbody>
   
   <?php foreach ($Alllikes as  $like):?>
     
      <tr>
       <td> <?= $like['id_likes']?></td>
       <td><?= $like['lik']?></td>
       <td><?= $like['dislike']?></td>
       <td><?= $like['comments_id']?></td>
       <td><?= $like['users_id']?></td>
       <td>
       
       <a href="/Annonces_fr/Public/likes/delete/<?= $like['id_likes'] ?>" class="btn_annonces">Suprimer</a>
        </td>
       
      </tr>
      <?php endforeach ?>

   </tbody>

   </table>