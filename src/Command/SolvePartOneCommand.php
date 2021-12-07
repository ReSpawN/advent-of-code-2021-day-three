<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SolvePartOneCommand extends Command
{
    protected static $defaultName = 'solve:part-one';


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sequence = array_filter(explode("\n", file_get_contents('data/input.txt')));

        $columns = $gamma = $epsilon = [];

        foreach($sequence as $binary) {
            foreach(str_split($binary, 1) as $column => $bit) {
                $columns[$column][] = $bit;
            }
        }

        foreach($columns as $column) {
            $counts = array_count_values($column);

            $gamma[] = array_search(max($counts), $counts);
            $epsilon[] = array_search(min($counts), $counts);
        }

        $gamma = bindec(join('', $gamma));
        $epsilon = bindec(join('', $epsilon));

        $output->writeln(sprintf('The power of the submarine is %d (%d gamma, %d epsilon)', $gamma * $epsilon, $gamma, $epsilon));

        return Command::SUCCESS;
    }
}
