<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Question\Question;

class HelloyouCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('helloyou')
            ->setDescription('Hello PhpStorm')
            ->setHelp('🖕')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Gimme your name biatch');
        $name = $helper->ask($input, $output, $question);

        $output->writeln([
            'Helloyou',
            '============',
            '',
            'Hey ! '. $name
        ]);
    }
}
