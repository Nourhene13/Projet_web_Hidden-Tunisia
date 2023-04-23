<?php

namespace App\Controller;

use App\Entity\Evenements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvenementType;
use App\Repository\EvenementsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Routing\Annotation\Route;
use Swift_SmtpTransport;
use Swift_Message;
use Swift_Mailer;
use Symfony\Component\Mailer\MailerInterface;


class EvenementsController extends AbstractController
{
    #[Route('/evenementsBack', name: 'app_evenements')]
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Evenements::class)->findAll();
        return $this->render('evenement/index1.html.twig', [
            'list' => $data,
        ]);
    }

    #[Route('/evenementsAffichage', name: 'app_evenementsAfficher')]
    public function afficher(Request $request, EvenementsRepository $EvenementsRepository, PaginatorInterface $paginator): Response
    {
        $data = $this->getDoctrine()->getRepository(Evenements::class)->findAll();

        $data = $paginator->paginate(
            $data, /* query NOT result */
            $request->query->getInt('page', 1),
            2
        );
        return $this->render('evenement\afficherfront1.html.twig', [
            'data' => $data,
        ]);
    }


    #[Route('/AjouterEvenement', name: 'create1')]
    public function create(Request $request): Response
    {
        $Evenement = new Evenements();
        $form = $this->createForm(EvenementType::class, $Evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $selectedCountry = $form->get('lieux_evenement')->getData();
            $selectedCountryName = Countries::getName($selectedCountry);
    
    
            // Set the selected country name on the entity
            $Evenement->setLieuxEvenement($selectedCountryName);

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



        $transport = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
        $transport->setUsername('omar.saya@esprit.tn');
        $transport->setPassword('201JMT3526');
        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message());
            $message->setSubject('Vérification de compte');
            $message->setFrom(['isitappofficial@gmail.com' => 'IsItApp']);
            //$message->setTo($user->getEmail());
            $message->setTo('omarsaya99@gmail.com');
            $message->setBody(
                $this->renderView(
                    'evenement/verification_email.html.twig',
                    [
                        
                        'evenement'=> $Evenement -> getTitreEvenement(),
                        'date'=> $Evenement -> getDateEvenement(),
                        'prix'=> $Evenement -> getPrixEvenement(),

                        
                        
                    ]
                ),
                'text/html'
            );

            $mailer->send($message);

            $this->addFlash('success', 'Email sent to confirme the Update ');



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




