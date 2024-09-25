<?php

// Récupérer l'EntityManager
/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = require_once __DIR__.'/../config/bootstrap.php';

// Récupérer un PostRepository généré automatiquement par Doctrine
// Ce répository sera associé à la classe Post
$postRepository = $entityManager->getRepository(\App\Entity\Post::class);

// Liste des posts
echo "Liste des posts \n";
$posts = $postRepository->findAll();    // SELECT * FROM posts
foreach ($posts as $post) {
    echo $post->getTitre() . "\n";
}

// Lister un post recherché via son id
echo "Liste le post id=1 \n";
$post = $postRepository->find(1); // SELECT * FROM posts WHERE id_post=1
if($post) {
    echo $post->getTitre() . "\n";
} else {
    echo "Post non trouvé \n";
}

// Lister un post via son titre
echo "Liste un post via son titre \n";
$post = $postRepository->findOneBy(['titre'=>"Post 1"]);    // SELECT * FROM posts WHERE titre_post="Post 1"
if($post) {
    echo $post->getTitre() . "\n";
} else {
    echo "Post non trouvé \n";
}

// Lister tous les posts dont le nombre de likes est superieur à un nombre donné ($nbLikes)
$nbLikes = 15;
$postRepository->findBy(['nbLikes => 15']);
// Impossible d'utiliser l'opérateur > avec la méthode findBy !
// Elle se limite uniquement à l'opérateur d'égalité '='