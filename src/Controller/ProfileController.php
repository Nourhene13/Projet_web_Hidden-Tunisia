<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangeProfileType;
use App\Form\ChangePasswordType;
use App\Form\ModifierPasswordType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    public function index($id, Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        // Récupère l'utilisateur correspondant à l'ID fourni
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $user1 = $this->getDoctrine()->getRepository(User::class)->find($id);

        // Crée un formulaire pour modifier le mot de passe de l'utilisateur
        $passwordForm = $this->createForm(ChangePasswordType::class, $user);
        $passwordForm->handleRequest($request);
        $ProfileForm = $this->createForm(ChangeProfileType::class, $user);
        $ProfileForm->handleRequest($request);


        // Vérifie si le formulaire a été soumis et est valide
        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $user1->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $passwordForm->get('password')->getData()
                )
            );
            if ($user->getPassword() != $user1->getPassword()) {
                $passwordForm->get('password')->addError(new FormError('Invalid current password'));
            } elseif ($passwordForm->get('nouvel_password')->getData() !== $passwordForm->get('confirm_password')->getData()) {
                $passwordForm->get('confirm_password')->addError(new FormError('Passwords do not match'));
            } else {
                // Met à jour le mot de passe de l'utilisateur en utilisant le UserPasswordHasherInterface
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $passwordForm->get('nouvel_password')->getData()
                    )
                );

                // Persiste les modifications de l'utilisateur dans la base de données
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                // Ajoute un message flash pour informer l'utilisateur que les modifications ont été effectuées avec succès
                $this->addFlash('notice', 'Modification effectuée avec succès !');

                // Redirige l'utilisateur vers la page de réservations
                return $this->redirectToRoute('home');
            }
        }
        if ($ProfileForm->isSubmitted() && $ProfileForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        // Affiche la page de profil de l'utilisateur avec le formulaire de modification de mot de passe
        return $this->render('profile/index.html.twig', [
            'lst' => $user,
            'PasswordForm' => $passwordForm->createView(),
            'ProfileForm' => $ProfileForm->createView()
        ]);
    }

    #[Route('/afficheruser', name: 'afficher_user')]
    public function afficherUser(): Response
    {
        $data = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('profile/affichageUserBack.html.twig', [
            'list' => $data
        ]);
    }

    #[Route('/updateuser/{id}', name: 'update_user')]
    public function update(Request $request, $id): Response
    {
        $crud = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(ChangeProfileType::class, $crud);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crud);
            $em->flush();
            $this->addFlash('notice', 'update successfuly!!');
            return $this->redirectToRoute('afficher_user');
        }
        return $this->render('profile/updateBack.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/deleteuser/{id}', name: 'delete_user')]
    public function delete($id): Response
    {
        $data = $this->getDoctrine()->getRepository(User::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice', 'Deleted successfuly!!');
        return $this->redirectToRoute('afficher_user');
    }
    #[Route('/blockuser/{id}', name: 'block_user')]
    public function blockUser(Request $request, $id): Response
    {
        $data = $this->getDoctrine()->getRepository(User::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $data->setIsBlocked(true);
        $em->persist($data);
        $em->flush();
        $this->addFlash('notice', 'block successfuly!!');
        return $this->redirectToRoute('afficher_user');
    }
    #[Route('/deblockuser/{id}', name: 'deblock_user')]
    public function deblockUser(Request $request, $id): Response
    {
        $data = $this->getDoctrine()->getRepository(User::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $data->setIsBlocked(false);
        $em->persist($data);
        $em->flush();
        $this->addFlash('notice', 'deblock successfuly!!');
        return $this->redirectToRoute('afficher_user');
    }
}
