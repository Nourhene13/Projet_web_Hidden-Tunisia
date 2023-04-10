<?php

namespace App\Controller;

use App\Form\ReservationType;

use App\Entity\Reservations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ReservationsController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservations')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Reservations::class)->findAll();
        return $this->render('reservations/afficherback.html.twig', [
            'list' => $data,
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $Reservation = new Reservations();
        $form = $this->createForm(ReservationType::class, $Reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Reservation);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
        }
        return $this->render('reservations/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/update/{id}', name: 'update')]
    public function update(Request $request, $id): Response
    {
        $Reservation = $this->getDoctrine()->getRepository(Reservations::class)->find($id);
        $form = $this->createForm(ReservationType::class, $Reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Reservation);
            $em->flush();
            $this->addFlash('notice', 'update successfuly!!');
            return $this->redirectToRoute('app_reservations');
        }
        return $this->render('reservations/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete($id): Response
    {
        $data = $this->getDoctrine()->getRepository(Reservations::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice', 'Deleted successfuly!!');
        return $this->redirectToRoute('app_reservations');
    }
}
