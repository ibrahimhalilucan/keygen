<?php
use Ibrahimhalilucan\Keygen\Keygen;
use Orchestra\Testbench\TestCase;

/**
 * Class CharTest.
 */
class CharTest extends TestCase
{
    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app): array
    {
        return [
            'Ibrahimhalilucan\Keygen\PackageServiceProvider'
        ];
    }

    /** @test */
    public function test_generate_char()
    {
        $char = Keygen::char()->generate();
        $this->assertIsString($char, "Is String");
    }

    /** @test
     * @throws Exception
     */
    public function test_generate_char_length()
    {
        $length = random_int(1,32);
        $char = Keygen::char()->length($length)->generate();
        $this->assertIsString($char, "Is String");
        $this->assertSame($length, strlen($char), "Check length String generated <" . $char . ">");
    }

    /** @test */
    public function test_generate_char_alpha()
    {
        $char = Keygen::char()->alpha()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
    }

    /** @test */
    public function test_generate_char_alphaLowerCase()
    {
        $char = Keygen::char()->alphaLowerCase()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
        $this->assertTrue(ctype_lower($char), "Check for lowercase character");
    }

    /** @test */
    public function test_generate_char_alphaUpperCase()
    {
        $char = Keygen::char()->alphaUpperCase()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
        $this->assertTrue(ctype_upper($char), "Check for uppercase character");
    }

    /** @test */
    public function test_generate_char_lower()
    {
        $char = Keygen::char()->lower()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
        $this->assertTrue(ctype_lower($char), "Check for lowercase character");
    }

    /** @test */
    public function test_generate_char_upper()
    {
        $char = Keygen::char()->upper()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
        $this->assertTrue(ctype_upper($char), "Check for uppercase character");
    }

    /** @test */
    public function test_generate_char_numeric()
    {
        $char = Keygen::char()->numeric()->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alnum($char), "Check for alphanumeric character");
    }

    /** @test */
    public function test_generate_char_alphaNumeric()
    {
        $char = Keygen::char()->alphaNumeric()->generate();
        $this->assertIsString($char, "Is String");
    }

    /** @test */
    public function test_generate_char_prefix_and_suffix()
    {
        $char = Keygen::char()->prefix('ihu')->suffix('pi')->generate();
        $this->assertIsString($char, "Is String");
        $this->assertTrue(ctype_alpha($char), "Check for alphabetic character");
    }

    /** @test */
    public function test_generate_char_specialChars()
    {
        $char = Keygen::char()->specialCharacters()->generate();
        $this->assertIsString($char, "Is String");
    }
}
