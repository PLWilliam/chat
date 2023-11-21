<?php

namespace App\Controller;

use App\Form\MyPrivateMessageType;
use App\Repository\UserRepository;
use App\Repository\FriendsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MyPrivateMessageController extends AbstractController
{
    #[Route('/my/private/message', name: 'app_my_private_message')]
    public function index(Request $request, FriendsRepository $friendsRepository, UserRepository $userRepository): Response
    {
        $actualUser = $this->getUser();

        $query = $friendsRepository->createQueryBuilder('f')
        ->where('f.friend1 = :uid')
        ->orWhere('f.friend2 = :fid')
        ->andWhere('f.privateMessage is not NULL')
        ->setParameter('uid', $actualUser)
        ->setParameter('fid', $actualUser)
        ->getQuery()
        ->getResult();

        // dd($query);

        $MPList = [];

        foreach ($query as $key => $value) {
            if($value->getFriend1() == $actualUser){
                array_push($MPList,$value->getFriend2()->getName());
            }
            else{
                array_push($MPList,$value->getFriend1()->getName());
            } 
        }
        
        $form = $this->createForm(MyPrivateMessageType::class,['MPList'=>$MPList]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // dd($form->getData());
            $friendName = $form->getData()['name']; 
            $friendId = $userRepository->findOneBy(['name'=>$friendName]);

            $MP = $friendsRepository->findOneBy(['friend1'=>$actualUser,'friend2'=>$friendId]);
            if(!$MP){
                $MP = $friendsRepository->findOneBy(['friend1'=>$friendId,'friend2'=>$actualUser]);
            }

            // dd($MP->getPrivateMessage());

            return $this->redirectToRoute('app_private_message', ['id'=>$MP->getPrivateMessage()], Response::HTTP_SEE_OTHER);
        }


        return $this->render('my_private_message/index.html.twig', [
            'form' => $form
        ]);
    }
}
