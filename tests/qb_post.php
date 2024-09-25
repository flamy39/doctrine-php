<?php

// Utilisation du queryBuilder afin de construire des requêtes dynamiques

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Lister tous les posts dont le nombre de likes est superieur à un nombre donné ($nbLikes)
$nbLikes = 15;
// Création d'un objet de la classe QueryBuilder afin de construire la requête
$qb = $entityManager->createQueryBuilder();
$qb->select('p')
    ->from("App\Entity\Post","p")
    ->where("p.nbLikes > :nbLikes")
    ->setParameter("nbLikes",$nbLikes);
// Création d'un objet Query à partir du queryBuilder
$query = $qb->getQuery(); // $query est un objet qui contient maintenant la requête en DQL
// Exécution de la requête
$posts = $query->getResult();
// Affichage des resultats
foreach ($posts as $post) {
    echo $post->getTitre() . "\n";
}

// Exercice
// Rechercher et afficher les 3 posts les plus récents (du plus récent au plus ancien)