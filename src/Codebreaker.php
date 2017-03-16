<?php

interface Codebreaker
{
    /**
     * @param string $secret
     */
    function setSecret($secret);

    /**
     * @param string $guess
     *
     * @return string $result
     */
    function takeGuess($guess);
}