<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Commentaire;
use App\Entity\Categorie;
use App\Entity\MotCle;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $author = new User();
        $author->setName($faker->name());
        $author->setEmail('tdebay@thenuumfactory.fr');
        $author->setPassword('$argon2id$v=19$m=65536,t=4,p=1$1ieyxRBcvCdx9u32c+Ov3Q$veZwMW5DquNyWp70dIsc/wfxxpGK/4V81bY8nfTGSJc'); // FIXME
        $manager->persist($author);

        $category_divers = new Categorie();
        $category_divers->setNom('Divers');
        $category_divers->setSlug('divers');
        $manager->persist($category_divers);

        $category_code = new Categorie();
        $category_code->setNom('Code');
        $category_code->setSlug('code');
        $manager->persist($category_code);

        $motcle_analyse = new MotCle();
        $motcle_analyse->setMotCle('Analyse');
        $manager->persist($motcle_analyse);

        $motcle_opinion = new MotCle();
        $motcle_opinion->setMotCle('Opinion');
        $manager->persist($motcle_opinion);
        $manager->flush();

        // créer quelques articles
        for ($i = 0; $i < 2; ++$i) {
            $article = new Article();
            $article->setTitre($faker->sentence($nbWords = 6, $variableNbWords = true));
            $article->setSlug($faker->word());
            $article->setContenu($faker->paragraphs($nb = 3, $asText = true));
            $article->setUser($author);
            $article->addCategory($category_code);
            $article->addMotCle($motcle_analyse);
            $article->addMotCle($motcle_opinion);
            $manager->persist($article);
            $manager->flush();
        }

        for ($i = 0; $i < 2; ++$i) {
            $article = new Article();
            $article->setTitre($faker->sentence($nbWords = 6, $variableNbWords = true));
            $article->setSlug($faker->word());
            $article->setContenu($faker->paragraphs($nb = 3, $asText = true));
            $article->setUser($author);
            $article->addCategory($category_divers);
            $manager->persist($article);
            $article->addMotCle($motcle_opinion);
            $manager->flush();

            // et des commentaires associés
            for ($i = 0; $i < 2; ++$i) {
                $commentaire = new Commentaire();
                $commentaire->setPseudo($faker->name())
                ->setContenu($faker->sentence($nbWords = 24, $variableNbWords = true))
                ->setCreatedAt(new \DateTime())
                ->setArticle($article);
                $manager->persist($commentaire);
                $manager->flush();
            }
        }
    }
}
