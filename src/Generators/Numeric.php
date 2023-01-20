<?php

namespace IbrahimHalilUcan\Keygen\Generators;

use Exception;
use IbrahimHalilUcan\Keygen\Exceptions\InvalidArgumentException;
use IbrahimHalilUcan\Keygen\Keygen;
use IbrahimHalilUcan\Keygen\Interfaces\GenerateInterface;

class Numeric extends Keygen implements GenerateInterface
{
    /**
     * Minimum value for the random int
     *
     * @var int
     */
    private int $min;

    /**
     * Maximum value for the random int
     *
     * @var int
     */
    private int $max;

    /**
     * Integer constructor.
     */
    public function __construct()
    {
        $this->min = config('keygen-config.integer_min');
        $this->max = config('keygen-config.integer_max');
    }

    /**
     * Set the maximum value of the object
     *
     * @param int $value
     * @return self
     */
    public function max(int $value): self
    {
        $this->max = $value;
        return $this;
    }

    /**
     * Set the minimum value of the object
     *
     * @param int $value
     * @return self
     */
    public function min(int $value): self
    {
        $this->min = $value;
        return $this;
    }

    /**
     * Set the min value of the object (min and max) Calling range(1,10), it is equivalent of ->min(1)->max(10)
     *
     * @param int $minValue
     * @param int $maxValue
     * @return $this
     * @throws InvalidArgumentException
     */
    public function range(int $minValue, int $maxValue): self
    {
        if ($this->min >= $this->max) {
            throw new InvalidArgumentException("The specified max can't be <= than the specified min.");
        }
        return $this->min($minValue)->max($maxValue);
    }

    /**
     * Generate a random int between min and max (considering $min and $max attribute)
     *
     * @return int the random value (integer)
     * @throws Exception
     */
    public function generate(): int
    {
        return random_int($this->min, $this->max);
    }
}
