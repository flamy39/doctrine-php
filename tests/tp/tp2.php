<?php

//******************************************************************
// Rechercher les posts parus depuis moins de 2 mois
//******************************************************************

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use App\Entity\Post;

$entityManager = require_once __DIR__.'/../../config/bootstrap.php';

// VERSION DQL
$dql = "SELECT p FROM App\Entity\Post p WHERE p.createdAt >= :date";
$query = $entityManager->createQuery($dql);
$query->setParameter('date', new \DateTime('-2 months'));
/**
 * @var Post[] $posts
 */
$posts = $query->getResult();
foreach($posts as $post) {
    echo $post->getTitre() . PHP_EOL;
}

echo PHP_EOL;

// VERSION QUERYBUILDER
$qb = $entityManager->createQueryBuilder();
/**
 * @var Post[] $posts
 */
$posts = $qb->select('p')
    ->from('App\Entity\Post', 'p')
    ->where('p.createdAt >= :date')
    ->setParameter('date', new \DateTime('-2 months'))
    ->getQuery()
    ->getResult();
foreach($posts as $post) {
    echo $post->getTitre() . PHP_EOL;
}


