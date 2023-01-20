<?php

namespace Ibrahimhalilucan\Keygen;

use Ibrahimhalilucan\Keygen\Exceptions\InvalidArgumentException;
use Ibrahimhalilucan\Keygen\Factory\GeneratorFactory;
use Ibrahimhalilucan\Keygen\Generators\Char;
use Ibrahimhalilucan\Keygen\Generators\FloatType;
use Ibrahimhalilucan\Keygen\Generators\Integer as IntegerType;
use Ibrahimhalilucan\Keygen\Generators\Serial;
use Ibrahimhalilucan\Keygen\Generators\Token;

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
            'char'    => Char::class,
            'integer' => IntegerType::class,
            'float'    => FloatType::class,
            'serial'  => Serial::class,
            'token'   => Token::class,
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
