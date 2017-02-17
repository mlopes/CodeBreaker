# CodeBreaker
Composer configuration and executable for quickly starting a PHPSpec based TDD code kata for the Code Breaker game

## Usage

[Install composer](https://getcomposer.org/download/)

$ `git clone  git@github.com:mlopes/CodeBreaker.git`

$ `cd CodeBreaker`

$ `composer.phar install`

$ `bin/phpspec desc YourClass`

$ `bin/phpspec run`

Make sure that your code breaker class implements `CodeBreaker`

## Plugging it in

Edit `bin/codebreakerGame` and replace ` <your code breaker here>` with your code breaker class name.

run `bin/codebreakerGame`, and try to guess the right number.