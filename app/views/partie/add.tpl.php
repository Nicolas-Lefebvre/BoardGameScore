<section>
<h1>Nouvelle partie :</h1>


<div class="col-12">
    <form action="<?= $_SERVER['BASE_URI'] . "/ajout-partie" ?>" method="POST">

      <div class="form-group">
        <label for="gameName">Nom du jeu :</label>
        <select class="form-control" id="gameName">
            <?php foreach($gamesList as $game): ?>
                <option><?= $game->getName(); ?> </option>
            <?php endforeach;  ?>

        </select>
        Votre jeu n'est pas présent dans la liste, <a href="<?= $_SERVER['BASE_URI'] . "/ajout-jeu" ?>">ajouter le à votre bibliothèque</a>
      </div>





      <div class="form-group">
        <label for="playersNumber">Nombre de joueurs :</label>
        <input type="number" id="playerNumber" name="playerNumber" min="1" max="6">
        <button id="validateNumberOfPlayer" style="font-size:.5rem">Confirmer</button>
      </div>


      <!-- ------------------------------------------DYNAMISATION DU NOMBRE DE JOUEURS avec JS------------------------------------------------------------------ -->
      <div class="form-group" id="NbJoueurs">
        <script>
            const nbPlayerBtn = document.getElementById('validateNumberOfPlayer');
            const nbPlayerInput = document.getElementById('playerNumber');
            const parentDiv     = document.getElementById('NbJoueurs');
            
            

            nbPlayerBtn.addEventListener('click', function handleEvent() 
            {
              event.preventDefault();
            
              // On efface les éléments éventuellement déjà présents sur la page
              document.getElementById('NbJoueurs').innerHTML = "";
              
              // En fonction du nombre de joueurs sélectionnés, on ajoute les inputs pour les noms et les scores. 
                let nbPlayer        = nbPlayerInput.value;
                console.log('Clic');
                console.log(nbPlayer);

                let div = document.createElement('div');
                div.classList = "form-group col-12"

                for (let index = 1; index <= nbPlayer; index++) 
                {
                  // création des éléments
                  let divJoueur = document.createElement('div');
                  divJoueur.classList = "form-group col-3 nbJoueursDiv";
                  let divScore = document.createElement('div');
                  divScore.classList = "form-group col-3 scoreDiv";

                  let labelJoueur = document.createElement('label');
                  let labelJoueurText = document.createTextNode('Joueur '+index+' : ');
                  let labelScore = document.createElement('label');
                  let labelScoreText = document.createTextNode('Score J'+index+' : ');

                  let inputJoueurElement = document.createElement('input');
                    inputJoueurElement.type = "text";
                    inputJoueurElement.name = "joueur"+index;
                    inputJoueurElement.id   = "joueur"+index;
                    inputJoueurElement.className = "nomJoueur";
                  let inputScoreElement = document.createElement('input');
                    inputScoreElement.type = "number";
                    inputScoreElement.name = "scoreJoueur"+index;
                    inputScoreElement.id   = "scoreJoueur"+index;
                    inputScoreElement.className = "scorejoueur";
                  

                  //Insertion des éléments
                  parentDiv.append(divJoueur);
                  divJoueur.append(labelJoueur)
                  labelJoueur.append(labelJoueurText);
                  divJoueur.append(inputJoueurElement);

                  parentDiv.append(divScore);
                  divScore.append(labelScore)
                  labelScore.append(labelScoreText);
                  divScore.append(inputScoreElement);
                  
                  

                }
                
                    
            });
        </script>
      </div>

      <div class="form-group">
        <label for="playersNumber">Date :</label>
        <input type="date" id="partieDate" name="partieDate">
      </div>


      <!-- <div class="form-group">
        <label for="exampleFormControlSelect2">Example multiple select</label>
        <select multiple class="form-control" id="exampleFormControlSelect2">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div> -->

      <button type="submit">
        Valider
      </button>
    </form>
</div>




</section>