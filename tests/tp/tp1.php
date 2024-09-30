<?php

//******************************************************************
// Rechercher le nombre de likes pour un post donné (son id_post)
//******************************************************************

// Récupérer l'EntityManager
/**
* @var Doctrine\ORM\EntityManager $entityManager
*/
$entityManager = require_once __DIR__.'/../../config/bootstrap.php';

// VERSION DQL
$idPost = 1;
$dql = "SELECT p.nbLikes FROM App\Entity\Post p WHERE p.id = :id";
$query = $entityManager->createQuery($dql);
$query->setParameter('id', $idPost);
$nbLikes = $query->getSingleScalarResult();
echo $nbLikes;
echo PHP_EOL;

// VERSION QUERYBUILDER
$qb = $entityManager->createQueryBuilder();
$nbLikes = $qb->select('p.nbLikes')
    ->from('App\Entity\Post', 'p')
    ->where('p.id = :id')
    ->setParameter('id', $idPost)
    ->getQuery()
    ->getSingleScalarResult();
echo $nbLikes;
