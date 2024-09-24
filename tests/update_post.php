<?php

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';
// Récupérer l'entité à supprimer
$post = $entityManager
    ->getRepository(\App\Entity\Post::class)
    ->find(4);
if ($post) {
   $post->setContenu("Le contenu a été modifié !");
   $entityManager->flush();
} else {
    echo "Le post à modifier n'existe pas !";
}
