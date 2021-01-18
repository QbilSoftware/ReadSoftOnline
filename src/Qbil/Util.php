<?php

namespace Qbil\ReadSoftOnline;

class Util
{
    public static function extract(array $property, $key, $subKey = 'Text')
    {
        $key  = array_search($key, array_column($property, 'Type'));
        if (false === $key) {
            return null;
        }

        return $property[$key][$subKey];
    }
}
