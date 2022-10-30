<section class="homemenus homeadmin">
 <!-- homemenus -->
    <div class="text_menu">
        <h2> ADMINISTARATION ET GESTION </h2>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, id.
        </p>
    </div>

</section>


<div class="modal-container">
    <div class="overly "></div>
    <div class="modal modal-modifier">
        <button class="close-modal modal-triggerModifier"> X</button>
        <h2> </h2>


        <a class="btn_modifier"> oui </a>

    </div>

    <div class="modal modal-annuler">
        <button class="close-modal modal-triggerAnnuler"> X</button>
        <h2></h2>


        <a class="btn_annuler"> oui </a>

    </div>
    <div class="modal modal-suprimer">
        <button class="close-modal modal-triggersuprimer"> X</button>
        <h2></h2>


        <a class="btn_suprimer"> oui </a>

    </div>
</div>

<section class="dashboard">
    <div class="sidebar">



        <ul class="ulnavdash">
            <li class="lidash " data-li="0">
                
                Gestion des Menus
            </li>
            <li class="lidash" data-li="1">
                
                Gestion des utilisateurs
            </li>
            <li class="lidash active" data-li="2">

                Gestion des reservations
            </li>
            <li class="lidash" data-li="3">

                Gestion des commentaires
            </li>
        </ul>


    </div>

    <div class="globaldash">
        <div class="dashinfo itemdash0 ">

            <h1>GESTION DES MENUS</h1>

            <?php $count = 0;
            $decount = 0;
            foreach ($annonces as  $annonce) {
                if ($annonce['actif'] == 1) {
                    $count++;
                } else {
                    $decount++;
                }
            } ?>

            <div class="info">

                <div class="inforeserv">
                    <h3>Annonces inactif
                    </h3>
                    <p class="count">
                        <?= $decount  ?>
                    </p>

                </div>
                <div class="inforeserv">
                    <h3>Annonces actif
                    </h3>

                    <p class="count">
                        <?= $count ?>
                    </p>
                </div>
            </div>
            <div class="btn">
                <a href="/annonces/ajouter">
                    Ajouter une categorie
                </a>
            </div>

            <div class="tablerespo">
                <?php foreach ($annonces as  $annonce) : ?>
                    <div class="rowdata">
                        <p>Ref_menu</p> <span> <?= $annonce['id_annonces'] ?></span>
                        <p>Titre </p> <span><?= $annonce['titre'] ?></span>
                        <p>Actif</p>
                        <div class="modern">
                            <input type="checkbox" class="checkboxAnnonces" <?= $annonce['actif'] ? 'checked' : "" ?> data-id="<?= $annonce['id_annonces'] ?>">
                            <label class="label1" for=""></label>
                            <label class="label2" for=""></label>

                        </div>
                        <p>date_edition</p> <span><?= $annonce['date_creation'] ?></span>
                        <p>Ref_admin </p> <span><?= $annonce['users_id'] ?></span>
                        <p>Action </p>

                        <div class="actionrespo">
                            <a class="icon iconeedit modal-triggerModifier" data-url="/annonces/modifier/<?= $annonce['id_annonces'] ?>">
                                
                            </a>
                            <a class="icon iconedelate modal-triggersuprimer" data-url="/annonces/delete/<?= $annonce['id_annonces'] ?>">
                                
                            </a>

                        </div>


                    </div>

                <?php endforeach ?>

            </div>


            <table>
                <thead>

                    <th>Ref_menu</th>
                    <th>Titre</th>

                    <th>Actif</th>
                    <th>date_edition</th>
                    <th>Ref_admin</th>

                    <th>Action</th>
                </thead>

                <tbody>

                    <?php foreach ($annonces as  $annonce) : ?>

                        <tr>
                            <td>
                                <?= $annonce['id_annonces'] ?></td>
                            <td><?= $annonce['titre'] ?></td>
                            <td>
                                <div class="modern">
                                    <input type="checkbox" class="checkboxAnnonces" <?= $annonce['actif'] ? 'checked' : "" ?> data-id="<?= $annonce['id_annonces'] ?>">
                                    <label class="label1" for=""></label>
                                    <label class="label2" for=""></label>

                                </div>

                            </td>
                            <td><?= $annonce['date_creation'] ?></td>
                            <td><?= $annonce['users_id'] ?></td>

                            <td>


                                <a class="icon iconeedit modal-triggerModifier" data-url="/annonces/modifier/<?= $annonce['id_annonces'] ?>"> </a>

                                </a>
                                <a class="icon iconedelate modal-triggersuprimer" data-url="/annonces/delete/<?= $annonce['id_annonces'] ?>"></a>

                        
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>

            </table>


        </div>
        <div class="dashinfo itemdash1 ">
            <h1>
                GESTION DES UTILISATEURS</h1>

            <?php $count = 0;
            $decount = 0;
            foreach ($users as  $user) {

                $count++;
            } ?>

            <div class="info">

                <div class="inforeserv">
                    <h3>Nombres d'utilisateurs
                    </h3>

                    <p class="count">
                        <?= $count ?>
                    </p>
                </div>
            </div>

            <div class="btn">
                <a href="/users/register">
                    Ajouter
                </a>
            </div>

            <div class="tablerespo">
                <?php foreach ($users as  $user) : ?>
                    <div class="rowdata">
                        <p>Ref_client</p> <span> <?= $user['id_users'] ?></span>
                        <p>Prenom</p> <span><?= $user['firstname'] ?></span>
                        <p>Nom</p> <span><?= $user['lastname'] ?></span>

                        <p>Email</p> <span><?= $user['email'] ?></span>
                        <p>ROles </p> <span><?= $user['roles'] ?></span>
                        <p>Action </p>

                        <div class="actionrespo">
                            <a class="icon iconeedit modal-triggerModifier" data-url="/users/modifier/<?= $user['id_users'] ?>"></a>
                            <a class="icon iconedelate modal-triggersuprimer" data-url="/users/delete/<?= $user['id_users'] ?>"><i class="fas fa-trash"></i></a>

                        </div>


                    </div>

                <?php endforeach ?>

            </div>

            <table>
                <thead>

                    <th>Ref_client</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Email</th>

                    <th>Roles</th>
                    <th>Action</th>

                </thead>

                <tbody>
                    <?php foreach ($users as  $user) : ?>
                        <tr>
                            <td>
                                <?= $user['id_users'] ?></td>
                            <td><?= $user['firstname'] ?></td>
                            <td><?= $user['lastname'] ?></td>
                            <!-- <td><?= $user['pass'] ?></td> -->
                            <td><?= $user['email'] ?></td>

                            <td><?= $user['roles'] ?></td>

                            <td>
                                <a class="icon iconeedit modal-triggerModifier" data-url="/users/modifier/<?= $user['id_users'] ?>"></a>
                                <a class="icon iconedelate modal-triggersuprimer" data-url="/users/delete/<?= $user['id_users'] ?>"></a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>

            </table>

        </div>
        <div class="dashinfo itemdash2 active">
            <h1>GESTION DES RESERVATIONS</h1>

            <?php $count = 0;
            $decount = 0;
            foreach ($reservations as  $reserv) {
                if ($reserv['etat'] == 1) {
                    $count++;
                } else {
                    $decount++;
                }
            } ?>

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
                        <?= $count ?>
                    </p>
                </div>
            </div>

            <div class="btn">
                <a href="/reservations/reserver">
                    Ajouter
                </a>
            </div>


            <div class="tablerespo">
                <?php foreach ($reservations as  $reserv) : ?>
                    <div class="rowdata">
                        <p>Ref_Reservation </p> <span><?= $reserv['id_reservations'] ?></span>
                        <p>Ref_Client</p> <span><?= $reserv['id_users'] ?></span>
                        <p>Nom </p> <span><?= $reserv['lastname'] ?></span>
                        <p>Prenom </p> <span><?= $reserv['firstname'] ?></span>
                        <p>demande </p> <span><?= $reserv['demande'] ?></span>
                        <p>Date_edition </p> <span><?= $reserv['date_creation'] ?></span>
                        <p>Date_Reservation</p> <span><?= $reserv['date_reservation'] ?></span>
                        <p>Heure </p> <span><?= $reserv['heure'] ?></span>
                        <p>Nombre </p> <span><?= $reserv['nombres'] ?></span>
                        <p>Editeur </p> <span><?= $reserv['roles'] ?></span>
                        <p>Etat </p> <span <?php if ($reserv['etat']) : ?>style="color: green;" <?php else : ?> style="color: red;" <?php endif ?>><?= $reserv['etat'] ? 'Validée' : "Annulée" ?></span>
                        <p>Action </p>
                        <div class="actionrespo">
                            <a class="icon iconeedit modal-triggerModifier" data-url="/reservations/modifier/<?= $reserv['id_reservations'] ?>"></a>
                            <a class="icon iconedelate modal-triggersuprimer" data-url="/reservations/delete/<?= $reserv['id_reservations'] ?>"></a>
                            <?php if ($reserv['etat']) : ?>

                                <a class=" icon iconecancel modal-triggerAnnuler" data-url="/reservations/annuler/<?= $reserv['id_reservations'] ?>"></a>
                            <?php endif ?>

                        </div>


                    </div>

                <?php endforeach ?>

            </div>

            <table>
                <thead>

                    <th>Ref_Reservation</th>
                    <th>Ref_Client</th>
                    <th>Nom</th>

                    <th>Prenom</th>
                    <th colspan="2">Demande</th>

                    <th>Date_edition</th>

                    <th>Date_Reservation</th>
                    <th>Heure</th>
                    <th>Nombre</th>
                    <th>Editeur</th>
                    <th>Etat</th>
                    <th>Action</th>

                </thead>

                <tbody>

                    <?php
                    foreach ($reservations as  $reserv) : ?>

                        <tr>
                            <td>
                                <?= $reserv['id_reservations'] ?></td>
                            <td><?= $reserv['id_users'] ?></td>
                            <td><?= $reserv['lastname'] ?></td>
                            <td><?= $reserv['firstname'] ?></td>

                            <td colspan="2" class="tddemande"><?= $reserv['demande'] ?></td>
                            <td><?= $reserv['date_creation'] ?></td>
                            <td><?= $reserv['date_reservation'] ?></td>
                            <td><?= $reserv['heure'] ?></td>
                            <td><?= $reserv['nombres'] ?></td>
                            <td><?= $reserv['roles'] ?></td>
                            <td <?php if ($reserv['etat']) : ?>style="color: green;" <?php else : ?> style="color: red;" <?php endif ?>>

                                <?= $reserv['etat'] ? 'Validée' : "Annulée" ?>
                            </td>
                            <td>
                                <a class="icon iconeedit modal-triggerModifier" data-url="/reservations/modifier/<?= $reserv['id_reservations'] ?>"></a>

                                <a class="icon iconedelate modal-triggersuprimer" data-url="/reservations/delete/<?= $reserv['id_reservations'] ?>"></a>
                                <?php if ($reserv['etat']) : ?>

                                    <a class="icon iconecancel modal-triggerAnnuler" data-url="/reservations/annuler/<?= $reserv['id_reservations'] ?>"></a>
                                <?php endif ?>

                            </td>
                        </tr>

                    <?php endforeach ?>

                </tbody>

            </table>


        </div>
        <div class="dashinfo itemdash3">
            <h1> GESTION DES COMMENTAIRES</h1>

            <?php $count = 0;
            $decount = 0;
            foreach ($Allcomments as  $comment) {
                if ($comment['actif'] == 1) {
                    $count++;
                } else {
                    $decount++;
                }
            } ?>

            <div class="info">

                <div class="inforeserv">
                    <h3>Commentaires inactif
                    </h3>
                    <p class="count">
                        <?= $decount  ?>
                    </p>

                </div>
                <div class="inforeserv">
                    <h3>Commentaires actif
                    </h3>

                    <p class="count">
                        <?= $count ?>
                    </p>
                </div>
            </div>

            <div class="tablerespo">
                <?php foreach ($Allcomments as  $comment) : ?>
                    <div class="rowdata">
                        <p>Ref_COMMENT</p> <span> <?= $comment['id_comments'] ?></span>
                        <p>Titre</p> <span><?= $comment['titrecomment'] ?></span>
                        <p>Contenu</p> <span><?= $comment['comment'] ?></span>

                        <p>Date_edition</p> <span><?= $comment['date_creation'] ?></span>
                        <p>Actif </p>
                        <div class="modern">
                            <input type="checkbox" class="checkboxComments" <?= $comment['actif'] ? 'checked' : "" ?> data-id="<?= $comment['id_comments'] ?>">
                            <label for="" class="label1"></label>
                            <label for="" class="label2"></label>
                        </div>
                        <p>Ref_client </p> <span><?= $comment['users_id'] ?></span>
                        <p>Ref_menu </p> <span><?= $comment['annonces_id'] ?></span>
                        <p>Action </p>

                        <div class="actionrespo">
                            <a class="icon iconedelate modal-triggersuprimer" data-url="/comments/delete/<?= $comment['id_comments'] ?>"> </a>

                        </div>


                    </div>

                <?php endforeach ?>

            </div>

            <table>
                <thead>

                    <th>Ref_COMMENT</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th colspan="2">Date_edition</th>
                    <th>Actif</th>
                    <th>Ref_client </th>
                    <th>Ref_menu</th>
                    <th>ACTION</th>
                </thead>
                <tbody>

                    <?php foreach ($Allcomments as  $comment) : ?>

                        <tr>
                            <td> <?= $comment['id_comments'] ?></td>
                            <td><?= $comment['titrecomment'] ?></td>
                            <td colspan="2"><?= $comment['comment'] ?></td>
                            <td><?= $comment['date_creation'] ?></td>
                            <td>
                                <div class="modern">
                                    <input type="checkbox" class="checkboxComments" <?= $comment['actif'] ? 'checked' : "" ?> data-id="<?= $comment['id_comments'] ?>">
                                    <label for="" class="label1"></label>
                                    <label for="" class="label2"></label>
                                </div>
                            </td>
                            <td><?= $comment['users_id'] ?></td>
                            <td><?= $comment['annonces_id'] ?></td>
                            <td>

                                <a class="icon iconedelate modal-triggersuprimer " data-url="/comments/delete/<?= $comment['id_comments'] ?>"> </a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>

            </table>

        </div>
    </div>

</section>