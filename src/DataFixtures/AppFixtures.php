<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Anime;
use App\Entity\Genre;
use App\Entity\Mood;
use App\Entity\Platform;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // ****************************************
        // genres, moods, platforms

        $genres = ['Fantasy', 'Action', 'Romance', 'Slice of Life', 'Comedy', 'Adventure', 'Drama', 'School'];
        $genreEntities = [];
        foreach ($genres as $name) {
            $genre = new Genre();
            $genre->setName($name);
            $manager->persist($genre);
            $genreEntities[$name] = $genre;
        } 

        $moods = [
            'cozy' => [
                'label' => 'Cosy',
                'description' => 'Ambiance douce et réconfortante',
            ],
            'feel-good' => [
                'label' => 'Feel good',
                'description' => 'Anime joyeux et positif',
            ],
            'wholesome' => [
                'label' => 'Réconfortant',
                'description' => 'Rempli de tendresse et de bienveillance',
            ],
            'emotional' => [
                'label' => 'Émotionnel',
                'description' => 'Histoire touchante et émotive',
            ],
            'dark' => [
                'label' => 'Sombre',
                'description' => 'Ambiance sombre et intense',
            ],
            'epic' => [
                'label' => 'Épique',
                'description' => 'Aventure grandiose et héroïque',
            ],
            'relaxing' => [
                'label' => 'Relaxant',
                'description' => 'Calme et apaisant',
            ],
            'tense' => [
                'label' => 'Tendu',
                'description' => 'Suspense et tension',
            ],
        ];

        $moodEntities = [];
        $baseUrl = 'http://localhost:8000';
        foreach ($moods as $slug => $moodData) {
            $mood = new Mood();
            $mood
                ->setSlug($slug)
                ->setLabel($moodData['label'])
                ->setDescription($moodData['description'])
                ->setImageUrl($baseUrl . '/images/moods/' . $slug . '.png');
            $manager->persist($mood);
            $moodEntities[$slug] = $mood;
        }

        $platforms = [
            'Crunchyroll' => [
                'iconUrl' => 'https://placehold.co/64x64/f14a29/FFFFFF?text=C',
                'imageUrl' => 'https://placehold.co/600x300?text=Crunchyroll',
            ],
            'Netflix' => [
                'iconUrl' => 'https://placehold.co/64x64/282320/e51726?text=N',
                'imageUrl' => 'https://placehold.co/600x300?text=Netflix',
            ],
            'Prime Video' => [
                'iconUrl' => 'https://placehold.co/64x64/089eff/080808?text=PV',
                'imageUrl' => 'https://placehold.co/600x300?text=Prime',
            ],
            'Disney+' => [
                'iconUrl' => 'https://placehold.co/64x64/1c306c/f5fcff?text=D',
                'imageUrl' => 'https://placehold.co/600x300?text=Disney',
            ],
        ];

        $platformEntities = [];

        foreach ($platforms as $name => $platformData) {
            $platform = new Platform();

            $platform
                ->setName($name)
                ->setIconUrl($platformData['iconUrl'])
                ->setImageUrl($platformData['imageUrl']);

            $manager->persist($platform);
            $platformEntities[$name] = $platform;
        }

        // ****************************************
        // Lire la liste des animés via le JSON

        $json = file_get_contents(__DIR__ . '/../../data/animes.json');
        $listAnimes = json_decode($json, true);

        foreach ($listAnimes as $animeData) {
            $anime = new Anime();
            
            $baseUrl = 'http://localhost:8000';
            $anime
            ->setTitle($animeData['title'])
            ->setSynopsis($animeData['synopsis'])
            ->setYear($animeData['year'])
            ->setAgeRating($animeData['ageRating'])
            ->setImageUrl($animeData['imageUrl'])
            ->setThumbnailUrl($baseUrl . '/images/animes/' . $animeData['slug'] . '.jpg');

        // ****************************************
        // Boucle pour genre, mood et platform

            foreach ($animeData['genres'] as $genreName) {
            $anime->addGenre($genreEntities[$genreName]);
            }

            foreach ($animeData['moods'] as $moodSlug) {
                $anime->addMood($moodEntities[$moodSlug]);
            }

            foreach ($animeData['platforms'] as $platformName) {
                $anime->addPlatform($platformEntities[$platformName]);
            }

            $manager->persist($anime);
        }

        // fin => on tire la chasse ^^
        $manager->flush();
        
    }

    
}
