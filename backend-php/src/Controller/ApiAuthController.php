<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
final class ApiAuthController extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(
        Request $request,
        UserRepository $users,
        UserPasswordHasherInterface $hasher,
        Security $security
    ): JsonResponse {
        $data = json_decode($request->getContent(), true) ?? [];
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $user = $users->findOneBy(['email' => $email]);
        if (!$user || !$hasher->isPasswordValid($user, $password)) {
            return $this->json(['error' => 'Identifiants invalides'], 401);
        }

        $security->login($user,null, 'main');  // ouvre la session
        return $this->json(['ok' => true, 'user' => $user->getUserIdentifier()]);
    }
}