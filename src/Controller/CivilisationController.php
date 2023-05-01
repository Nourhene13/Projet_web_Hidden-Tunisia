<?php

namespace App\Controller;

use App\Entity\Civilisation;
use App\Form\CivilisationType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CivilisationController extends AbstractController
{
    #[Route('/civilisation', name: 'app_civilisation')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Civilisation::class)->findAll();

        return $this->render('civilisation/index.html.twig', [
            'list' => $data,        ]);
            
        
            return $this->render('civilisation/templatecivi.html.twig', [
                'civilisations' => $civilisations,
                
            ]);
    }
    #[Route('/create_civilisation', name: 'create_civilisation')]
    public function create(Request $request): Response
    {
        $civilisation = new civilisation();
        $form = $this->createForm(CivilisationType::class, $civilisation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { $imageFile = $form->get('image')->getData();

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

                $civilisation->setImage($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($civilisation);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
        }
        return $this->render('civilisation/create_civilisation.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/update_civilisation/{id}', name: 'update_civilisation')]
    public function update(Request $request, $id): Response
    {
        $civilisation = $this->getDoctrine()->getRepository(Civilisation::class)->find($id);
        $form = $this->createForm(CivilisationType::class, $civilisation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($civilisation);
            $em->flush();
            $this->addFlash('notice', 'update successfuly!!');
            return $this->redirectToRoute('app_civilisation');
        }
        return $this->render('civilisation/update_civilisation.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/delete_civilisation/{id}', name: 'delete_civilisation')]
    public function delete($id): Response
    {
        $data = $this->getDoctrine()->getRepository(Civilisation::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice', 'Deleted successfuly!!');
        return $this->redirectToRoute('app_civilisation');
    }
}
