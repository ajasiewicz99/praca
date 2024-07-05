<?php

namespace App\Module\User\App\Controller;

use App\Module\User\Domain\Entity\User;
use App\Module\User\Infrastructure\Messenger\RegisterUserCommand;
use App\Module\User\Infrastructure\Messenger\SendEmailMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus, private UserPasswordHasherInterface $passwordHasher)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): Response
    {
        // Odczytaj dane z formularza (np. email i hasło)
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $user = new User($email, $password, ['ROLE_USER']);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);

        $this->messageBus->dispatch(new RegisterUserCommand($email, $hashedPassword));
        $this->messageBus->dispatch(new SendEmailMessage($email, 'Welcome!', 'You have been registered!'));

        return $this->render('security/registered.html.twig');
    }

    #[Route('/register', name: 'register_get', methods: ['GET'])]
    public function registerPage(): Response
    {
        return $this->render('security/register.html.twig');
    }
}
