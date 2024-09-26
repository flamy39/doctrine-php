<?php
//*****************************************************************************************************************
// Ce fichier de tests permet d'utiliser Doctrine afin d'effectuer des requêtes de type SELECT vers la table posts
//*****************************************************************************************************************

// Récupérer l'EntityManager afin de pouvoir communiquer avec la base de données
// POUR RAPPEL, C'EST L'ELEMENT CENTRAL DE DOCTRINE ;
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';  // C'est ici qu'est configuré l'EntityManager !

// On avait vu, dans les cours précédents, le principe des DAOs
// Rappel :  un DAO (associé à une entité) permet de réaliser des actions de type CRUD
// Avec Doctrine, les actions de type CRUD sont séparés dans 2 objets :
// - actions de type SELECT sont fournies par des méthodes d'un objet que l'on appelle un Repository
// - actions de type INSERT|UPDATE|DELETE sont fournies par des méthodes de l'EntityManager
// Doctrine génère 'pour nous', via l'Entity Manager, un Repository associé à une entité avec des méthodes "prêtes à l'emploi"

// Récupérer un PostRepository généré automatiquement par Doctrine (via l'Entity Manager)
// Ce répository sera associé à la classe Post
$postRepository = $entityManager->getRepository(\App\Entity\Post::class);

// Rechercher tous les posts
echo "Rechercher tous les posts \n";
$posts = $postRepository->findAll();
// La méthode findAll va effectuer la requête suivante : SELECT * FROM posts
// Puis récupérer les enregistrements de la table posts
// Pour terminer par effectuer le mapping des enregistrements (chaque enregistrement sera transformé en un objet de la classe Post)
foreach ($posts as $post) {
    echo $post->getTitre() . "\n";
}

// Rechercher un post par son id
echo "Rechercher le post id=??? \n";
$idPost = 1;
$post = $postRepository->find($idPost);
// La méthode find va effectuer la requête suivante : SELECT * FROM posts WHERE id_post=1
// Elle prend en paramètre la clé primaire
// Puis récupérer l'enregistrement de la table posts avec cet id (si il existe)
// Pour terminer par effectuer le mapping de l'enregistrement en un objet de la classe Post
if($post) {
    echo $post->getTitre() . "\n";
} else {
    echo "Post non trouvé \n";
}

// Rechercher un post par son titre
echo "Rechercher un post par son titre \n";
$post = $postRepository->findOneBy(['titre'=>"Post 1"]);
// SELECT * FROM posts WHERE titre_post="Post 1"
// Elle prend en paramètre un tableau associatif de critères : chaque critère fera l'objet d'une clause WHERE dans la requête SQL générée par Doctrine
// IMPORTANT : les critères sont liés aux attributs de la classe Post : c'est Doctrine qui fera la conversion avec les champs de la table posts associée
if($post) {
    echo $post->getTitre() . "\n";
} else {
    echo "Post non trouvé \n";
}

// Rechercher tous les posts dont le nombre de likes est supérieur à un nombre donné ($nbLikes)
$nbLikes = 15;
$postRepository->findBy(['nbLikes => 15']);
// Impossible d'utiliser l'opérateur > avec la méthode findBy !
// Elle se limite uniquement à l'opérateur d'égalité '=' !
// Nous verrons comment régler ce problème ultérieurement !