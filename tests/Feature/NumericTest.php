<?php
use IbrahimHalilUcan\Keygen\Keygen;
use Orchestra\Testbench\TestCase;

/**
 * Class IntegerTest.
 */
class NumericTest extends TestCase
{
    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app): array
    {
        return [
            'IbrahimHalilUcan\Keygen\PackageServiceProvider'
        ];
    }

    /** @test */
    public function test_generate_integer()
    {
        $number = Keygen::numeric()->generate();
        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(config('keygen-config.integer_min'), $number);
        $this->assertLessThanOrEqual(config('keygen-config.integer_max'), $number);
    }

    /** @test */
    public function test_generate_integer_min_max()
    {
        $number = Keygen::numeric()->min(4)->max(45)->generate();

        $this->assertIsInt($number);
        $this->assertGreaterThanOrEqual(4, $number);
        $this->assertLessThan(45, $number);
    }

    /** @test */
    public function test_generate_integer_min_type_validation_error()
    {
        $catch = false;
        try {
            $number = Keygen::numeric()->min("string")->generate();
        } catch (\Error $exception) {
            $catch = true;
            $this->assertIsString($exception->getMessage(), "Message Error");
        }
        $this->assertSame(true, $catch, "Exception catch");
    }

    /** @test */
    public function test_generate_integer_max_type_validation_error()
    {
        $catch = false;
        try {
            $number = Keygen::numeric()->max("string")->generate();
        } catch (\Error $exception) {
            $catch = true;
            $this->assertIsString($exception->getMessage(), "Message Error");
        }
        $this->assertSame(true, $catch, "Exception catch");
    }

    /** @test */
    public function test_generate_integer_range_type_validation_error()
    {
        $catch = false;
        try {
            $number = Keygen::numeric()->range("string", 35)->generate();
        } catch (\Error $exception) {
            $catch = true;
            $this->assertIsString($exception->getMessage(), "Message Error");
        }
        $this->assertSame(true, $catch, "Exception catch");
    }

}
