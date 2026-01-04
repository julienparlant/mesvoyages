<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\VisiteRepository;
use App\Entity\Visite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminVoyagesController
 *
 * @author Julien
 */
class AdminVoyagesController extends AbstractController {

    private VisiteRepository $repository;

    #[Route('/admin', name: 'admin.voyages')]
    public function index(): Response {
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("admin/admin.voyages.html.twig", [
                    'visites' => $visites
        ]);
    }

    #[Route('/admin/suppr/{id}', name: 'admin.voyage.suppr')]
    public function suppr(int $id): Response {
        $visite = $this->repository->find($id);

        if (!$visite) {
            throw $this->createNotFoundException('Visite introuvable');
        }

        $this->repository->remove($visite);

        return $this->redirectToRoute('admin.voyages');
    }

    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;
    }
}
