<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use AppBundle\Util\StringGenerator;
use AppBundle\Service\StreamSamplerService;

class StreamSamplerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:stream-sampler')
            ->setDescription('Generate a sample from a stream')
            ->addArgument('length', InputArgument::REQUIRED, 'Length of the sample?')
            ->addArgument('stream', InputArgument::OPTIONAL, 'Stream from which to extract the sample?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $length = $input->getArgument('length');
        if ($length > 0) {

            $stream = $input->getArgument('stream');
            if (empty($stream)) {
                $stream = $this->getRandomString($length);
            }

            $output->writeln(
                '<comment>Generates a random sample ' .
                $length .
                ' characters long from a given stream</comment>'
            );

            try {
                /** @var StreamSamplerService StreamSamplerService */
                $streamSamplerService = $this->getContainer()
                    ->get('app.stream.sampler.service');

                $output->writeln(
                    '<info>The sample is ' .
                    $streamSamplerService->getSample($stream, $length) .
                    ' </info>'
                );
            } catch (\Exception $e) {
                $output->writeln('<error>Error: ' . $e->getMessage() . '</error>');
            }
        } else {
            $output->writeln('<error>Error: Invalid length value</error>');
        }
    }
    
    /**
     *
     * @return array
     */
    private function getRandomString($length)
    {
        /** @var StringGenerator $stringGenerator */
        $stringGenerator = $this->getContainer()
            ->get('app.random.string.generator');

        return $stringGenerator->getRandomString($length);
    }
}
