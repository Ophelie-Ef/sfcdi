<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(
        LivreRepository $livreRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {

        $livres = $paginator->paginate(
            $livreRepository->findBy([], ['id' => 'DESC']),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('home/index.html.twig', [
            'livres' => $livreRepository->findAll(),
            'livres' => $livres,
        ]);
    }

    // #[Route('/secret', name: 'app_home_access')]
    // #[IsGranted('')]
}


// #[Route('/', name: 'app_livre_index', methods: ['GET'])]
// public function index(
//     LivreRepository $livreRepository,
//     PaginatorInterface $paginator,
//     Request $request
// ): Response {

//     $livres = $paginator->paginate(
//         $livreRepository->findBy([], ['id' => 'DESC']),
//         $request->query->getInt('page', 1),
//         10
//     );

//     return $this->render('livre/index.html.twig', [
//         'livres' => $livreRepository->findAll(),
//         'livres' => $livres,
//     ]);
// }
