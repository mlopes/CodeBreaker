<?php

interface Codebreaker
{
    function setSecret($secret);
    function takeGuess($guess);
}