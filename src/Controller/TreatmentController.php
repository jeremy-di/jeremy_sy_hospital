<?php

namespace App\Controller;

use App\Entity\Treatment;
use App\Form\TreatmentType;
use App\Form\TreatmentNurseType;
use App\Repository\TreatmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/treatment')]
class TreatmentController extends AbstractController
{
    #[Route('/', name: 'app_treatment_index', methods: ['GET'])]
    public function index(TreatmentRepository $treatmentRepository): Response
    {
        return $this->render('treatment/index.html.twig', [
            'treatments' => $treatmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_treatment_new', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_MED")'))]
    public function new(Request $request, EntityManagerInterface $entityManager, TreatmentRepository $treatmentRepository): Response
    {
        $treatment = new Treatment();
        $form = $this->createForm(TreatmentType::class, $treatment);
        $user = $this->getUser();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $treatment->setStaffMember($user);
            $entityManager->persist($treatment);
            $entityManager->flush();

            return $this->redirectToRoute('app_treatment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('treatment/new.html.twig', [
            'treatment' => $treatment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_treatment_edit', methods: ['GET', 'POST'])]
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_MED")'))]
    public function edit(Request $request, Treatment $treatment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TreatmentType::class, $treatment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_treatment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('treatment/edit.html.twig', [
            'treatment' => $treatment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit_nurse', name: 'app_treatment_edit_nurse', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_INF')]
    public function editNurse(Request $request, Treatment $treatment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TreatmentNurseType::class, $treatment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_treatment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nurse/editTreatment.html.twig', [
            'treatment' => $treatment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_treatment_delete', methods: ['POST'])]
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_MED")'))]
    public function delete(Request $request, Treatment $treatment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$treatment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($treatment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_treatment_index', [], Response::HTTP_SEE_OTHER);
    }
}
