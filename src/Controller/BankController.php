<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Form\BankType;
use App\Repository\AbonneRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BankController extends AbstractController
{
    private EntityManagerInterface $em;
    private UserRepository $userRepository;

    
    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }
    
    #[Route('/bank/create', name: 'app_bank')]
    public function index(Request $request): Response
    {/*
        $bank = new Bank();
        $form = $this->createForm(BankType::class, $bank);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->em->persist($bank);
            $this->em->flush();
            return $this->redirectToRoute('app_film');
        }

        return $this->render('bank/create.html.twig', [
            'form' => $form->createView()
        ]);
        */
        
        
        $user = $this->userRepository->find($this->getUser());
        $account = $user->getBank()->getAccount();
        $user->getBank()->setAccount('0');
        $form = $this->createForm(BankType::class, $user->getBank());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
                $user->getBank()->setAccount($user->getBank()->getAccount() + $account);
                $this->em->persist($user);
                $this->em->flush();

                return $this->redirectToRoute('app_home');
        }
        return $this->render('bank/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
