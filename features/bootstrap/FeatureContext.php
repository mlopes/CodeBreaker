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
    private $formatter;
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
        $this->codeBreaker =  new NumberCodeBreaker();
        $this->formatter = new ColourFormatter();
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
     * @Then I should get the output :expectedResult in :color
     */
    public function iShouldGetTheOutputInColor($expectedResult, $color)
    {
        $output = $this->formatter->format($this->guessResult);
        $expectedOutput = $this->possibleOutputsForColor($color, $expectedResult);

        if (!in_array($output, $expectedOutput)) {
            throw new RuntimeException("Expected " . implode($expectedOutput, " or ") . " but got: $output");
        }
    }

    private function possibleOutputsForColor($color, $expectedResult)
    {
        $expectedOutput[] = sprintf("\033[01;%sm%s\033[%sm", $this->colors[$color], $expectedResult, $this->colors['off']);

        if(strlen($expectedResult) > 1) {
            $composedOutput = "";
            foreach (str_split($this->guessResult) as $char) {
                $composedOutput .= sprintf("\033[01;%sm%s\033[%sm", $this->colors[$color], $char, $this->colors['off']);
            }

            $expectedOutput[] = $composedOutput;
        }

        return $expectedOutput;
    }
}
