<?php
//*****************************************************************************************************************
// Ce fichier de tests permet d'utiliser Doctrine afin d'effectuer des requêtes de type INSERT vers la table posts
//*****************************************************************************************************************
use App\Entity\Post;

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Créer un nouveau post
$post = new Post();
$post->setTitre("Un nouveau post");
$post->setContenu("Un nouveau contenu");
$post->setCreatedAt(new \DateTime());

// Demander à l'EntityManager de persister l'entité $post dans la table posts
$entityManager->persist($post); // n'exécute pas directement le INSERT dans la base de données

// Valider le insert
$entityManager->flush(); // Le flush est responsable de l'exécution de la requête INSERT dans la base de données