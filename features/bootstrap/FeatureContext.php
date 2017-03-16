<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $result;


    private $colors = [
        'red' => 31,
        'green' => 32,
        'yellow' => 33,
        'off' => 0
    ];

    private $codeBreaker;
    private $printer;
    private $guessResult;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->codeBreaker =  new <your code breaker here>;
        $this->printer = new <your printer class here>;

        if (!$this->codeBreaker instanceOff 'CodeBreaker') {
            throw new RuntimeException("Codebreaker must implement CodeBreaker interface");
        }

        if (!$this->codeBreaker instanceOff 'CodeBreakerPrinter') {
            throw new RuntimeException("The Printer must implement CodeBreakerPrinter interface");
        }
    }

    /**
     * @Given the secret is set to :secret
     */
    public function theSecretIsSetTo($secret)
    {
        $this->codeBreaker->setSecret($secret);
    }

    /**
     * @When I take the guess :guess
     */
    public function iTakeTheGuess($guess)
    {
        $this->guessResult = $this->codeBreaker->takeGuess($guess);
    }

    /**
     * @Then I should get the output :output in :color
     */
    public function iShouldGetTheOutputInColor($output, $color)
    {
        $this->assertColorAndEquals($color, $output, $this->guessResult);
    }

    /**
     * @param $output
     */
    private function assertColorAndEquals($color, $output, $result)
    {
        if ($this->colors[$color] . $output !== $result) {
            throw new RuntimeException(sprintf(
                "Expected \e[%sm%s\e[%sm but got: \e[%sm%s\e[%sm",
                $this->colors[$color], $output, $this->colors['red'],
                $this->colors['off'], $result, $this->colors['red']
            ));
        }
    }
}
