<?php

namespace App\Controller;

use App\Entity\GlobalMessage;
use App\Form\GlobalMessageType;
use App\Repository\GlobalMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/global/message')]
class GlobalMessageController extends AbstractController
{
    #[Route('/', name: 'app_global_message_index', methods: ['GET'])]
    public function index(GlobalMessageRepository $globalMessageRepository): Response
    {
        return $this->render('global_message/index.html.twig', [
            'global_messages' => $globalMessageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_global_message_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $globalMessage = new GlobalMessage();
        $form = $this->createForm(GlobalMessageType::class, $globalMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $globalMessage->setSender($user);

            $entityManager->persist($globalMessage);
            $entityManager->flush();

            return $this->redirectToRoute('app_global_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('global_message/new.html.twig', [
            'global_message' => $globalMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_global_message_show', methods: ['GET'])]
    public function show(GlobalMessage $globalMessage): Response
    {
        return $this->render('global_message/show.html.twig', [
            'global_message' => $globalMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_global_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GlobalMessage $globalMessage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GlobalMessageType::class, $globalMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_global_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('global_message/edit.html.twig', [
            'global_message' => $globalMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_global_message_delete', methods: ['POST'])]
    public function delete(Request $request, GlobalMessage $globalMessage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$globalMessage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($globalMessage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_global_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
