<?php
//*****************************************************************************************************************
// Ce fichier de tests permet d'utiliser Doctrine afin d'effectuer des requêtes de type DELETE vers la table posts
//*****************************************************************************************************************

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Pour supprimer un enregistrement de la table posts, il faut au préalable le rechercher dans la table posts
// Rechercher le post à supprimer : utilisation du Repository (voir explications 'list_posts.php'
$post = $entityManager
    ->getRepository(\App\Entity\Post::class)
    ->find(5);
if ($post) {
    // Demander à l'EntityManager de supprimer le post dans la table posts
    $entityManager->remove($post);  // n'exécute pas directement le DELETE dans la base de données
    $entityManager->flush();  // Le flush est responsable de l'exécution de la requête DELETE dans la base de données
} else {
    echo "Le post à supprimer n'existe pas !";
}