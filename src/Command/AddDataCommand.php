<?php

namespace App\Command;

use App\Entity\Batiment;
use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


#[AsCommand(
    name: 'app:add-data',
    description: 'Add a short description for your command',
)]
class AddDataCommand extends Command
{

    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $personne = new Personne();
        $personne->setNom('Doe');
        $personne->setPrenom('John');

        $batiment = new Batiment();
        $batiment->setNumero('A001');
        $personne->addBatiment($batiment);

        $this->entityManager->persist($personne);
        $this->entityManager->persist($batiment);
        $this->entityManager->flush();

        //On affiche un message pour confirmer l'ajout des données
        $io->success('Données ajoutées avec succès');
        
        return Command::SUCCESS;
    }
}
