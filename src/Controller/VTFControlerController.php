<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class VTFControlerController extends AbstractController
{
    #[Route('/vtfcontroler')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $personneRepo = $entityManager->getRepository(Personne::class);

        $personnes = $personneRepo->findAll();

        return $this->render('vtfcontroler/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }
}
