<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\VisiteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of VoyagesController
 *
 * @author Julien
 */
class VoyagesController extends AbstractController {

    #[Route('/voyages', name: 'voyages')]
    public function index(): Response {
        $visites = $this->repository->findAll();
        return $this->render("pages/voyages.html.twig", ['visites' => $visites]);
    }

    /**
     * 
     * @var type
     */
    private VisiteRepository $repository;

    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;
    }
}
