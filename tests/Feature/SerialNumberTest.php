<?php
use IbrahimHalilUcan\Keygen\Keygen;
use Orchestra\Testbench\TestCase;

/**
 * Class SerialTest.
 */
class SerialNumberTest extends TestCase
{
    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app): array
    {
        return [
            'IbrahimHalilUcan\Keygen\PackageServiceProvider'
        ];
    }

    /** @test */
    public function test_generate_serial()
    {
        $serial = Keygen::serial()->generate();
        $this->assertIsString($serial, "Is String");
    }

    /** @test */
    public function test_generate_serial_alpha()
    {
        $serial = Keygen::serial()->alpha()->parts(1)->generate();
        $this->assertIsString($serial, "Is String");
        $this->assertTrue(ctype_alpha($serial), "Check for alphabetic character");
    }

    /** @test */
    public function test_generate_serial_lower()
    {
        $serial = Keygen::serial()->lower()->parts(1)->generate();
        $this->assertIsString($serial, "Is String");
        $this->assertTrue(ctype_lower($serial), "Check for lowercase character");
    }

    /** @test */
    public function test_generate_serial_upper()
    {
        $serial = Keygen::serial()->upper()->parts(1)->generate();
        $this->assertIsString($serial, "Is String");
        $this->assertTrue(ctype_upper($serial), "Check for uppercase character");
    }

    /** @test */
    public function test_generate_serial_numeric()
    {
        $serial = Keygen::serial()->numeric()->parts(1)->generate();
        $this->assertIsNumeric($serial, "Is Numeric");
        $this->assertTrue(ctype_alnum($serial), "Check for numeric character");
    }

    /** @test */
    public function test_generate_serial_alphaNumeric()
    {
        $serial = Keygen::serial()->alphaNumeric()->parts(1)->generate();
        $this->assertIsString($serial, "Is String");
    }

    /** @test */
    public function test_generate_serial_length_and_parts()
    {
        $serial = Keygen::serial()->length(4)->parts(8)->generate();
        $this->assertIsString($serial, "Is String");
    }

    /** @test */
    public function test_generate_char_prefix_and_suffix()
    {
        $serial = Keygen::serial()->prefix('ihu-')->suffix('-pi')->generate();
        $this->assertIsString($serial, "Is String");
    }
}
