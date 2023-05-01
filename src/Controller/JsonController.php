<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class JsonController extends AbstractController 
{
#[Route('/afficherJsonEvenement', name: 'jsonEvenement')]
public function getEvenements(): JsonResponse
{
    $evenements = $this->getDoctrine()->getRepository(Evenements::class)->findAll();
    
    $data = [];
    foreach ($evenements as $evenement) {
        $data[] = [
            'id' => $evenement->getId(),
            'titre_evenement' => $evenement->getTitreEvenement(),
            'type_evenement' => $evenement->getTypeEvenement(),
            'date_evenement' => $evenement->getDateEvenement()->format('Y-m-d'),
            'lieux_evenement' => $evenement->getLieuxEvenement(),
            'prix_evenement' => $evenement->getPrixEvenement(),
            'description_evenement' => $evenement->getDescriptionEvenement(),
            'image' => $evenement->getImage(),
            'utilisateur_id' => $evenement->getUtilisateur()->getId(),
        ];
    }
    
    return new JsonResponse($data);
}


#[Route('/ajouterJsonEvenement', name: 'ajouter_evenement')]
public function ajouterEvenement(Request $request): JsonResponse
{
    $entityManager = $this->getDoctrine()->getManager();

    $evenement = new Evenements();
    $evenement->setTitreEvenement($request->request->get('titre_evenement'));
    $evenement->setTypeEvenement($request->request->get('type_evenement'));
    $evenement->setDateEvenement(new \DateTime($request->request->get('date_evenement')));
    $evenement->setLieuxEvenement($request->request->get('lieux_evenement'));
    $evenement->setPrixEvenement($request->request->get('prix_evenement'));
    $evenement->setDescriptionEvenement($request->request->get('description_evenement'));
    $evenement->setImage($request->request->get('image'));

    $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($request->request->get('utilisateur_id'));
    $evenement->setUtilisateur($utilisateur);

    $entityManager->persist($evenement);
    $entityManager->flush();

    return new JsonResponse(['message' => 'Evenement ajouté avec succès']);
}




}
