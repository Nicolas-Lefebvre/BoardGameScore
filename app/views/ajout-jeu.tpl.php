<section>

  <?php 
  d($_GET);
  d($_POST);
  if (empty($_GET['gameName'])):
    
  ?>



<h1>Ajout d'un jeu à votre bibliothèque :</h1>


<div class="col-12">
    <form action="" method="get">

      <div class="form-group">
        <label for="gameName">Nom du jeu :</label>
        <input type="text" id="gameName" name="gameName">
      </div>

      <div class="form-group">
        <label for="playersNumber">Editeur :</label>
        <input type="text" id="gameEditor" name="gameEditor">
      </div>



      <div class="form-group">
        <label for="playersNumber">Nombre de joueurs min:</label>
        <input type="number" id="minPlayerNumber" name="minPlayerNumber" min="1">
      </div>

      <div class="form-group">
        <label for="playersNumber">Nombre de joueurs max:</label>
        <input type="number" id="maxPlayerNumber" name="maxPlayerNumber" min="1" max="6">
      </div>


      <div class="form-group">
        <label for="scoreType">Type de victoire :</label>
        <select class="form-control" id="gameName" name="scoreType">
                <option>Le score le plus élevé gagne</option>
                <option>Le score le plus bas gagne</option>
                <option>Pas de score</option>
        </select>
      </div>

      <fieldset>
        <legend>Propriétés du jeu:</legend>
        <div>
          <input type="checkbox" id="cooperativeGame" name="isCoopGame" value="isCoopGame">
          <label for="isCoopGame">jeu Coopératif (soit les joueurs gagnent, soit le jeu gagne)</label>
        </div>

        <div>
          <input type="checkbox" id="teamGame" name="isTeamGame" value="isTeamGame">
          <label for="isTeamGame">Jeu en équipe autorisé</label>
        </div>
      </fieldset>


      <button type="submit">
        Valider
      </button>
    </form>
</div>

<?php elseif(!empty($_GET['gameName'])): ?>
  <h2>Jeu ajouté avec succés !</h2>

<?php endif;?>
</section>