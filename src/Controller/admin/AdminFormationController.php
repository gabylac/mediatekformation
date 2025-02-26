<?php

namespace App\Controller\admin;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Description of AdminFormationController
 *
 * @author Moi
 */
class AdminFormationController extends AbstractController{
    #[Route('/admin', name: 'admin.formations')]
    public function index(): Response {
        $formations= $this->repository->findAllOrderBy('title', 'DESC', null);
        return $this->render("admin/admin.formations.html.twig", ['formations' => $formations]);
    }
    
    private $repository;
    
    public function __construct(FormationRepository $repository) {
        $this->repository = $repository;
    }
    
    #[Route('admin/suppr/{id}', name: 'admin.formations.suppr')]
    public function suppr($id): Response {
        $formation = $this->repository->find($id);
        $this->repository->remove($formation);
        return $this->redirectToRoute('admin.formations');
    }
    
    #[Route('admin/ajout', name: 'admin.formation.ajout')]
    public function ajout(Request $request): Response {
        $formation = new Formation();
        $formFormation = $this->createForm(FormationType::class, $formation);
        
        $formFormation->handleRequest($request);
        if($formFormation->isSubmitted() && $formFormation->isValid()){
            $this->repository->add($formation);
            return $this->redirectToRoute('admin.formations');
        }        
        return $this->render("admin/admin.formation.ajout.html.twig", ['formation' => $formation, 
            'formformation' => $formFormation->createView()]);
    }
    
    #[Route('admin/edit/{id}', name: 'admin.formation.edit')]
    public function edit(int $id, Request $request): Response{
        $formation = $this->repository->find($id);
        $formFormation = $this->createForm(FormationType::class, $formation);
        
        $formFormation->handleRequest($request);
        if($formFormation->isSubmitted() && $formFormation->isValid()){
            $this->repository->add($formation);
            return $this->redirectToRoute('admin.formations');
        }        
        return $this->render("admin/admin.formation.editer.html.twig", ['formation' => $formation, 
            'formformation' => $formFormation->createView()]);
    }    
    
}
