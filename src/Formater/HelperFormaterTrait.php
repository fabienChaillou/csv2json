<?php

namespace Formater;

trait HelperFormaterTrait
{
    private $delimiters = [";",",",".","|",":"," "];

    private function explode(string $string): array
    {
        if (preg_match("/(<)|(>)$/", trim($string))) {
            $string = str_replace(["<", ">"], "", $string);
        }

        $ready = str_replace($this->delimiters, $this->delimiters[0], $string);
        $launch = explode($this->delimiters[0], $ready);

        return  $launch;
    }
}
