<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
final class ApiController extends AbstractController
{
    #[Route('/hello', name: 'hello', methods: ['GET'])]
    public function hello(): JsonResponse
    {
        return $this->json(['message' => 'Hello from Symfony API']);
    }

    // Bonus utile pour tester l'auth: retourne l'utilisateur connecté
    #[Route('/me', name: 'me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        $user = $this->getUser();
        return $this->json([
            'authenticated' => (bool) $user,
            'user' => $user ? $user->getUserIdentifier() : null, // email/username
        ]);
    }
}