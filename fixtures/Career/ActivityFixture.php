<?php

namespace App\Fixture\Career;

use App\Career\Domain\Model\Activity;
use App\Career\Domain\Model\ActivityTranslation;
use App\Fixture\Language\LanguageFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class ActivityFixture extends Fixture implements DependentFixtureInterface
{
    public const DATA = [
        'activity-baccalaureat' => [
            'id' => 'c10a9d2e-0263-440e-a08a-890e0a404228',
            'reference' => 'Baccalaureate',
            'started_at' => '2005-09-01',
            'stopped_at' => '2008-06-30',
            'type' => 'training',
            'place_reference' => 'place-berlioz',
            'translations' => [
                'language-english' => [
                    'title' => 'Scientific baccalaureate, mathematics specialty',
                    'description' => 'Admitted with honors.',
                ],
                'language-french' => [
                    'title' => 'Baccalauréat scientifique SVT, spécialité mathématiques',
                    'description' => 'Reçu mention bien.',
                ],
            ],
        ],
        'activity-dut' => [
            'id' => '50be6da6-fb36-457a-acb2-0b88d46a4aa4',
            'reference' => 'DUT SRC',
            'started_at' => '2008-09-01',
            'stopped_at' => '2010-06-30',
            'type' => 'training',
            'place_reference' => 'place-uga',
            'translations' => [
                'language-english' => [
                    'title' => 'Graduate Technological Degree for Communication Services and Networks',
                    'description' => 'The DUT speciality Multimedia and Internet Technologies (MIT), formerly called Communication Services and Networks (CSN), provides teaching whose aim is to prepare students over four semesters for positions of technical and professional responsibility and leadership in the field of multimedia and the Internet.',
                ],
                'language-french' => [
                    'title' => 'DUT Services et Réseaux de Communication',
                    'description' => 'Le DUT des Métiers du Multimédia et de l’Internet (MMI, ex-SRC) a pour objectif de former des concepteurs, des techniciens, des assistants de gestion de projets aptes à s’impliquer dans les métiers liés à la communication multimédia et internet.',
                ],
            ],
        ],
        'activity-lp' => [
            'id' => 'b21554ce-789d-49cb-be4f-3a7f1950a9ba',
            'reference' => 'Licence Pro SMIN',
            'started_at' => '2010-09-01',
            'stopped_at' => '2011-06-30',
            'type' => 'training',
            'place_reference' => 'place-uga',
            'translations' => [
                'language-english' => [
                    'title' => 'Professional Bachelor’s Degree for Nomad Services and Mobility Interfaces',
                    'description' => 'The LP speciality Nomad Services and Mobility Interfaces, provides teaching whose aim is to prepare students in the implementation of web and mobile applications to be able to participate in an Internet application development project on multiple media, to supervise a team of development, design and production of short content and messages adapted to mobile devices.',
                ],
                'language-french' => [
                    'title' => 'Licence Professionnelle Services Mobiles et Interfaces Nomades',
                    'description' => 'La licence professionnelle Services Mobiles et Interface Nomade (S.M.I.N) vise à former à la mise en place d’applications web et mobiles pour être capables de participer à un projet de développement d’application Internet sur de multiples supports, d’encadrer une équipe de développement, de concevoir et de produire des contenus courts et des messages adaptés aux dispositifs mobiles.',
                ],
            ],
        ],
        'activity-dev-mezcalito-1' => [
            'id' => '41a9ac07-57ba-46e8-9848-39a96eb599c8',
            'reference' => 'Dev Mezcalito v1',
            'started_at' => '2010-08-01',
            'stopped_at' => '2014-10-31',
            'type' => 'work',
            'place_reference' => 'place-mezcalito',
            'translations' => [
                'language-english' => [
                    'title' => 'Developer',
                ],
                'language-french' => [
                    'title' => 'Développeur',
                ],
            ],
        ],
        'activity-found-cuisinetudiant' => [
            'id' => '3b21700c-7e0a-4a0b-a83f-b0ea9380d7dc',
            'reference' => 'Fondateur Cuisine Etudiant',
            'started_at' => '2009-02-01',
            'stopped_at' => '2015-12-31',
            'type' => 'project',
            'place_reference' => 'place-cuisinetudiant',
            'translations' => [
                'language-english' => [
                    'title' => 'Co-Founder & Developer',
                    'description' => 'The project was sold in December 2015.',
                ],
                'language-french' => [
                    'title' => 'Cofondateur & Développeur',
                    'description' => 'Le projet a été vendu en décembre 2015.',
                ],
            ],
        ],
        'activity-dev-mezcalito-2' => [
            'id' => '5bae3ad5-ad82-4f61-a84f-9991081cdf56',
            'reference' => 'Dev Mezcalito v2',
            'started_at' => '2016-02-01',
            'stopped_at' => '2019-11-30',
            'type' => 'work',
            'place_reference' => 'place-mezcalito',
            'translations' => [
                'language-english' => [
                    'title' => 'Developer',
                ],
                'language-french' => [
                    'title' => 'Développeur',
                ],
            ],
        ],
        'activity-freelance' => [
            'id' => '843a0158-8e86-4319-b1e1-e40b7ca95ddb',
            'reference' => 'Freelance',
            'started_at' => '2019-11-30',
            'type' => 'work',
            'place_reference' => 'place-freelance',
            'translations' => [
                'language-english' => [
                    'title' => 'Developer',
                ],
                'language-french' => [
                    'title' => 'Développeur',
                ],
            ],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $reference => $data) {
            $activity = (new Activity())
                ->setId(Uuid::fromString($data['id']))
                ->setReference($data['reference'])
                ->setStartedAt(new \DateTime($data['started_at']))
                ->setType($data['type'])
                ->setPlace($this->getReference($data['place_reference']))
            ;

            if (true === isset($data['stopped_at'])) {
                $activity->setStoppedAt(new \DateTime($data['stopped_at']));
            }

            foreach ($data['translations'] as $languageReference => $translationData) {
                $translation = (new ActivityTranslation())
                    ->setTitle($translationData['title'])
                    ->setActivity($activity)
                    ->setLanguage($this->getReference($languageReference))
                ;

                if (true === isset($translationData['description'])) {
                    $translation->setDescription($translationData['description']);
                }
            }

            $manager->persist($activity);
            $this->addReference($reference, $activity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LanguageFixture::class,
            PlaceFixture::class,
        ];
    }
}
