<?php

namespace IbrahimHalilUcan\Keygen\Generators;

use Exception;
use IbrahimHalilUcan\Keygen\Keygen;
use IbrahimHalilUcan\Keygen\Interfaces\GenerateInterface;

class SerialNumber extends Keygen implements GenerateInterface
{
    /**
     * A string prefix to be added to the generated random string
     *
     * @var string
     */
    private string $prefix;

    /**
     * A string suffix to be added to the generated random string
     *
     * @var string
     */
    private string $suffix;

    /**
     * The length of the generated random string
     *
     * @var int
     */
    private int $length;

    /**
     * The separator used between parts of the generated string
     *
     * @var string
     */
    private string $separator;

    /**
     * The number of parts in the generated string
     *
     * @var int
     */
    private int $parts;

    /**
     * An array containing the lowercase alphabet characters to be used to generate the random string
     *
     * @var array
     */
    private array $alphaLowerCase;

    /**
     * An array containing the uppercase alphabet characters to be used to generate the random string
     *
     * @var int[]
     */
    private array $alphaUpperCase;

    /**
     * An array containing the numeric characters to be used to generate the random string
     *
     * @var array
     */
    private array $numeric;

    /**
     * An array containing the ASCII codes of the characters to be used to generate the random string
     *
     * @var array
     */
    private array $asciiCodes;


    /**
     * Serial constructor.
     */
    public function __construct()
    {
        $this->length = config('keygen-config.serial_length');
        $this->separator = config('keygen-config.serial_separator');
        $this->parts = config('keygen-config.serial_parts');
        $this->alphaLowerCase = range(97, 122);
        $this->alphaUpperCase = range(65, 90);
        $this->numeric = range(48, 57);
        $this->asciiCodes = [];
    }

    /**
     * Set the character set to include alphabet characters (uppercase and lowercase)
     * 'A'-'Z' and 'a'-'z' (upper and lower case)
     *
     * @return self
     */
    public function alpha(): self
    {
        $this->addPreset($this->alphaLowerCase);
        $this->addPreset($this->alphaUpperCase);
        return $this;
    }

    /**
     * Set the character set to include lowercase alphabet characters 'a'-'z'
     *
     * @return self
     */
    public function lower(): self
    {
        $this->addPreset($this->alphaLowerCase);
        return $this;
    }

    /**
     * Set the character set to include uppercase alphabet characters 'A'-'z'
     *
     * @return self
     */
    public function upper(): self
    {
        $this->addPreset($this->alphaUpperCase);
        return $this;
    }

    /**
     * Set the character set to include numeric characters ('0'-'9')
     *
     * @return self
     */
    public function numeric(): self
    {
        $this->addPreset($this->numeric);
        return $this;
    }

    /**
     * Set the character set to include alphanumeric characters (uppercase and lowercase alphabet and numeric)
     * 'A'-'Z' AND 'a'-'z' AND '0'-'9'
     *
     * @return self
     */
    public function alphaNumeric(): self
    {
        $this->addPreset($this->alphaLowerCase);
        $this->addPreset($this->alphaUpperCase);
        $this->addPreset($this->numeric);
        return $this;
    }

    /**
     * Add a preset array of characters to the list of ASCII codes
     *
     * @param int[] $preset
     * @return self
     */
    public function addPreset(array $preset): self
    {
        foreach ($preset as $p) {
            $this->asciiCodes[] = $p;
        }
        return $this;
    }

    /**
     * Set the number of parts for the generated string
     *
     * @param int $value
     * @return $this
     */
    public function parts(int $value): self
    {
        $this->parts = $value;
        return $this;
    }

    /**
     * Set the length of the generated random string
     *
     * @param int $value
     * @return $this
     */
    public function length(int $value): self
    {
        $this->length = $value;
        return $this;
    }

    /**
     * Set the separator for the generated string
     *
     * @param string $value
     * @return $this
     */
    public function separator(string $value): self
    {
        $this->separator = $value;
        return $this;
    }

    /**
     * Set the prefix of the generated random string
     *
     * @param string $value
     * @return self
     */
    public function prefix(string $value): self
    {
        $this->prefix = $value;
        return $this;
    }

    /**
     * Set the suffix of the generated random string
     *
     * @param string $value
     * @return self
     */
    public function suffix(string $value): self
    {
        $this->suffix = $value;
        return $this;
    }


    /**
     * Generates a random string based on the preset ASCII codes, prefix, suffix, parts, and separator.
     * This method will create a random string
     * return mixed $serial (e.g. ky1f34-RgTtYe-89E801-YpzP3q)
     *
     * @throws Exception
     */
    protected function random(): string
    {
        $serial = '';

        for ($x = 0; $x < $this->parts; $x++) {
            if ($x > 0) {
                $serial .= substr($this->separator, 0, 1);
            }
            for ($i = 0; $i < $this->length; $i++) {
                if (sizeof($this->asciiCodes) === 0) {
                    $this->addPreset($this->alphaLowerCase);
                }
                $rand_index = random_int(0, sizeof($this->asciiCodes) - 1);
                $serial .= chr($this->asciiCodes[$rand_index]);
            }
        }

        if (isset($this->prefix)) {
            $serial = sprintf('%s%s', $this->prefix, $serial);
        }
        if (isset($this->suffix)) {
            $serial = sprintf('%s%s', $serial, $this->suffix);
        }

        return $serial;
    }

    /**
     * Generates a random string based on the preset ASCII codes, prefix, suffix, parts, and separator.
     *
     * @return string
     * @throws Exception
     */
    public function generate(): string
    {
        return $this->random();
    }
}
