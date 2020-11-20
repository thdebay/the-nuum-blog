<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="save_comment", methods={"POST"})
     */
    public function store(EntityManagerInterface $em, ArticleRepository $articleRepository, Request $request): Response
    {
        if ($request->isMethod('POST')) {
            // récupérer l'article auquel on veut associer le commentaire
            $article = $articleRepository->find($request->request->get('article_id'));

            // vérifier que le formulaire comporte les informations requises
            if ($request->request->count() > 0) {
                $commentaire = new Commentaire();

                // FIXME - we shouldn't need to retrieve the authenticated user name here.
                // However, it is not included in the request when the form is submitted, because we have disabled the field when the user is logged in
                $commentaire->setPseudo($request->request->get('commentaire')['pseudo'] ?? $this->getUser()->getName())
                            ->setContenu($request->request->get('commentaire')['contenu'])
                            ->setCreatedAt(new \DateTime())
                            ->setArticle($article);
                $em->persist($commentaire);
                $em->flush();
            }

            // rediriger vers la page de l'article (rafraichir)
            return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        }
    }
}
