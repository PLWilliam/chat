<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use App\Entity\PrivateMessage;
use App\Form\PrivateMessageType;
use App\Repository\FriendsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrivateMessageController extends AbstractController
{
    #[Route('/private/message/{id}', name: 'app_private_message')]
    public function index(Request $request, EntityManagerInterface $entityManager, Connection $connection, FriendsRepository $friendsRepository, $id): Response
    {
        $actualUser = $this->getUser();
        $idRepo = $friendsRepository->findOneBy(['privateMessage'=>$id]);
        $receiver = $idRepo->getFriend2();
        if($receiver == $actualUser){
            $receiver = $idRepo->getFriend1();
        }
        // dd($actualUser);


        if(($actualUser !== $idRepo->getFriend1() && $actualUser !== $idRepo->getFriend2()) || $idRepo == null){
            return $this->redirectToRoute('app_my_private_message', [], Response::HTTP_SEE_OTHER);
        }

        $tableName = $idRepo->getPrivateMessage();

        // Requête SQL de sélection pour récupérer toutes les données de la table
        $query = sprintf('SELECT * FROM %s', $tableName);

        // Exécution de la requête et récupération des résultats
        $listMessage = $connection->executeQuery($query)->fetchAllAssociative();

        $form = $this->createForm(PrivateMessageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message = $form->getData()->getMessage();

            $data = [
                'user1_id' => $actualUser->getId(),
                'user2_id' => $receiver->getId(),
                'message' => $message
            ];
    
            // Construction de la requête d'insertion
            $queryBuilder = $connection->createQueryBuilder();
            $queryBuilder->insert($tableName);
    
            foreach ($data as $key => $value) {
                $queryBuilder->setValue($key, $queryBuilder->createNamedParameter($value));
            }
            $queryBuilder->executeQuery();

            return $this->redirectToRoute('app_private_message', ['id'=>$id], Response::HTTP_SEE_OTHER);
        }


        return $this->render('private_message/index.html.twig', [
            'listMessage' => $listMessage,
            'actualUser' => $actualUser,
            'otherUser' => $receiver,
            'form' => $form
        ]);
    }
}
