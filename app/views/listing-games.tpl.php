<section>

    <table class="table table-striped col-md-12 col-lg-8">
        <thead>
            <tr>
                    <th scope="col" class="text-center">classement</th>
                    <th scope="col" class="text-center">Nom</th>
                    <th scope="col" class="text-center">Editeur</th>
                    <th scope="col" class="text-center">Champion</th>
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
                    <th scope="row" class="text-center"><?= $currentGame->getName(); ?></th>
                    <th scope="row" class="text-center"><?= $currentGame->getEditor(); ?></th>
                    
                    <td class="text-center">XXX</td>

                    <td class="text-center">XXX</td>
                    <td class="text-center"><?= $currentGame->getPlayedParties(); ?></td>

                </tr>
            <?php endforeach ;?>
        </tbody>




        </table>












</section>