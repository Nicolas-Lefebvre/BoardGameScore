<?php


  // On inclus l'autoload de Composer qui require les libs automatiquement
  require_once __DIR__ . "/../vendor/autoload.php";
  require_once __DIR__ . "/../app/Controllers/Controller.php";
  require_once __DIR__ . "/../app/Controllers/SideController.php";
//   require_once __DIR__ . "/../app/Models/Game.php";
  require_once __DIR__ . "/../app/Utils/database.php";
// require_once __DIR__ . "/../app/views/home.tpl.php";


// require "../app/views/partials/header.tpl.php";

// require "../app/views/home.tpl.php";

// require "../app/views/partials/footer.tpl.php";


  //=========================
  // Routes
  //=========================

  // J'instancie la classe AltoRouter
  $router = new AltoRouter();

  // Je précise à AltoRouter dans quel sous-dossier 
  // se trouve mon projet par rapport a /var/www/html
  // techniquement, tout ce qui est après "localhost" dans l'URL
  $router->setBasePath( $_SERVER['BASE_URI'] );

  // Je défini ma première route d'AltoRouter avec ->map()
  $router->map(
    // Param 1 : Méthode HTTP
    "GET",       
    // Param 2 : URL ou Pattern d'URL correspondant a la route   
    "/",   
    // Param 3 : Ce qu'on veut, ici un tableau avec les noms du controleur et la méthode a appeller
    [
      "controller" => "Controller",
      "method"     => "home"
    ],
    // Param 4 : Nom de la route, par convention "nomducontroller-nomdelamethode"
    "main-home"
  );

  $router->map(
    "GET",         
    "/ajout-partie",   
    [
      "controller" => "SideController",
      "method"     => "newPartie"
    ],
    "ajout-partie"
  );

  $router->map(
    "GET",         
    "/parties",   
    [
      "controller" => "SideController",
      "method"     => "allParties"
    ],
    "all-parties"
  );

  $router->map(
    "GET",         
    "/ajout-jeu",   
    [
      "controller" => "SideController",
      "method"     => "game"
    ],
    "ajout-jeu"
  );

  $router->map(
    "GET",         
    "/jeux",   
    [
      "controller" => "SideController",
      "method"     => "allGames"
    ],
    "all-games"
  );

    // Une fois toute mes routes définies, je demande a AltoRouter
  // de trouver laquelle correspond a l'URL demandée
  // Cette méthode nous renvoi un tableau associatif contenant les clés suivants :
  //  "target" => Ce qu'on veut : 3e param de ->map
  //  "params" => Parties variables de l'URL, tableau vide si aucune
  //  "name"   => Le nom de la route qui match (4e param de ->map)
  // Elle renvoi false si aucune route qui match l'URL n'est trouvée
  // http://altorouter.com/usage/matching-requests.html
  $match = $router->match();

//   d( $match );
//   d(get_defined_vars());

  if( $match !== false )
  {
    // Si c'est le cas, je récupère les infos de cette route
    // Grace a AltoRouter, c'est directement dispo dans $match['target']
    $routeData = $match['target'];

    // A partir de là, ça marche comme avant !

    // J'en déduis, l'action a executer : le controller et la méthode
    $controllerName = $routeData['controller'];
    $methodToCall   = $routeData['method'];

    // J'ai donc désormais deux variables, sous forme de string
    // qui vont contenir respectivement le nom du controller à instancier
    // et le nom de la méthode à appeller
    // d( $controllerName ); // par exemple : "MainController"
    // d( $methodToCall   ); // par exemple : "home"

    // On doit maintenant executer l'action
    // Heureusement en PHP, on peut instancier une classe dont le nom se trouve dans une variable
    // Pareil pour l'appel d'une méthode.
    $controller = new $controllerName();            // Par exemple : $controller = new MainController();
    $controller->$methodToCall( $match['params'] ); // Par exemple : $controller->home()




  }
  else
  {
    // Si aucune route ne correspond dans le tableau
    // On affiche une erreur 404
    http_response_code( 404 );
    exit( "404 Not Found" );
  }

