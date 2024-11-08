[![Build status](https://dev.azure.com/APS-SD-Stewards/APS-SD/_apis/build/status/proscrumdev.battleship-cpp-CI)](https://dev.azure.com/APS-SD-Stewards/APS-SD/_build/latest?definitionId=21)

# Battleship PHP

A simple game of Battleship, written in PHP. The purpose of this repository is to serve as an entry point into coding exercises and it was especially created for scrum.orgs Applying Professional Scrum for Software Development course (www.scrum.org/apssd). The code in this repository is unfinished by design.
Created by Sergey https://github.com/2heoh

# Getting started

This project requires a php7 or higher. To prepare to work with it, pick one of these
options:

## Run locally

Make sure you've cloned repository:
```bash
git clone https://github.com/mraubogmg/battleship-php ${HOME}/battleship
```

Run docker container with composer:
```bash
docker run -it -v ${HOME}/battleship:/battleship -w /battleship composer bash
```

Run battleship with composer.
```bash
composer run game
```

## Execute tests with composer

Install dependencies
```bash
composer update
```

Run tests
```bash
composer run test
```

## Docker

If you don't want to install anything php-related on your system, you can
run the game inside Docker instead.

### Run a Docker Container from the Image

```bash
docker run -it -v ${PWD}:/battleship -w /battleship composer bash
```

# Launching the game

```bash
composer run game
```

with arguments

display all output from game
```bash
composer run game -- --godmode
```

set player ships from preset
```bash
composer run game -- --preset
```

easy mode, display map for playr shots
```bash
composer run game -- --easy
```

autoplay mode
```bash
composer run game -- --autoplay
```

multiple flags
```bash
composer run game -- --godmode --easy --autoplay --preset
```

example of map in godmode

```bash
  1 2 3 4 5 6 7 8
A B . . . . . . .
B B . . . . . P P
C B . . . . . . .
D B . . . . . . .
E . . . . . . . .
F . . S S S . . .
G . . . . . . . .
H . . . . . D D D
```

Where:
- A = Aircraft Carrier
- B = Battleship
- S = Submarine
D = Destroyer
- P = Patrol Boat
- . = Empty water

# Running the Tests

Don't forget to install dependencies ;)
```bash
composer update
```

Run tests:
```
composer run test
```

### Troubleshooting

1. On my ubuntu virtual server on DO I needed to install:
```bash
apt-get install composer php7.2-mbstring php7.2-dom
```
