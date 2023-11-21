<?php

namespace App\Controller;

use App\Entity\Friends;
use App\Entity\PrivateMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\Tools\SchemaTool;
use App\Form\NewPrivateMessageType;
use App\Repository\FriendsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewPrivateMessageController extends AbstractController
{
    #[Route('/new/private/message', name: 'app_new_private_message')]
    public function index(Request $request, EntityManagerInterface $entityManager, FriendsRepository $friendsRepository, UserRepository $userRepository): Response
    {
        $actualUser = $this->getUser();
        
        $query = $friendsRepository->createQueryBuilder('f')
        ->join('f.friendsRequest', 'r')
        ->where('f.friend1 = :uid')
        ->orWhere('f.friend2 = :fid')
        ->andWhere('f.privateMessage is NULL')
        ->andWhere('r.status = :rid')
        ->setParameter('uid', $actualUser)
        ->setParameter('fid', $actualUser)
        ->setParameter('rid', 'Accepted')
        ->getQuery()
        ->getResult();

        // dd($query);

        $friendList = [];

        foreach ($query as $key => $value) {
            if($value->getFriend1() == $actualUser){
                array_push($friendList,$value->getFriend2()->getName());
            }
            else{
                array_push($friendList,$value->getFriend1()->getName());
            } 
        }
        
        $form = $this->createForm(NewPrivateMessageType::class,['friendList'=>$friendList]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $friendName = $form->getData()['name']; 
            $friendId = $userRepository->findOneBy(['name'=>$friendName]);
            // dd($friendId);

            $tableName = '_'.$actualUser->getName().$friendName;
            // dd($tableName);

            $tableList = $entityManager->getConnection()->getSchemaManager()->listTables();
            $tableExist = false;

            foreach ($tableList as $key => $value) {

                // dd('private_message'.$tableName);
                // dd($value->getName());
                if($value->getName() == 'private_message'.$tableName){
                    $tableExist = true;
                    dd('existe déja');
                }
            }

            if(!$tableExist){
                /** @var ClassMetadata $metadata */
                $metadata = $entityManager->getClassMetadata(PrivateMessage::class);
                // dd($metadata);
                $metadata->setPrimaryTable(array('name' => $metadata->getTableName() . $tableName));
            
                $schemaTool = new SchemaTool($entityManager);
                $schemaTool->createSchema(array($metadata));  
                
                $repo = $friendsRepository->findOneBy(['friend1'=>$actualUser,'friend2'=>$friendId]);
                if(!$repo){
                    $repo = $friendsRepository->findOneBy(['friend1'=>$friendId,'friend2'=>$actualUser]);
                }
                $repo->setPrivateMessage('private_message'.$tableName);
                $entityManager->flush();

            }



            return $this->redirectToRoute('app_global_message_index', [], Response::HTTP_SEE_OTHER);
        }

    


        return $this->render('new_private_message/index.html.twig', [
            'form' => $form
        ]);
    }
}
