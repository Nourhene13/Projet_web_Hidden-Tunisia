<?php

namespace App\Controller;

use App\Entity\Circuits;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CircuitType;
use App\Repository\CircuitsRepository;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\ChartOptions;

class CircuitController extends AbstractController
{
    #[Route('/circuitback', name: 'app_circuits')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Circuits::class)->findAll();

        return $this->render('circuit/afficherback.html.twig', [
            'list' => $data,
        ]);
    }

    #[Route('/circuitAffichage', name: 'app_circuitAfficher')]
    public function afficher(): Response
    {
        $data = $this->getDoctrine()->getRepository(Circuits::class)->findAll();
        return $this->render('circuit\afficherfront.html.twig', [
            'data' => $data,
        ]);
    }



    #[Route('/AjouterCircuit', name: 'create_cicuit')]
    public function create(Request $request): Response
    {
        $Circuit = new Circuits();
        $form = $this->createForm(CircuitType::class, $Circuit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Circuit->setUtilisateur($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($Circuit);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
            return $this->redirectToRoute('app_circuits');
        }
        return $this->render('circuit/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/updateCircuit/{id}', name: 'update_circuit')]
    public function update(Request $request, $id): Response
    {
        $Circuit = $this->getDoctrine()->getRepository(Circuits::class)->find($id);
        $form = $this->createForm(CircuitType::class, $Circuit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Circuit);
            $em->flush();
            $this->addFlash('notice', 'update successfuly!!');
            return $this->redirectToRoute('app_circuits');
        }
        return $this->render('circuit/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/deleteCircuit/{id}', name: 'delete_circuit')]
    public function delete($id): Response
    {
        $data = $this->getDoctrine()->getRepository(Circuits::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice', 'Deleted successfuly!!');
        return $this->redirectToRoute('app_circuits');
    }
}
