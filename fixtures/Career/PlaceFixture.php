<?php

namespace App\Fixture\Career;

use App\Career\Domain\Model\Place;
use App\Career\Domain\Model\PlaceTranslation;
use App\Fixture\Language\LanguageFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class PlaceFixture extends Fixture implements DependentFixtureInterface
{
    public const DATA = [
        'place-berlioz' => [
            'id' => '812f93f6-9e1a-4ea1-9b6b-25a4c9564aae',
            'name' => 'Lycée Hector Berlioz',
            'translations' => [
                'language-english' => [
                    'description' => 'The Hector Berlioz high school is the main high school in the Côte-Saint-André area.',
                    'link' => 'https://hector-berlioz.ent.auvergnerhonealpes.fr',
                ],
                'language-french' => [
                    'description' => 'Le lycée Hector Berlioz est le lycée de référence de la région de La Côte-Saint-André.',
                    'link' => 'https://hector-berlioz.ent.auvergnerhonealpes.fr',
                ],
            ],
        ],
        'place-uga' => [
            'id' => '52451427-7dae-4734-bf6e-c3bbcdb6db45',
            'name' => 'Université Grenoble-Alpes',
            'translations' => [
                'language-english' => [
                    'description' => 'The Université Grenoble Alpes (UGA) is the main research university in the Grenoble metropolitan area.',
                    'link' => 'https://www.univ-grenoble-alpes.fr/english/',
                ],
                'language-french' => [
                    'description' => 'L’Université Grenoble-Alpes (UGA) est le principal établissement d’enseignement supérieur de la métropole grenobloise.',
                    'link' => 'https://www.univ-grenoble-alpes.fr',
                ],
            ],
        ],
        'place-mezcalito' => [
            'id' => 'f28c8a69-e6c3-46b8-adcc-5f7aaabf05f1',
            'name' => 'Mezcalito',
            'translations' => [
                'language-english' => [
                    'description' => 'Mezcalito is a web agency located in Grenoble.',
                    'link' => 'https://www.mezcalito.fr',
                ],
                'language-french' => [
                    'description' => 'Mezcalito est une agence web située à Grenoble.',
                    'link' => 'https://www.mezcalito.fr',
                ],
            ],
        ],
        'place-cuisinetudiant' => [
            'id' => '6369116e-b3b2-4ce9-b823-1c4973c4306f',
            'name' => 'Cuisine Etudiant',
            'translations' => [
                'language-english' => [
                    'description' => 'Cuisine Etudiant is a platform used by a community of several hundred thousand users around a subject: easy, fast and economical cooking.',
                    'link' => 'https://www.cuisine-etudiant.fr',
                ],
                'language-french' => [
                    'description' => 'Cuisine Etudiant est une plateforme qui regroupe une communauté de plusieurs centaines de milliers d’utilisateurs autour d’un sujet : la cuisine facile, rapide et économique.',
                    'link' => 'https://www.cuisine-etudiant.fr',
                ],
            ],
        ],
        'place-freelance' => [
            'id' => '1f89e763-ec5b-45e1-93ab-1283ae6c2c3c',
            'name' => 'Freelance',
            'translations' => [
                'language-english' => [
                    'description' => 'That’s me!',
                    'link' => 'https://yannissgarra.com',
                ],
                'language-french' => [
                    'description' => 'C’est moi !',
                    'link' => 'https://yannissgarra.com',
                ],
            ],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $reference => $data) {
            $place = (new Place())
                ->setId(Uuid::fromString($data['id']))
                ->setName($data['name'])
            ;

            foreach ($data['translations'] as $languageReference => $translationData) {
                (new PlaceTranslation())
                    ->setDescription($translationData['description'])
                    ->setLink($translationData['link'])
                    ->setPlace($place)
                    ->setLanguage($this->getReference($languageReference))
                ;
            }

            $manager->persist($place);
            $this->addReference($reference, $place);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LanguageFixture::class,
        ];
    }
}
