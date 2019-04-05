<?php

namespace Qbil\ReadSoftOnline;

class Util
{
    public static function extract(array $property, $key, $subKey = 'Text')
    {
        return $property[array_search($key, array_column($property, 'Type'))][$subKey];
    }
}
