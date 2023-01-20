<?php
use IbrahimHalilUcan\Keygen\Keygen;
use Orchestra\Testbench\TestCase;

/**
 * Class CharTest.
 */
class AlphabetTest extends TestCase
{
    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app): array
    {
        return [
            'IbrahimHalilUcan\Keygen\PackageServiceProvider'
        ];
    }

    /** @test */
    public function test_generate_char()
    {
        $char = Keygen::alphabet()->generate();
        $this->assertIsString($char, "Is String");
    }

    /** @test
     * @throws Exception
     */
    public function test_generate_char_length()
    {
        $length = random_int(1,32);
        $char = Keygen::alphabet()->length($length)->generate();
        $this->assertIsString($char, "Is String");
        $this->assertSame($length, strlen($char), "Check length String generated <" . $char . ">");
    }

    /** @test */
    public function test_generate_char_alpha()
    {
        $char = Keygen::alphabet()->alpha()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
    }

    /** @test */
    public function test_generate_char_alphaLowerCase()
    {
        $char = Keygen::alphabet()->alphaLowerCase()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
        $this->assertTrue(ctype_lower($char), "Check for lowercase character");
    }

    /** @test */
    public function test_generate_char_alphaUpperCase()
    {
        $char = Keygen::alphabet()->alphaUpperCase()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
        $this->assertTrue(ctype_upper($char), "Check for uppercase character");
    }

    /** @test */
    public function test_generate_char_lower()
    {
        $char = Keygen::alphabet()->lower()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
        $this->assertTrue(ctype_lower($char), "Check for lowercase character");
    }

    /** @test */
    public function test_generate_char_upper()
    {
        $char = Keygen::alphabet()->upper()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
        $this->assertTrue(ctype_upper($char), "Check for uppercase character");
    }

    /** @test */
    public function test_generate_char_numeric()
    {
        $char = Keygen::alphabet()->numeric()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alnum($char), "Check for alphanumeric character");
    }

    /** @test */
    public function test_generate_char_alphaNumeric()
    {
        $char = Keygen::alphabet()->alphaNumeric()->generate();
        $this->assertIsString($char, "Is String");
    }

    /** @test */
    public function test_generate_char_prefix_and_suffix()
    {
        $char = Keygen::alphabet()->prefix('ihu')->suffix('pi')->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
    }

    /** @test */
    public function test_generate_char_specialChars()
    {
        $char = Keygen::alphabet()->specialCharacters()->generate();
        $this->assertIsString($char, "Is String");
    }
}
