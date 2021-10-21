<?php

namespace App\Controller;

use App\Entity\Loisir;
use App\Entity\Project;
use App\Form\LoisirType;
use App\Form\ProjectType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $users = $userRepository->findAll();

        $loisir = new Loisir();
        $form = $this->createForm(LoisirType::class, $loisir);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($loisir);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'users'=> $users,
            'form' => $form->createView(),
        ]);
    }

}
