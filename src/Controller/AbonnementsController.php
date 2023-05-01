<?php

namespace App\Controller;

use App\Entity\Abonnements;
use App\Form\AbonnementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\PdfGeneratorService;

class AbonnementsController extends AbstractController
{
    #[Route('/abonnements', name: 'app_abonnements')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Abonnements::class)->findAll();
        return $this->render('abonnements/afficherback_abonnement.html.twig', [
            'list' => $data,
        ]);
    }
    #[Route('/create_abonnement', name: 'create_abonnement')]
    public function create(Request $request): Response
    {
        $Abonnement = new Abonnements();
        $form = $this->createForm(AbonnementType::class, $Abonnement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Abonnement);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
        }
        return $this->render('abonnements/create_abonnement.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/update_abonnement/{id}', name: 'update_abonnement')]
    public function update(Request $request, $id): Response
    {
        $Abonnement = $this->getDoctrine()->getRepository(Abonnements::class)->find($id);
        $form = $this->createForm(AbonnementType::class, $Abonnement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Abonnement);
            $em->flush();
            $this->addFlash('notice', 'update successfuly!!');
            return $this->redirectToRoute('app_abonnements');
        }
        return $this->render('abonnements/update_abonnement.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete_abonnement/{id}', name: 'delete_abonnement')]
    public function delete($id): Response
    {
        $data = $this->getDoctrine()->getRepository(Abonnements::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice', 'Deleted successfuly!!');
        return $this->redirectToRoute('app_abonnements');
    }

    #[Route('/abonnements/pdf', name: 'generator_service_abonnements')]
    public function pdfService(): Response
    {
        $reservations = $this->getDoctrine()
            ->getRepository(Abonnements::class)
            ->findAll();



        $html = $this->renderView('pdf/index1.html.twig', ['list' => $reservations]);
        $pdfGeneratorService = new PdfGeneratorService;
        $pdf = $pdfGeneratorService->generatePdf($html);

        return new Response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ]);
    }
}
