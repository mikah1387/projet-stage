
<h1> GESTION DES UTILISATEURS</h1>


  <table>
    <thead>

    <th>ID</th>
    <th>PRENOM</th>
    <th>NOM</th>
    <th>Email</th>
    

    <th>ROLES</th>
    <th>ACTION</th>
    
    </thead>

    <tbody>
    <?php foreach ($users as  $user):?>
       <tr>
        <td> <?= $user['id_users']?></td>
        <td><?= $user['firstname']?></td>
        <td><?= $user['lastname']?></td>
        <!-- <td><?= $user['pass']?></td> -->
        <td><?= $user['email']?></td>
      
        <td><?= $user['roles']?></td>
       

        <td> 
        <a  href="/Annonces_fr/Public/users/modifier/<?=$user['id_users'] ?>" class="btn btn-admin">Modifier</a>
         <a href="/Annonces_fr/Public/users/delete/<?=$user['id_users'] ?>" class="btn btn-admin">Suprimer</a>
        </td>
       </tr>
       <?php endforeach ?>


    </tbody>

    </table>
    <p><a href="/Annonces_fr/Public/users/register" class="btn btn-admin"> Ajouter </a></p>

    





