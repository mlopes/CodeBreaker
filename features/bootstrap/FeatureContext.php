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
        'cyan' => 36,
        'green' => 32,
        'magenta' => 35,
        'red' => 31,
        'off' => 0
    ];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given the secret is set to :secret
     */
    public function theSecretIsSetTo($secret)
    {
        throw new PendingException();
    }

    /**
     * @When I take the guess :guess
     */
    public function iTakeTheGuess($guess)
    {
        throw new PendingException();
    }

    /**
     * @Then I should get the output :output in :color
     */
    public function iShouldGetTheOutputInColor($output, $color)
    {
        $result = '+';
        $this->assertColorAndEquals($color, $output, $result);
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
