<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\CommentaireType;
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
            if ($request->request->count() > 0) {
                $commentaire = new Commentaire();
                $commentaire->setPseudo($request->request->get('commentaire')['pseudo'])
                            ->setContenu($request->request->get('commentaire')['contenu'])
                            ->setCreatedAt(new \DateTime())
                            ->setArticle($articleRepository->find($request->request->get('article_id')));
                $em->persist($commentaire);
                $em->flush();
            }
            return $this->redirectToRoute('home');
        }
    }
}
