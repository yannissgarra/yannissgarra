<?php

namespace App\Fixture\Career;

use App\Career\Domain\Model\Employee;
use App\Career\Domain\Model\EmployeeTranslation;
use App\Fixture\Language\LanguageFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class EmployeeFixture extends Fixture implements DependentFixtureInterface
{
    public const DATA = [
        'employee-yannis-sgarra' => [
            'id' => 'ffe7d61f-f184-44a7-bce7-256e6cd8e7a3',
            'first_name' => 'Yannis',
            'last_name' => 'Sgarra',
            'email' => 'hello@yannissgarra.com',
            'github_url' => 'https://github.com/yannissgarra',
            'linkedin_url' => 'https://www.linkedin.com/in/yannissgarra/',
            'twitter_url' => 'https://twitter.com/yannissgarra',
            'translations' => [
                'language-english' => [
                    'role' => 'Web Developer',
                    'description' => 'Passionate about the web, curious about new technologies, I love to spend time shaping the applications I develop, with the aim of always offering the best possible response to user issues.',
                ],
                'language-french' => [
                    'role' => 'Développeur Web',
                    'description' => 'Passionné du web, curieux des nouvelles technologies, j’aime passer du temps à façonner les applications que je développe, avec pour objectif de toujours offrir la meilleure réponse possible aux problématiques de l’utilisateur.',
                ],
            ],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::DATA as $reference => $data) {
            $employee = (new Employee())
                ->setId(Uuid::fromString($data['id']))
                ->setFirstName($data['first_name'])
                ->setLastName($data['last_name'])
                ->setEmail($data['email'])
                ->setGithubUrl($data['github_url'])
                ->setLinkedinUrl($data['linkedin_url'])
                ->setTwitterUrl($data['twitter_url'])
            ;

            foreach ($data['translations'] as $languageReference => $translationData) {
                (new EmployeeTranslation())
                    ->setRole($translationData['role'])
                    ->setDescription($translationData['description'])
                    ->setEmployee($employee)
                    ->setLanguage($this->getReference($languageReference))
                ;
            }

            $manager->persist($employee);
            $this->addReference($reference, $employee);
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
