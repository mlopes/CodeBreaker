<?php

interface Formatter
{
    /**
     * @param string $result
     *
     * @return string
     */
    public function format($result);
}
