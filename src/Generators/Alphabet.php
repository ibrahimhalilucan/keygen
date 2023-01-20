<?php

namespace IbrahimHalilUcan\Keygen\Generators;

use Exception;
use IbrahimHalilUcan\Keygen\Keygen;
use IbrahimHalilUcan\Keygen\Interfaces\GenerateInterface;

class Alphabet extends Keygen implements GenerateInterface
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
     * An array containing the ASCII codes of the characters to be used to generate the random string
     *
     * @var array
     */
    private array $asciiCodes;

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
     * @var int[]
     * (33–47 / 58–64 / 91–96 / 123–126): Special characters include all printable characters that
     * are neither letters nor numbers. These include punctuation or technical, mathematical characters.
     * ASCII also includes the space (a non-visible but printable character), and, therefore,
     * does not belong to the control characters category, as one might suspect.
     * - 33-47 : !"#$%&'()*+,-./
     * - 58-64 : :;<=>?@
     * - 91-96 : [\]^_`
     * - 123-126 : {|}~
     */
    private array $specialCharacters;

    /**
     * List of Transformers to apply when generate() is called
     * to add some transformers use transformers chainable methods like
     * ->lower() or ->upper()
     *
     * @var string[]
     */
    private array $transformersStack = [];

    /**
     * List of Transformers available (with the related method to call)
     *
     * @var string[]
     */
    private array $transformers = [
        'lower' => 'transformLower',
        'upper' => 'transformUpper'
    ];

    /**
     * Char constructor.
     * Reset all attributes to default values. It is useful for the construct method
     * but also when you want to reinitialize Char object.
     */
    public function __construct()
    {
        $this->asciiCodes = [];
        $this->transformersStack = [];
        $this->alphaLowerCase = range(97, 122);
        $this->alphaUpperCase = range(65, 90);
        $this->numeric = range(48, 57);
        $this->length = (int)config('keygen-config.char_length');

        $this->specialCharacters =
            array_merge(
                range(33, 47), // !"#$%&'()*+,-./
                range(58, 64), // :;<=>?@
                range(91, 96), // [\]^_`
                range(123, 126) // {|}~
            );
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
     * Set the character set to include lowercase alphabet characters. 'a'-'z' (lower case)
     *
     * @return self
     */
    public function alphaLowerCase(): self
    {
        $this->addPreset($this->alphaLowerCase);
        return $this;
    }

    /**
     * Set the character set to include uppercase alphabet characters 'A'-'Z' (upper case)
     *
     * @return self
     */
    public function alphaUpperCase(): self
    {
        $this->addPreset($this->alphaUpperCase);
        return $this;
    }

    /**
     * Transform generated string to lowercase
     *
     * @return self
     */
    public function lower(): self
    {
        $this->addTransform("lower");
        return $this;
    }

    /**
     * Add a transformer type.
     * A Transformer is a method used in generate method to modify the char set.
     * For example if you want to have only lower case
     * (it applies str to lower to the charset) before to select randomly 1
     *
     * @param string $transformType
     * @return void
     */
    private function addTransform(string $transformType): void
    {
        if (array_key_exists($transformType, $this->transformers)) {
            $this->transformersStack = $this->transformersStack + [$transformType];
        }
    }

    /**
     * Transform generated string to uppercase
     *
     * @return self
     */
    public function upper(): self
    {
        $this->addTransform('upper');
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
     * Set the character set to include special characters
     *
     * @return self
     */
    public function specialCharacters(): self
    {
        $this->addPreset($this->specialCharacters);
        return $this;
    }

    /**
     * Set the length of the generated random string
     *
     * @param int $length
     * @return $this
     */
    public function length(int $length): self
    {
        $this->length = $length;
        return $this;
    }

    /**
     * Generates a random string based on the preset ASCII codes, prefix and suffix
     *
     * @return string the random value (string)
     * @throws Exception
     */
    public function generate(): string
    {
        $characters = '';
        for ($i = 0; $i < $this->length; $i++) {
            if (sizeof($this->asciiCodes) === 0) {
                $this->addPreset($this->alphaLowerCase);
            }
            foreach ($this->transformersStack as $transformerCode) {
                call_user_func(array ($this, $this->transformers[$transformerCode]));
            }

            $randIndex = random_int(0, sizeof($this->asciiCodes) - 1);
            $characters .= chr($this->asciiCodes[$randIndex]);
        }

        if (isset($this->prefix)) {
            $characters = sprintf('%s%s', $this->prefix, $characters);
        }
        if (isset($this->suffix)) {
            $characters = sprintf('%s%s', $characters, $this->suffix);
        }
        return $characters;
    }

    /**
     * Transforms the preset ASCII codes to lowercase
     *
     * @return $this
     */
    private function transformLower(): self
    {
        $t = [];
        foreach ($this->asciiCodes as $a) {
            $t[] = ord(strtolower(chr($a)));
        }
        $this->cleanAsciiCodes($t);
        return $this;
    }

    /**
     * Remove duplicate ASCII codes and sort the remaining codes in ascending order
     *
     * @param array $array
     * @return void
     */
    private function cleanAsciiCodes(array $array): void
    {
        $this->asciiCodes = array_unique($array, SORT_NUMERIC);
        sort($this->asciiCodes);
    }

    /**
     * Transforms the preset ASCII codes to uppercase
     *
     * @return $this
     */
    private function transformUpper(): self
    {
        $t = [];
        foreach ($this->asciiCodes as $a) {
            $t[] = ord(strtoupper(chr($a)));
        }
        $this->cleanAsciiCodes($t);
        return $this;
    }
}
