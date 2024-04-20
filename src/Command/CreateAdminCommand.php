<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'osso:create-admin',description: 'Create the admin user of the OSSO Website'
)]
class CreateAdminCommand extends Command
{
    public function __construct(private readonly UserRepository $userRepository,
    private readonly UserPasswordHasherInterface $passwordHasher
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the administrator')
            ->addArgument('password', InputArgument::REQUIRED, 'The password')
            ->setHelp('This command allows you to create an admin user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'OSSO Admin User creator',
            '========',
            '',
        ]);
        $io = new SymfonyStyle($input, $output);

        $email = $input->getArgument('email');
        $plainPassword = $input->getArgument('password');

        $user = $this->userRepository->findOneBy(['email' => $email]);
        if ($user) {
            $io->error('The email ' . $email . ' already exists.');
            return Command::FAILURE;
        }

        $user = new User();
        $user->setEmail($email);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $this->userRepository->add($user, true);

        $io->success('A new Osso admin user has been created');

        return Command::SUCCESS;
    }


}
