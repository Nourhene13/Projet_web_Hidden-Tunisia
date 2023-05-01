<?php

namespace App\Controller;

use App\Entity\BlogArticle;
use App\Entity\BlogComment;
use App\Form\BlogArticleType;
use App\Form\BlogCommentType;
use App\Repository\BlogArticleRepository;
use App\Repository\BlogCommentRepository;
use App\Repository\UtilisateurRepository;
use Container1Zums5W\getUtilisateurRepositoryService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;









class BlogArticleController extends AbstractController
{
    #[Route('/blog_article', name: 'app_blog_article')]
    public function index(Request $request,PaginatorInterface $paginator): Response
    {
        $data = $this->getDoctrine()->getRepository(BlogArticle::class)->findAll();

        $blog_article = $paginator->paginate(
            $data, /* pass $data instead of $blog_article */
            $request->query->getInt('page', 1),
            2
        );
        return $this->render('blog_article/afficherArticle.html.twig', [
            'list' => $data,
            'blog_article' => $blog_article // pass the $blog_article variable to the view
        ]);
    }



    



    #[Route('/blog_details/{id}', name: 'blog_details')]
    public function blogDetails(Request $request,$id,BlogCommentRepository $blogCommentRepository): Response
    {
        $data = $this->getDoctrine()->getRepository(BlogArticle::class)->find($id);
        $data1 = $blogCommentRepository->findByBlogArticle($data);
        $blogComment = new BlogComment();
        $form = $this->createForm(BlogCommentType::class, $blogComment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogComment->setBlogArticle($data);
            $blogComment->setUtilisateur($data->getUtilisateur());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogComment);
            $entityManager->flush();
        }
        $commentCounts = count($data->getBlogComments());
        return $this->render('blog_article/blogDetails.html.twig', [
            'data' => $data,'form' => $form->createView(),'data1' => $data1
        ]);
    }
    
    #[Route('/create_article', name: 'create_article')]
    public function create(Request $request): Response
    {
        $blogArticle = new BlogArticle();
        $form = $this->createForm(BlogArticleType::class, $blogArticle);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $blogArticle->setState(BlogArticle::STATES[0]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogArticle);
            $entityManager->flush();

            $this->addFlash('notice', 'Submitted successfuly!!');

            return $this->redirectToRoute('app_blog_article');
        }

        return $this->render('blog_article/create_article.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/update_article/{id}', name: 'update_article')]
    public function update(Request $request, $id): Response
    {
        $blogArticle = $this->getDoctrine()->getRepository(BlogArticle::class)->find($id);
        $dataComment= $this->getDoctrine()->getRepository(BlogComment::class)->findAll();
        $form = $this->createForm(BlogArticleType::class, $blogArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogArticle);
            $entityManager->flush();

            $this->addFlash('notice', 'Update successfuly!!');

            return $this->redirectToRoute('app_blog_article');
        }

        return $this->render('blog_article/update_article.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete_article/{id}', name: 'delete_article')]
    public function delete($id): Response
    {
        $blogArticle = $this->getDoctrine()->getRepository(BlogArticle::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($blogArticle);
        $entityManager->flush();

        $this->addFlash('notice', 'Deleted successfuly!!');

        return $this->redirectToRoute('app_blog_article');
    }
   




}