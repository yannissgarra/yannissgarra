<?php

namespace App\Fixture\Career;

use App\Career\Domain\Model\Mission;
use App\Career\Domain\Model\MissionTranslation;
use App\Fixture\Language\LanguageFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class MissionFixture extends Fixture implements DependentFixtureInterface
{
    public const DATA = [
        'mission-dev-mezcalito-1-sport2000' => [
            'id' => 'e74cdbab-8992-41ab-8487-341669345b13',
            'reference' => 'Sport2000',
            'customer' => 'Sport2000',
            'activity_reference' => 'activity-dev-mezcalito-1',
            'translations' => [
                'language-english' => [
                    'role' => 'Developer',
                    'environment' => 'PHP, Symfony, MySQL, Redis, Varnish, Git, BackboneJs, RequireJs, Sass, Compass',
                    'description' => 'Take part in the design and development of the new Sport2000 ski rental engine infrastructure.',
                    'link' => 'https://ski-hire-sport2000.co.uk',
                ],
                'language-french' => [
                    'role' => 'Développeur',
                    'environment' => 'PHP, Symfony, MySQL, Redis, Varnish, Git, BackboneJs, RequireJs, Sass, Compass',
                    'description' => 'Participation à l’élaboration et développement de la nouvelle infrastructure du moteur de location de ski de Sport2000.',
                    'link' => 'https://location-ski.sport2000.fr',
                ],
            ],
        ],
        'mission-dev-mezcalito-1-other' => [
            'id' => '726746d9-75b1-4408-a6ee-ec55568f2d2f',
            'reference' => 'Divers',
            'activity_reference' => 'activity-dev-mezcalito-1',
            'translations' => [
                'language-english' => [
                    'role' => 'Developer',
                    'environment' => 'PHP, Symfony, MySQL, Codeigniter, Expression Engine, Wordpress, Prestashop, Bootstrap, JQuery, CSS/Less/Sass, Git',
                    'description' => 'Take part in various sites on Wordpress and/or Prestashop, specific developments around PHP on the CodeIgniter and Symfony frameworks.',
                ],
                'language-french' => [
                    'role' => 'Développeur',
                    'environment' => 'PHP, Symfony, MySQL, Codeigniter, Expression Engine, Wordpress, Prestashop, Bootstrap, JQuery, CSS/Less/Sass, Git',
                    'description' => 'Réalisation de divers sites sur Wordpress et/ou Prestashop, développements spécifiques autour de PHP sur les frameworks CodeIgniter et Symfony.',
                ],
            ],
        ],
        'mission-cuisinetudiant' => [
            'id' => '4304c240-db1f-47d9-ab33-330d6dc18227',
            'reference' => 'Cuisine Etudiant',
            'activity_reference' => 'activity-found-cuisinetudiant',
            'translations' => [
                'language-english' => [
                    'role' => 'Co-Founder & Developer',
                    'environment' => 'PHP, Symfony, MySQL, ElasticSearch, Git, Javascript, jQuery, HTML, CSS/Less',
                    'description' => 'Creation and management of a community of several hundred thousand users around a subject: easy, fast and economical cooking.',
                ],
                'language-french' => [
                    'role' => 'Cofondateur & Développeur',
                    'environment' => 'PHP, Symfony, MySQL, ElasticSearch, Git, Javascript, jQuery, HTML, CSS/Less',
                    'description' => 'Création et gestion d’une communauté de plusieurs centaines de milliers d’utilisateurs autour d’un sujet : la cuisine facile, rapide et économique.',
                ],
            ],
        ],
        'mission-dev-mezcalito-2-snowfinch' => [
            'id' => '245ee9aa-0135-483d-a734-d5f070608e1d',
            'reference' => 'Snowfinch',
            'customer' => 'Snowfinch',
            'activity_reference' => 'activity-dev-mezcalito-2',
            'translations' => [
                'language-english' => [
                    'role' => 'Tech Leader & Developer',
                    'environment' => 'PHP, Symfony, PostgreSQL, Git',
                    'description' => 'Development, definition of the architecture and realization of an equipment rental engine sold to independent ski and mountain bike rental shops in the mountains.',
                    'link' => 'https://www.snowfinch.fr',
                ],
                'language-french' => [
                    'role' => 'Leader Technique & Développeur',
                    'environment' => 'PHP, Symfony, PostgreSQL, Git',
                    'description' => 'Elaboration, définition de l’architecture et réalisation d’un moteur de location de matériel proposé aux magasins indépendants de location de ski et vtt en montagne.',
                    'link' => 'https://www.snowfinch.fr',
                ],
            ],
        ],
        'mission-dev-mezcalito-2-sport2000' => [
            'id' => '93910096-fb01-49b3-9a11-1df8374725e7',
            'reference' => 'Sport2000',
            'customer' => 'Sport2000',
            'activity_reference' => 'activity-dev-mezcalito-2',
            'translations' => [
                'language-english' => [
                    'role' => 'Developer',
                    'environment' => 'PHP, Symfony, MySQL, Redis, Varnish, Git, BackboneJs, RequireJs, Sass, Compass',
                    'description' => 'Support during the development and development of new features for the Sport2000 ski rental engine.',
                    'link' => 'https://ski-hire-sport2000.co.uk',
                ],
                'language-french' => [
                    'role' => 'Développeur',
                    'environment' => 'PHP, Symfony, MySQL, Redis, Varnish, Git, BackboneJs, RequireJs, Sass, Compass',
                    'description' => 'Accompagnement lors de l’élaboration et développement de nouvelles fonctionnalités pour le moteur de location de ski de Sport2000.',
                    'link' => 'https://location-ski.sport2000.fr',
                ],
            ],
        ],
        'mission-dev-mezcalito-2-gsm' => [
            'id' => '3fca5e7b-56d7-4cf5-ad19-4c7632c13fe9',
            'reference' => 'GoSport Montagne',
            'customer' => 'GoSport Montagne',
            'activity_reference' => 'activity-dev-mezcalito-2',
            'translations' => [
                'language-english' => [
                    'role' => 'Developer',
                    'environment' => 'PHP, Symfony, CodeIgniter, PostgreSQL, MySQL, Git, BackboneJs, RequireJs',
                    'description' => 'Migration of the technical platform of the GoSport ski rental engine, from Codeigniter (PHP) to Symfony (PHP).',
                    'link' => 'https://gosportmontagne.co.uk',
                ],
                'language-french' => [
                    'role' => 'Développeur',
                    'environment' => 'PHP, Symfony, CodeIgniter, PostgreSQL, MySQL, Git, BackboneJs, RequireJs',
                    'description' => 'Participation à la migration de la plateforme technique du moteur de location de ski de GoSport. Migration de Codeigniter (PHP) vers Symfony (PHP).',
                    'link' => 'https://gosportmontagne.com',
                ],
            ],
        ],
        'mission-freelance-dukt' => [
            'id' => '2dad9831-fb40-4e6f-b634-aaee77dbc4e5',
            'reference' => 'Dukt',
            'customer' => 'Dukt',
            'activity_reference' => 'activity-freelance',
            'translations' => [
                'language-english' => [
                    'role' => 'Developer',
                    'environment' => 'PHP, CraftCMS, Yii Framework, VueJS',
                    'description' => 'Support and code improvements of the CraftCMS plugins.',
                    'link' => 'https://dukt.net',
                ],
                'language-french' => [
                    'role' => 'Développeur',
                    'environment' => 'PHP, CraftCMS, Yii Framework, VueJS',
                    'description' => 'Support et refonte de plugins pour CraftCMS.',
                    'link' => 'https://dukt.net',
                ],
            ],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $reference => $data) {
            $mission = (new Mission())
                ->setId(Uuid::fromString($data['id']))
                ->setReference($data['reference'])
                ->setActivity($this->getReference($data['activity_reference']))
            ;

            if (true === isset($data['customer'])) {
                $mission->setCustomer($data['customer']);
            }

            foreach ($data['translations'] as $languageReference => $translationData) {
                $translation = (new MissionTranslation())
                    ->setRole($translationData['role'])
                    ->setEnvironment($translationData['environment'])
                    ->setDescription($translationData['description'])
                    ->setMission($mission)
                    ->setLanguage($this->getReference($languageReference))
                ;

                if (true === isset($translationData['link'])) {
                    $translation->setLink($translationData['link']);
                }
            }

            $manager->persist($mission);
            $this->addReference($reference, $mission);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LanguageFixture::class,
            PlaceFixture::class,
            ActivityFixture::class,
        ];
    }
}
