<?php

namespace IbrahimHalilUcan\Keygen\Generators;

use Exception;
use IbrahimHalilUcan\Keygen\Keygen;
use IbrahimHalilUcan\Keygen\Interfaces\GenerateInterface;

class Token extends Keygen implements GenerateInterface
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
     * Token constructor.
     */
    public function __construct()
    {
        $this->length = config('keygen-config.token_length');
    }


    /**
     * Set the length of the generated random string
     * @param int $value
     * @return $this
     */
    public function length(int $value): self
    {
        $this->length = $value;
        return $this;
    }

    /**
     * Set the prefix of the generated random string
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
     * @param string $value
     * @return self
     */
    public function suffix(string $value): self
    {
        $this->suffix = $value;
        return $this;
    }


    /**
     * Generates a random token using base64 encoding and str_shuffle.
     *
     * @return string
     * @throws Exception
     */
    public function generate(): string
    {
        $token = '';
        for ($i = 0; $i < $this->length; ++$i) {
            $token .= chr(rand(32, 1024));
        }

        $token = base64_encode(str_shuffle($token));

        $token = substr($token, 0, $this->length);
        if (isset($this->prefix)) {
            $token = sprintf('%s%s', $this->prefix, $token);
        }
        if (isset($this->suffix)) {
            $token = sprintf('%s%s', $token, $this->suffix);
        }

        return $token;
    }
}
