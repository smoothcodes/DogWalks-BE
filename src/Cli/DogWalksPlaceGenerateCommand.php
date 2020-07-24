<?php

namespace App\Cli;

use App\Entity\Place;
use App\Repository\PlaceRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DogWalksPlaceGenerateCommand extends Command
{
    protected static $defaultName = 'dog-walks:place-generate';
    private $placeRepository;

    public function __construct(PlaceRepository $placeRepository, string $name = null)
    {
        parent::__construct($name);

        $this->placeRepository = $placeRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('latitude', InputArgument::REQUIRED, 'Place latitude')
            ->addArgument('longitude', InputArgument::REQUIRED, 'Place longitude');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $latitude = $input->getArgument('latitude');
        $longitude = $input->getArgument('longitude');

        $place = new Place();
        $place->setName("Test Place")
            ->setDescription('Really nice place with lot of space for fun and small river. My dogs loves this place. Sometimes there are lot of mosquitos here.')
            ->setLatitude($latitude)
            ->setLongitude($longitude);

        $this->placeRepository->save($place);

        return 0;
    }
}
