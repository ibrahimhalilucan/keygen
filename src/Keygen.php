<?php

namespace IbrahimHalilUcan\Keygen;

use IbrahimHalilUcan\Keygen\Exceptions\InvalidArgumentException;
use IbrahimHalilUcan\Keygen\Factory\GeneratorFactory;
use IbrahimHalilUcan\Keygen\Generators\Alphabet;
use IbrahimHalilUcan\Keygen\Generators\FloatType;
use IbrahimHalilUcan\Keygen\Generators\Numeric;
use IbrahimHalilUcan\Keygen\Generators\SerialNumber;
use IbrahimHalilUcan\Keygen\Generators\Token;

class Keygen extends AbstractGenerator
{
    /**
     * Creates a new generator instance of the given type.
     *
     * @param $type
     * @return Keygen
     * @throws InvalidArgumentException
     */
    protected function newGenerator($type): Keygen
    {
        return GeneratorFactory::create($type);
    }

    /**
     * Creates a new generator instance from the given alias.
     *
     * @param $alias
     * @return Keygen|void
     * @throws InvalidArgumentException
     */
    protected function generatorFromAlias($alias)
    {
        $generatorAliases = [
            'alphabet' => Alphabet::class,
            'numeric'  => Numeric::class,
            'float'    => FloatType::class,
            'serial'   => SerialNumber::class,
            'token'    => Token::class,
        ];

        if (array_key_exists($alias, $generatorAliases)) {
            return $this->newGenerator($generatorAliases[$alias]);
        }
    }

    /**
     * @param $method
     * @param $args
     * @return Keygen|void
     * @throws InvalidArgumentException
     */
    public function __call($method, $args)
    {
        $generator = $this->generatorFromAlias(strtolower($method));
        if ($generator instanceof Keygen) {
            return $generator;
        }
    }

}
