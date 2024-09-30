<?php

//******************************************************************
// Rechercher le nombre de posts en 2024 groupés par mois
//******************************************************************

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use App\Entity\Post;

$entityManager = require_once __DIR__.'/../../config/bootstrap.php';

// VERSION DQL
$dql = "SELECT COUNT(p.id) as nbPosts, SUBSTRING(p.createdAt, 6, 2) as mois
        FROM App\Entity\Post p
        WHERE SUBSTRING(p.createdAt, 1, 4) = 2024
        GROUP BY mois";
// Exemple d'exécution de la requête avec un try..catch
try {
    $query = $entityManager->createQuery($dql);
    echo PHP_EOL;
    echo $query->getSQL();
    echo PHP_EOL;
    $postsParMois = $query->getResult();
    print_r($postsParMois);

} catch (\Doctrine\ORM\Query\QueryException $ex) {
    echo $ex->getMessage();
}

echo PHP_EOL;

// VERSION QUERYBUILDER
$qb = $entityManager->createQueryBuilder();
$postsParMois = $qb->select('COUNT(p.id) as nbPosts, SUBSTRING(p.createdAt, 6, 2) as mois')
    ->from('App\Entity\Post', 'p')
    ->where('SUBSTRING(p.createdAt, 1, 4) = :annee')
    ->setParameter('annee', 2024)
    ->groupBy('mois')
    ->orderBy('mois', 'ASC')
    ->getQuery()
    ->getResult();
print_r($postsParMois);