<section>

    <table class="table table-striped col-md-12 col-lg-6">
        <thead>
            <tr>
                    <th scope="col" class="text-center">N° Partie</th>
                    <th scope="col" class="text-center">Date Partie</th>
                    <th scope="col" class="text-center">Jeu</th>
                    <th scope="col" class="text-center">Nombre de Joueurs</th>
                    <th scope="col" class="text-center">Vainqueur</th>
                    <th scope="col" class="text-center">Score</th>
            </tr>
        </thead>

        <tbody>
        <?php  foreach($partiesList as $currentPartie):   ?>
            <tr>
                <th scope="row" class="text-center"><?= $currentPartie->getId(); ?></th>
                <th scope="row" class="text-center"><?= $currentPartie->getDate(); ?></th>
                <td class="text-center"><?=$orderedGamesList[$currentPartie->getGameId()]->getName() ?></td>
                <td class="text-center"><?= $currentPartie->getPlayersNumber(); ?></td>
                <td class="text-center"><?= $orderedPlayersList[$currentPartie->getWinner()]->getName(); ?></td>
                <td class="text-center"><?= $currentPartie->getWinningScore(); ?></td>


            </tr>

            <?php endforeach ;?>
        </tbody>




        </table>












</section>