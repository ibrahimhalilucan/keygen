<?php

namespace Ibrahimhalilucan\Keygen\Factory;

use Ibrahimhalilucan\Keygen\Exceptions\InvalidArgumentException;
use Ibrahimhalilucan\Keygen\Keygen;

class GeneratorFactory
{
    /**
     * Create a generator instance from the specified type.
     *
     * @param $type
     * @return Keygen
     * @throws InvalidArgumentException
     */
    public static function create($type): Keygen
    {
        $generator = sprintf("\%s", ucfirst($type));

        if (class_exists($generator)) {
            $generator = new $generator;

            if ($generator instanceof Keygen) {
                return $generator;
            }
        }

        throw new InvalidArgumentException('Cannot create unknown generator type.');
    }
}
