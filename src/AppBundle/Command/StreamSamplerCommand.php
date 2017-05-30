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
            ->addArgument('length', InputArgument::REQUIRED, 'Length of the sample? (int)')
            ->addArgument('stream', InputArgument::OPTIONAL, 'Stream from which to extract the sample or stream source? (string)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $length = $input->getArgument('length');
        $stream = $input->getArgument('stream');

        if ($length > 0) {
            $output->writeln(
                '<comment>Generates a random sample ' .
                $length .
                ' characters long from a given stream</comment>'
            );

            /** @var StreamSamplerService StreamSamplerService */
            $streamSamplerService = $this->getContainer()
                ->get('app.stream.sampler.service');

            try {
                if ($stream == 'file') {
                    $sample = $streamSamplerService->getSampleFromFile($length);
                } else {
                    if (empty($stream)) {
                        $stream = $this->getRandomString($length);
                    }

                    $sample = $streamSamplerService->getSample($stream, $length);
                }

                $output->writeln(
                    '<info>[The sample is ' .
                    $sample .
                    ']</info>'
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
