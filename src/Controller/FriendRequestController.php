<?php

namespace App\Controller;

use App\Entity\Friends;
use App\Repository\FriendsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FriendRequestStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FriendRequestController extends AbstractController
{
    #[Route('/friend/request', name: 'app_friend_request')]
    public function index(FriendsRepository $friendsRepository, FriendRequestStatusRepository $FRSRepo): Response
    {
        $FRS = $FRSRepo->findBy(['status'=>'Waiting']);
        $requestList = $friendsRepository->findBy(['friendsRequest'=>$FRS]);

        return $this->render('friend_request/index.html.twig', [
            'requestList'=>$requestList
        ]);
    }

    #[Route('/{id}/accept', name: 'app_friend_request_accept', methods: ['POST'])]
    public function accept(Friends $friends, FriendRequestStatusRepository $FRSrepo, EntityManagerInterface $entityManager): Response
    {
        $FRS = $FRSrepo->findOneBy(['status'=>'Accepted']);
        $friends->setFriendsRequest($FRS);
        $entityManager->flush();

        return $this->redirectToRoute('app_friend_request', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/deny', name: 'app_friend_request_deny', methods: ['POST'])]
    public function deny(Friends $friends, FriendRequestStatusRepository $FRSrepo, EntityManagerInterface $entityManager): Response
    {
        $FRS = $FRSrepo->findOneBy(['status'=>'Denied']);
        $friends->setFriendsRequest($FRS);
        $entityManager->flush();

        return $this->redirectToRoute('app_friend_request', [], Response::HTTP_SEE_OTHER);
    }
}
