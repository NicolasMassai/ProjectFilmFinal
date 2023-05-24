<?php

namespace App\Controller;

use App\Entity\Abonne;
use App\Form\AbonneType;
use App\Service\Service;
use App\Model\SearchData;
use App\Repository\AbonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbonneController extends AbstractController

{
    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    

    #[Route('/abonne', name: 'app_abonne')]
    //#[IsGranted('ROLE_USER')]
    public function index(AbonneRepository $abonnerepository): Response
    {
       
        $abonnes = $abonnerepository->findAll();

        return $this->render('abonne/index.html.twig', [
            'abonnes' => $abonnes
        ]);
    }

    
    //#[Security("is_granted('ROLE_USER')")]
    #[Route('/abonne/create', name: 'app_abonne_create')]
    public function create(Request $request): Response
    {
        $abonne = new Abonne();
        $form = $this->createForm(AbonneType::class, $abonne);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($abonne);
            $this->em->flush();
            return $this->redirectToRoute('app_abonne');
        }

        return $this->render('abonne/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
