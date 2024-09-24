<?php

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use App\Entity\Post;

$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Créer un nouveau post
$post = new Post();
$post->setTitre("Un nouveau post");
$post->setContenu("Un nouveau contenu");
$post->setCreatedAt(new \DateTime());

// Demander à l'entiyManager de persister l'entité $post dans la table posts
$entityManager->persist($post); // n'exécute pas directement le insert
// Valider le insert
$entityManager->flush();