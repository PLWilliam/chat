<?php

namespace App\Controller;

use App\Entity\Friends;
use App\Form\FriendsType;
use App\Repository\UserRepository;
use App\Repository\FriendsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/friends')]
class FriendsController extends AbstractController
{
    #[Route('/', name: 'app_friends_index', methods: ['GET'])]
    public function index(FriendsRepository $friendsRepository): Response
    {
        return $this->render('friends/index.html.twig', [
            'friends' => $friendsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_friends_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,UserRepository $userRepository, FriendsRepository $friendsRepository): Response
    {
        $friend = new Friends();

        $form = $this->createForm(TextType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $actualUser = $this->getUser();
            $friend->setFriend1($actualUser);
            $data = $form->getData();
            $users = $userRepository->findAll();

            $canBeAdded = true;

            $listActualFriend = $friendsRepository->findBy(['friend1'=>$actualUser]);
            foreach ($listActualFriend as $key => $value) {
                if($data == $value->getFriend2()->getEmail() && $data == $value->getFriend1()->getEmail()){
                    $canBeAdded = false;
                }
            }

            foreach ($users as $key => $user) {
                $otherMail = $user->getEmail();
                if($data == $otherMail && $canBeAdded){
                    $friend->setFriend2($user);  
                    $entityManager->persist($friend);
                    $entityManager->flush(); 
                }        
            }

            return $this->redirectToRoute('app_friends_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('friends/new.html.twig', [
            'friend' => $friend,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_friends_show', methods: ['GET'])]
    public function show(Friends $friend): Response
    {
        return $this->render('friends/show.html.twig', [
            'friend' => $friend,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_friends_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Friends $friend, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FriendsType::class, $friend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_friends_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('friends/edit.html.twig', [
            'friend' => $friend,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_friends_delete', methods: ['POST'])]
    public function delete(Request $request, Friends $friend, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$friend->getId(), $request->request->get('_token'))) {
            $entityManager->remove($friend);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_friends_index', [], Response::HTTP_SEE_OTHER);
    }
}
