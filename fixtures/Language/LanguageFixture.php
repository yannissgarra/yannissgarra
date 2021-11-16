<?php

namespace App\Fixture\Language;

use App\Language\Domain\Model\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class LanguageFixture extends Fixture
{
    public const DATA = [
        'language-english' => [
            'id' => '7d043a18-6f7b-4bf1-a2dc-1eef7dcac699',
            'title' => 'English',
            'locale' => 'en',
        ],
        'language-french' => [
            'id' => 'f0d0c1c9-a1f0-4057-a7f6-78e2673e4829',
            'title' => 'Français',
            'locale' => 'fr',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $reference => $data) {
            $language = (new Language())
                ->setId(Uuid::fromString($data['id']))
                ->setTitle($data['title'])
                ->setLocale($data['locale'])
            ;

            $manager->persist($language);
            $this->addReference($reference, $language);
        }

        $manager->flush();
    }
}
