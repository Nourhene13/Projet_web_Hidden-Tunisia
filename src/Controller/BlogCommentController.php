<?php

namespace App\Controller;

use App\Entity\BlogComment;
use App\Form\BlogCommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\EntityManagerInterface;

class BlogCommentController extends AbstractController
{
    #[Route('/blog_comment', name: 'app_blog_comment')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(BlogComment::class)->findAll();
        return $this->render('blog_comment/afficherback_comment.html.twig', [
            'list' => $data,
        ]);
    }
    #[Route('/create_comment', name: 'create_comment')]
    public function create(Request $request): Response
    {
        $BlogArticle = new BlogComment();
        $form = $this->createForm(BlogCommentType::class, $BlogArticle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($BlogArticle);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
            return $this->redirectToRoute('app_blog_comment');
        }
        return $this->render('blog_comment/create_comment.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/update1/{id}', name: 'update1')]
    public function update(Request $request, $id): Response
    {
        $BlogArticle = $this->getDoctrine()->getRepository(BlogComment::class)->find($id);
        $form = $this->createForm(BlogCommentType::class, $BlogArticle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($BlogArticle);
            $em->flush();
            $this->addFlash('notice', 'update successfuly!!');
            return $this->redirectToRoute('app_blog_comment');
        }
        return $this->render('blog_comment/update1.html.twig', [
            'form' => $form->createView()
        ]);
    }

    

    #[Route('/delete_comment/{id}', name: 'delete_comment')]
    public function delete($id): Response
    {
        $data = $this->getDoctrine()->getRepository(BlogComment::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice', 'Deleted successfuly!!');
        return $this->redirectToRoute('app_blog_comment');
    }

  #[Route('/update_dislikes/{id}', name: 'update_dislikes', methods: ["POST"])]
public function likeComment(Request $request, BlogComment $comment): Response
{
    $comment->setLikes($comment->getLikes() + 1);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($comment);
    $entityManager->flush();

    return $this->json(['success' => true]);
}

    #[Route('/update_dislikes/{id}', name:'update_dislikes', methods:["POST"])]
    public function dislikeComment(Request $request, BlogComment $comment): Response
    {
        $comment->setDislikes($comment->getDislikes() + 1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();
    
        return $this->json(['success' => true]);
    }


    #[Route('/updateLikes', name: 'updateLikes', methods: ['POST'])]
    public function updateLikes(Request $request): JsonResponse
    {
        $commentId = $request->request->get('commentId');
        $isLike = $request->request->get('isLike');
        $isDislike = $request->request->get('isDislike');
    
        // Récupérer le commentaire correspondant à l'ID
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $entityManager->getRepository(BlogComment::class)->find($commentId);
    
        // Vérifier si le commentaire a été trouvé
        if (!$comment) {
            throw $this->createNotFoundException('Comment not found for id '.$commentId);
        }
    
        // Incrémenter le nombre de likes ou de dislikes
        if ($isLike) {
            $comment->setLikes($comment->getLikes() + 1);
        } else if ($isDislike) {
            $comment->setDislikes($comment->getDislikes() + 1);
        }

    
        // Enregistrer les modifications en base de données
        $entityManager->flush();
    
        // Retourner la nouvelle valeur de likes et dislikes au format JSON
        return new JsonResponse([
            'success' => true,
            'likes' => $comment->getLikes(),
            'dislikes' => $comment->getDislikes(),
        ]);
}






}