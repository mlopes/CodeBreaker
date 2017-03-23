<?php

interface Codebreaker
{
    /**
     * @param string $secret
     */
    public function setSecret($secret);

    /**
     * @param string $guess
     *
     * @return string
     */
    public function takeGuess($guess);
}
