<?php

namespace App\Controller;

use App\Entity\Nourritures;
use App\Form\NourrituresType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class NourrituresController extends AbstractController
{
    #[Route('/nourritures', name: 'app_nourritures')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Nourritures::class)->findAll();


        return $this->render('nourritures/index.html.twig', [
            'list' => $data,
        ]);
    }

    #[Route('/nourrituresfront', name: 'app_nourritures_front')]
    public function indexfront(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $nourritures = $entityManager
            ->getRepository(Nourritures::class)
            ->findAll();
        $nourritures = $paginator->paginate(
            $nourritures, /* query NOT result */
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('nourritures/affichernourriturefront.html.twig', [
            'nourritures' => $nourritures,
        ]);
    }

    #[Route('/create_nourritures', name: 'create_nourritures')]
    public function create(Request $request, FlashyNotifier $flashy): Response
    {
        $flashy->info('Welcome', 'http://your-awesome-link.com');
        $nourritures = new Nourritures();
        $form = $this->createForm(NourrituresType::class, $nourritures);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);

                # $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $slugger = new AsciiSlugger();
                $safeFilename = $slugger->slug($originalFilename);


                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // handle exception
                }

                $nourritures->setImage($newFilename);
            }
            $nourritures->setUtilisateur($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($nourritures);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
            return $this->redirectToRoute('app_nourritures');
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
