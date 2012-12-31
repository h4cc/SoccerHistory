<?php

namespace Sweepo\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Buzz\Browser as Buzz;

class TeamCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('register:team')
            ->setDescription('Save a team')
            ->addArgument('url', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');

        $buzz = $this->getContainer()->get('buzz');
        $response = $buzz->get('http://stats.betradar.com/s4/?clientid=25&language=fr#2_1,3_30,22_1,5_4792,9_summary');

        die(var_dump($response->getContent()));

        $output->writeln($text);
    }
}