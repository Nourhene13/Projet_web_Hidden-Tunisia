<?php

namespace App\Controller;
use App\Entity\Nourritures;
use App\Form\NourrituresType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;

class NourrituresController extends AbstractController
{
    #[Route('/nourritures', name: 'app_nourritures')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Nourritures::class)->findAll();
        
        
        return $this->render('nourritures/index.html.twig', [
            'list' => $data,        ]);
    }
    #[Route('/create_nourritures', name: 'create_nourritures')]
    public function create(Request $request,FlashyNotifier $flashy): Response
    {
       $flashy->info('Welcome', 'http://your-awesome-link.com');
        $nourritures = new nourritures();
        $form = $this->createForm(NourrituresType::class, $nourritures);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
               
                 # $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                 $slugger = new AsciiSlugger();
                 $safeFilename = $slugger->slug($originalFilename);
                 

                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // handle exception
                }

                $nourriture->setImage($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($nourritures);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
        }
        return $this->render('nourritures/create_nourritures.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/update_nourritures/{id}', name: 'update_nourritures')]
    public function update(Request $request, $id): Response
    {
        $nourritures = $this->getDoctrine()->getRepository(Nourritures::class)->find($id);
        $form = $this->createForm(NourrituresType::class, $nourritures);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nourritures);
            $em->flush();
            $this->addFlash('notice', 'update successfuly!!');
            return $this->redirectToRoute('app_nourritures');
        }
        return $this->render('nourritures/update_nourritures.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/delete_nourritures/{id}', name: 'delete_nourritures')]
    public function delete($id): Response
    {
        $data = $this->getDoctrine()->getRepository(Nourritures::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice', 'Deleted successfuly!!');
        return $this->redirectToRoute('app_nourritures');
    }
}
