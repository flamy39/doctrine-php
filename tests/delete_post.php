<?php

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Récupérer l'entité à supprimer
$post = $entityManager
    ->getRepository(\App\Entity\Post::class)
    ->find(5);
if ($post) {
    // suppression
    $entityManager->remove($post);
    $entityManager->flush();
} else {
    echo "Le post à supprimer n'existe pas !";
}