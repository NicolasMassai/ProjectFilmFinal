<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use App\Service\Service;
use App\Entity\Producteur;
use App\Repository\FilmRepository;
use App\Repository\ProducteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmController extends AbstractController
{
    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/film', name: 'app_film')]
    public function index(FilmRepository $filmrepository): Response
    {
        $films = $filmrepository->findAll();
        

        return $this->render('film/index.html.twig', [
            'films' => $films,
        ]);
    }
    #[Route('/film/find/{film}', name: 'app_film_id')]
    public function getId(Film $film, FilmRepository $filmrepository, ProducteurRepository $producteurrepository): Response
    {

        $id = $film->getId();
        $id2 = $film->getProducteur();

        $film = $filmrepository->requete($id);

        $prod = $producteurrepository->find($id2);



        return $this->render('film/getId.html.twig', [
            'films' => $film,
            'prod' => $prod
        ]);
    }

    #[Route('/film/create', name: 'app_film_create')]
    public function create(Service $myService, Request $request): Response

    {
        $form = $myService->create($request, new Film, new FilmType, new ByteString('film'), new ByteString('film'));

        return $form;
    }



    #[Route('/film/update/{film}', name: 'app_film_update')]
    public function update(Film $film, Request $request): Response
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($film);
            $this->em->flush();
            return $this->redirectToRoute('app_film');
        }
        return $this->render('film/create.html.twig', [
            'form' => $form->createView()
        ]);

   }

   #[Route('/film/menu', name: 'app_film_menu')]
   public function menu(): Response
   {

       return $this->render('film/menu.html.twig', [
       ]);
   }

   #[Route('/film/action', name: 'app_film_action')]
   public function genre(FilmRepository $filmrepository): Response
   {

    $film = $filmrepository->requete2('action');       

       return $this->render('film/genre.html.twig', [
           'films' => $film,
       ]);
   }

   #[Route('/film/comedie', name: 'app_film_comedie')]
   public function genre2(FilmRepository $filmrepository): Response
   {

    $film = $filmrepository->requete2('comedie');       

    return $this->render('film/genre.html.twig', [
        'films' => $film,
       ]);
   }

   #[Route('/film/sf', name: 'app_film_sf')]
   public function genre3(FilmRepository $filmrepository): Response
   {

    $film = $filmrepository->requete2('science-fiction');       

    return $this->render('film/genre.html.twig', [
        'films' => $film,
       ]);
   }

   #[Route('/film/thriller', name: 'app_film_thriller')]
   public function genre4(FilmRepository $filmrepository): Response
   {

    $film = $filmrepository->requete2('thriller');       

    return $this->render('film/genre.html.twig', [
        'films' => $film,
       ]);
   }

  /* #[Route('/film/classement', name: 'app_film_classement')]
   public function classement(FilmRepository $filmrepository): Response
   {

    $film = $filmrepository->requete3();       

    return $this->render('film/classement.html.twig', [
        'films' => $film,
       ]);
   }
*/
}
