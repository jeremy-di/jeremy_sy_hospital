<?php

namespace App\Controller;

use App\Entity\Transmission;
use App\Form\TransmissionType;
use App\Repository\TransmissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/transmission')]
class TransmissionController extends AbstractController
{
    #[Route('/', name: 'app_transmission_index', methods: ['GET'])]
    public function index(TransmissionRepository $transmissionRepository): Response
    {
        return $this->render('transmission/index.html.twig', [
            'transmissions' => $transmissionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_transmission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $transmission = new Transmission();
        $form = $this->createForm(TransmissionType::class, $transmission);
        $form->handleRequest($request);
        $user = $this->getUser();
        $date = new \Datetime('now');

        if ($form->isSubmitted() && $form->isValid()) {
            $transmission->setStaffMember($user);
            $transmission->setDate($date);
            $entityManager->persist($transmission);
            $entityManager->flush();

            return $this->redirectToRoute('app_transmission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transmission/new.html.twig', [
            'transmission' => $transmission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transmission_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transmission $transmission, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TransmissionType::class, $transmission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_transmission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transmission/edit.html.twig', [
            'transmission' => $transmission,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transmission_delete', methods: ['POST'])]
    public function delete(Request $request, Transmission $transmission, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transmission->getId(), $request->request->get('_token'))) {
            $entityManager->remove($transmission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_transmission_index', [], Response::HTTP_SEE_OTHER);
    }
}
