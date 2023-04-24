<?php

namespace App\Controller;

use Endroid\QrCode\QrCode;
use App\Entity\Reservations;
use App\Form\ReservationType;
use App\Entity\PdfGeneratorService;
use Endroid\QrCode\ErrorCorrectionLevel;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\EntityManagerInterface;
use App\Entity\Evenements;
use App\Repository\ReservationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Container4mGbaQB\getReservationsRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface as ORMEntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Repository\ReservationsRepository as RepositoryReservationsRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use App\Controller\ClassMetadataInterface;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationsController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservations')]
    public function index(): Response
    {
        $data1 = $this->getDoctrine()->getRepository(Evenements::class)->findAll();
        $data = $this->getDoctrine()->getRepository(Reservations::class)->findAll();
        return $this->render('reservations/afficherback.html.twig', [
            'list' => $data, 'lst' => $data1
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $Reservation = new Reservations();
        $form = $this->createForm(ReservationType::class, $Reservation);
        $form->handleRequest($request);
        $response = null;
        if ($form->isSubmitted() && $form->isValid()) {


            $response = $this->forward('App\Controller\SmsController::sendSms');
            $em = $this->getDoctrine()->getManager();
            $em->persist($Reservation);
            $em->flush();
            $this->addFlash('notice', 'Submitted successfuly!!');
            return $this->render('reservations/create.html.twig', [
                'sms_response' => $response->getContent(),
                'form' => $form->createView(),
            ]);
        }
        return $this->render('reservations/create.html.twig', [
            'form' => $form->createView(),
            'sms_response' => false
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

    #[Route('/reservations/pdf', name: 'generator_service')]
    public function pdfService(ReservationsRepository $rep): Response
    {
        $selectedValue = $_POST["choice"];
        $reservations = $rep->findOneByEvenement($selectedValue);



        $html = $this->renderView('pdf/index.html.twig', ['list' => $reservations]);
        $pdfGeneratorService = new PdfGeneratorService;
        $pdf = $pdfGeneratorService->generatePdf($html);

        return new Response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
        ]);
    }




    #[Route('/sortByAscDate', name: 'sort_by_asc_date')]
    public function sortAscDate(ORMEntityManagerInterface $entityManager, RepositoryReservationsRepository $reservationsRepository, Request $request)
    {
        $reservations = $entityManager
            ->getRepository(Reservations::class)
            ->findAll();

        $query = $request->query->get('q');
        $reservations = $this->getDoctrine()
            ->getRepository(Reservations::class)
            ->findAll();

        $reservations = $reservationsRepository->sortByAscDate();

        return $this->render("reservations/index.html.twig", [
            'Reservations' => $reservations,
            'query' => $query,
        ]);
    }

    #[Route('/searchevenement', name: 'app_evenement_search')]
    public function searchOffre(Request $request, ORMEntityManagerInterface $entityManager): Response
    {
        $evenement =   $request->get('titre_evenement');


        if ($evenement == "") {
            $evenement = $entityManager
                ->getRepository(Evenement::class)
                ->findAll();
        } else {
            $evenement = $entityManager
                ->getRepository(Evenement::class)->findBy(
                    ['titreev' => $evenement]
                );
        }
        return $this->render('reservations/index.html.twig', [
            'lst' => $evenement,
        ]);
    }
}
