<?php

namespace IbrahimHalilUcan\Keygen\Generators;

use Exception;
use IbrahimHalilUcan\Keygen\Exceptions\InvalidArgumentException;
use IbrahimHalilUcan\Keygen\Keygen;
use IbrahimHalilUcan\Keygen\Interfaces\GenerateInterface;

class FloatType extends Keygen implements GenerateInterface
{
    /**
     * Minimum value for the random float
     *
     * @var float
     */
    private float $min;

    /**
     * Maximum value for the random float
     *
     * @var float
     */
    private float $max;

    /**
     * Number of decimal places for the generated float
     *
     * @var int
     */
    private int $decimals;

    /**
     * float type constructor.
     */
    public function __construct()
    {
        $this->min = config('keygen-config.float_min');
        $this->max = config('keygen-config.float_max');
        $this->decimals = config('keygen-config.float_decimal');
    }

    /**
     * Set the maximum value of the object
     *
     * @param float|int $max greatest value
     * @return self
     * @throws InvalidArgumentException
     */
    public function max(float|int $max): self
    {
        if (!is_float($max) && !is_int($max)) {
            throw new InvalidArgumentException("The max argument must be either an integer or a float.");
        }

        $this->max = $max;
        return $this;
    }

    /**
     * Set the min value of the object
     *
     * @param float|int $min
     * @return self
     * @throws InvalidArgumentException
     */
    public function min(float|int $min): self
    {
        if (!is_float($min) && !is_int($min)) {
            throw new InvalidArgumentException("The min argument must be either an integer or a float.");
        }

        $this->min = $min;
        return $this;
    }

    /**
     * Set the number of decimal places
     *
     * @param int $decimals
     * @return self
     * @throws InvalidArgumentException
     */
    public function decimals(int $decimals): self
    {
        if ($decimals < 0) {
            throw new InvalidArgumentException("The number of decimals cannot be negative.");
        }

        // Due to the way PHP floating point numbers are implemented (IEEE 754)
        // A guaranteed number of decimal places is around 5, but in 99% of the cases is 8
        $this->decimals = min($decimals, 8);
        return $this;
    }

    /**
     * Set the min value of the object (min and max) Calling range(1,10), it is equivalent of ->min(1)->max(10)
     *
     * @param float|int $min
     * @param float|int $max
     * @return self
     * @throws InvalidArgumentException
     */
    public function range(float|int $min, float|int $max): self
    {
        return $this->min($min)->max($max);
    }

    /**
     * Generate a random float between min and max (considering $min and $max attribute)
     *
     * @return float the float random value
     * @throws Exception
     */
    public function generate(): float
    {
        if ($this->min >= $this->max) {
            throw new InvalidArgumentException("The specified max can't be <= than the specified min.");
        }

        $base = $this->min + mt_rand() / mt_getrandmax() * ($this->max - $this->min);

        return round($base, $this->decimals);
    }
}
