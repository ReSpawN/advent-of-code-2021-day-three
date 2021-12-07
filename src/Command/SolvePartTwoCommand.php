<?php

namespace App\Command;

use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SolvePartTwoCommand extends Command
{
    protected static $defaultName = 'solve:part-two';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sequence = array_filter(explode("\n", file_get_contents('data/input.txt')));

        $oxygen = bindec(self::sequenceBy($sequence, 1));
        $co2 = bindec(self::sequenceBy($sequence, 0));

        $output->writeln(sprintf('The life support rating is %d (%d oxygen, %d CO2)', $oxygen * $co2, $oxygen, $co2));

        return Command::SUCCESS;
    }

    private static function sequenceBy(array $sequence, int $minOrMax): string
    {
        $index = 0;
        $maxIndex = count($sequence);

        do {
            $columns = self::binarySequenceToColumns($sequence);
            $columnCounts = self::countCharactersPerColumn($columns);

            if (empty($columnCounts[$index]))
                break;

            $maxCharacterOccurrence = max($columnCounts[$index]);
            $minCharacterOccurrence = min($columnCounts[$index]);

            if ($maxCharacterOccurrence === $minCharacterOccurrence)
                $query = $minOrMax;

            else $query = array_search(!!$minOrMax ? $maxCharacterOccurrence : $minCharacterOccurrence, $columnCounts[$index]);

            $sequence = self::getBinariesByIndexFromSequence($query, $index, $sequence);

            $index++;

            if ($index > $maxIndex)
                throw new RuntimeException('Something has gone terribly wrong.');
        } while (count($sequence) > 1);

        return reset($sequence);
    }

    private static function binarySequenceToColumns(array $sequence): array
    {
        $columns = [];

        foreach ($sequence as $binary) {
            foreach (str_split($binary, 1) as $column => $bit) {
                $columns[$column][] = $bit;
            }
        }

        return $columns;
    }

    private static function countCharactersPerColumn(array $columns): array
    {
        return array_map(function (array $column): array {
            $result = [0, 0];
            $counts = array_count_values($column);

            foreach ($counts as $bit => $count) {
                $result[$bit] = $count;
            }

            return $result;
        }, $columns);
    }

    private static function getBinariesByIndexFromSequence(int $max, int $index, array $sequence): array
    {
        return array_values(array_filter($sequence, fn($binary): bool => (int)substr($binary, $index, 1) === $max));
    }
}
