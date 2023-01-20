<?php
use Ibrahimhalilucan\Keygen\Keygen;
use Orchestra\Testbench\TestCase;

/**
 * Class FloatTest.
 */
class FloatTest extends TestCase
{
    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app): array
    {
        return [
            'Ibrahimhalilucan\Keygen\PackageServiceProvider'
        ];
    }

    /** @test */
    public function test_generate_float()
    {
        $float = Keygen::float()->generate();
        $this->assertIsFloat($float);
        $this->assertGreaterThanOrEqual(config('keygen-config.float_min'), $float);
        $this->assertLessThanOrEqual(config('keygen-config.float_max'), $float);
    }

    /** @test */
    public function test_generate_float_min_max_decimals()
    {
        $float = Keygen::float()->min(4)->max(45)->decimals(2)->generate();
        $floating = round($float - (int) $float, 2);

        $this->assertIsFloat($float);
        $this->assertGreaterThanOrEqual(4, $float);
        $this->assertLessThan(45, $float);
        $this->assertLessThanOrEqual(4, strlen($floating), "$floating length is 4 or less (x.xx)");
    }

    /** @test */
    public function test_generate_float_min_type_validation_error()
    {
        $catch = false;
        try {
            $float = Keygen::float()->min("string")->generate();
        } catch (\Error $exception) {
            $catch = true;
            $this->assertIsString($exception->getMessage(), "Message Error");
        }
        $this->assertSame(true, $catch, "Exception catch");
    }

    /** @test */
    public function test_generate_float_max_type_validation_error()
    {
        $catch = false;
        try {
            $float = Keygen::float()->max("string")->generate();
        } catch (\Error $exception) {
            $catch = true;
            $this->assertIsString($exception->getMessage(), "Message Error");
        }
        $this->assertSame(true, $catch, "Exception catch");
    }

    /** @test */
    public function test_generate_float_range_type_validation_error()
    {
        $catch = false;
        try {
            $float = Keygen::float()->range("string")->generate();
        } catch (\Error $exception) {
            $catch = true;
            $this->assertIsString($exception->getMessage(), "Message Error");
        }
        $this->assertSame(true, $catch, "Exception catch");
    }

    /** @test */
    public function test_generate_float_decimals_type_validation_error()
    {
        $catch = false;
        try {
            $float = Keygen::float()->decimals("string")->generate();
        } catch (\Error $exception) {
            $catch = true;
            $this->assertIsString($exception->getMessage(), "Message Error");
        }
        $this->assertSame(true, $catch, "Exception catch");
    }
}
