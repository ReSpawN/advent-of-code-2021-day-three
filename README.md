# Advent of Code 2021
The **Advent of Code**, henceforth AoC, is an Advent calendar of small logical programming puzzles for a variety of skill sets and skill levels that can be solved in any programming language you like. People use them as a speed contest, interview prep, company training, university coursework, practice problems, or to challenge each other.

## Day Three
Parts 1 and part 2 of [day three](https://adventofcode.com/2021/day/3).

### Reflection
#### Approach & Mistakes
I had some trouble getting into the nitty-gritty of the binary stuff and started converting numbers with the wrong method. That put me on the wrong track for a minute until I released it was a relatively simply splitting and columnizing of the data. Once I realised that I abstracted some logic into their own private static methods and continued on with the actual determination of which column I needed to get data from.

The second half of part 2 is basically an invert of the Oxygen Generator's logic. Simply invert with a double boolean cast to get a true/false statement.

#### Improvements
I really need to completely read through the exercise next time in order to avoid the mistake of going about it the wrong way. The word "binary" tripped me up, lol.

### Run
- `php .\console solve:part-one`
- `php .\console solve:part-two`