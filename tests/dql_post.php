<?php

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Lister tous les posts dont le nombre de likes est superieur à un nombre donné ($nbLikes)
$nbLikes = 15;
$dql = "SELECT p FROM App\Entity\Post p WHERE p.nbLikes > :nbLikes";
// Création d'un objet "requête" de la classe Query
$query = $entityManager->createQuery($dql);
// Donner une valeur au paramètre ":nbLikes'
$query->setParameter('nbLikes',$nbLikes);
// Exécution de la requête avec le mapping des enregistrements en objets Post
$posts = $query->getResult();
// Afficher les resultats
foreach ($posts as $post) {
    echo $post->getTitre() . "\n";
}

// Lister tous les posts parus à partir d'une date donnée
echo "Lister tous les posts parus à partir d'une date donnée \n";
$date = \DateTime::createFromFormat("d/m/Y","12/08/2024");
$dql = "SELECT p FROM App\Entity\Post p WHERE p.createdAt >= :date ORDER BY p.createdAt DESC";
$query = $entityManager->createQuery($dql);
$query->setParameter(':date',$date);
$sql = $query->getSQL();  // La requête SQL (juste pour voir) !
echo "\n" . $sql . "\n";
$posts = $query->getResult();
foreach ($posts as $post) {
    echo $post->getTitre() . "\n";
}

// Exercice
// Rechercher et afficher les 3 posts les plus récents (du plus récent au plus ancien)
$dql = "SELECT p FROM App\Entity\Post p ORDER BY p.createdAt DESC";
$query = $entityManager->createQuery($dql);
$query->setMaxResults(3);
$posts = $query->getResult();