<?php

namespace App\Controller;

use App\Entity\Evenements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvenementType;

use Symfony\Component\Routing\Annotation\Route;

class EvenementsController extends AbstractController
{
    #[Route('/evenements', name: 'app_evenements')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Evenements::class)->findAll();
        return $this->render('evenement/index1.html.twig', [
        //return $this->render('evenement/afficherback1.html.twig', [
            'list' => $data,
        ]);
    }
    #[Route('/create1', name: 'create1')]
    public function create(Request $request): Response
    {
        $Evenement = new Evenements();
        $form = $this->createForm(EvenementType::class, $Evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Evenement);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
            return $this->redirectToRoute('app_evenements');
        }
        return $this->render('evenement/create1.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/update1/{id}', name: 'update1')]
    public function update(Request $request, $id): Response
    {
        $Evenement = $this->getDoctrine()->getRepository(Evenements::class)->find($id);
        $form = $this->createForm(EvenementType::class, $Evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Evenement);
            $em->flush();
            $this->addFlash('notice', 'update successfuly!!');
            return $this->redirectToRoute('app_evenements');
        }
        return $this->render('evenement/update1.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete1/{id}', name: 'delete1')]
    public function delete($id): Response
    {
        $data = $this->getDoctrine()->getRepository(Evenements::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice', 'Deleted successfuly!!');
        return $this->redirectToRoute('app_evenements');
    }
}
