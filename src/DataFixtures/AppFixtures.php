<?php
namespace App\DataFixtures;
use App\Entity\Article;
use App\Entity\User;
use Faker;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Commentaire;
use App\Entity\Categorie;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager) {

        $faker = Faker\Factory::create('fr_FR');

        $author = new User();
        $author->setName($faker->name());
        $author->setEmail($faker->safeEmail());
        $author->setPassword('abcdefghijkl');
        $manager->persist($author);

        $divers = new Categorie();
        $divers->setNom('Divers');
        $divers->setSlug('divers');
        $manager->persist($divers);

        $code = new Categorie();
        $code->setNom('Code');
        $code->setSlug('code');
        $manager->persist($code);
        $manager->flush();

        // créer quelques articles
        for ($i = 0; $i < 2; $i++) {
            $article = new Article();
            $article->setTitre($faker->sentence($nbWords = 6, $variableNbWords = true));
            $article->setSlug($faker->word());
            $article->setContenu($faker->paragraphs($nb = 3, $asText = true));
            $article->setUser($author);
            $manager->persist($article);
            $manager->flush();
        }
        $article->addCategory($code);
        

/*         for ($i = 0; $i < 2; $i++) {
            $article = new Article();
            $article->setTitre($faker->sentence($nbWords = 6, $variableNbWords = true));
            $article->setSlug($faker->word());
            $article->setContenu($faker->paragraphs($nb = 3, $asText = true));
            $article->setUser($author);
            $article->addCategory($divers);
            $manager->persist($article);
            $manager->flush();
        } */

            // et des commentaires associés
/*             for ($i=0; $i < 2; $i++) {
                $commentaire = new Commentaire();
                $commentaire->setPseudo($faker->name())
                ->setContenu($faker->sentence($nbWords = 24, $variableNbWords = true))
                ->setCreatedAt(new \DateTime())
                ->setArticle($article);
                $manager->persist($commentaire);
                $manager->flush();
            } */
    }
}