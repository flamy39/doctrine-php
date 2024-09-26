<?php

//*****************************************************************************************************************
// Ce fichier de tests permet d'utiliser Doctrine afin d'effectuer des requêtes de type UPDATE vers la table posts
//*****************************************************************************************************************

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Pour modifier un enregistrement de la table posts, il faut au préalable le rechercher dans la table posts
$post = $entityManager
    ->getRepository(\App\Entity\Post::class)
    ->find(4);
if ($post) {
    // Modification par exemple du contenu du post
   $post->setContenu("Le contenu a été modifié !");
   // On peut faire le flush() directement.
   // Doctrine va automatiquement détecté que l'objet a été modifié !
   $entityManager->flush(); // Le flush est responsable de l'exécution de la requête UPDATE dans la base de données
} else {
    echo "Le post à modifier n'existe pas !";
}
