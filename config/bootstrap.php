<?php

// Configuration de l'EntityManager

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__.'/../vendor/autoload.php';
// Définir l'emplacement des entités
$path = [__DIR__.'/../src/Entity'];
$isDevMode = true;
// Définir la configuration des entités
$configuration = ORMSetup::createAttributeMetadataConfiguration($path,$isDevMode);
// Définir les éléments de connexion à la base de données
$configurationBD = [
  'driver' => 'pdo_mysql',
  'user' => 'root',
  'password' => '',
  'dbname' => 'db_posts',
  'host' => 'localhost'
];
// Créer de la connexion à la base de données
$connexionBD = DriverManager::getConnection($configurationBD,$configuration);

// Créer l'EntityManager
$entityManager = new \Doctrine\ORM\EntityManager($connexionBD,$configuration);
return $entityManager;

