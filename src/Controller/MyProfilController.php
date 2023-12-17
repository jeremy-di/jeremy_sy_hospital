<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\MyProfilType;
use App\Repository\UserRepository;
use App\Form\MyProfilResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MyProfilController extends AbstractController
{
    #[Route('/my_profil', name: 'app_my_profil')]
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_MED") or is_granted("ROLE_INF")'))]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy([
            'id' => $this->getUser()
        ]);
        return $this->render('my_profil/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }

    #[Route('/my_profil/{id}/edit', name:"app_my_profil_edit", methods: ['GET', 'POST'])]
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_MED") or is_granted("ROLE_INF")'))]
    public function edit(Request $request, User $user, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MyProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_my_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('my_profil/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/my_profil/reset_password/{id}', name:'app_my_profil_reset_password', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_MED") or is_granted("ROLE_INF")'))]
    public function reset(Request $request, User $user, UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(MyProfilResetPasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
    
                $entityManager->flush();
                


            return $this->redirectToRoute('app_my_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('my_profil/editPassword.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
