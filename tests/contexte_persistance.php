<?php

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Récupérer un post
$post = $entityManager
    ->getRepository(\App\Entity\Post::class)
    ->find(2);
$contextePersistance = $entityManager->getUnitOfWork();
echo $contextePersistance->getEntityState($post);  // 1
$entityManager->remove($post);
echo $contextePersistance->getEntityState($post);  // 4

// Créer un post
$nouveauPost = new \App\Entity\Post();
$nouveauPost->setTitre("Nouveau post");
$nouveauPost->setContenu("Nouveau contenu");
$nouveauPost->setCreatedAt(new \DateTime());
echo $contextePersistance->getEntityState($nouveauPost);  // 2
$entityManager->persist($nouveauPost);
echo $contextePersistance->getEntityState($nouveauPost);  // 1
//$entityManager->flush();