<section>

    <table class="table table-striped col-md-12 col-lg-8">
        <thead>
            <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Nom</th>
                    <th scope="col" class="text-center">Editeur</th>
                    <th scope="col" class="text-center">Champion <img class="champion-icon" src="<?= $_SERVER['BASE_URI'] . "/assets/images/coupe.png" ?>" alt="Grapefruit slice atop a pile of other slices"></th>
                    <th scope="col" class="text-center">meilleur score</th>
                    <th scope="col" class="text-center">Nombre de parties</th>

            </tr>
        </thead>

        <tbody>
        <?php
            $classementJeu = 0 ;
            foreach($gamesList as $currentGame):  
                $classementJeu++;   ?>
                <tr>

                    <th scope="row" class="text-center"><?= $classementJeu ?></th>
                    <th scope="row" class="text-left"><?= $currentGame->getName(); ?></th>
                    <th scope="row" class="text-left"><?= $currentGame->getEditor(); ?></th>
                    
                    <td class="text-center"><?= findChampionByGame($partiesList, $currentGame->getId()) ?></td>

                    <td class="text-center"><?= findRecordByGame($partiesList, $currentGame->getId()) ?></td>
                    <td class="text-center"><?= $currentGame->getPlayedParties(); ?></td>

                </tr>
            <?php endforeach ;?>
        </tbody>




        </table>












</section>