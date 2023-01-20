<?php
use Ibrahimhalilucan\Keygen\Keygen;
use Orchestra\Testbench\TestCase;

/**
 * Class TokenTest.
 */
class TokenTest extends TestCase
{
    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app): array
    {
        return [
            'Ibrahimhalilucan\Keygen\PackageServiceProvider'
        ];
    }

    /** @test */
    public function test_generate_token()
    {
        $token = Keygen::token()->generate();
        $this->assertIsString($token, "Is String");
    }

    /** @test */
    public function test_generate_token_length()
    {
        $token = Keygen::token()->length(128)->generate();
        $this->assertIsString($token, "Is String");
    }

    /** @test */
    public function test_generate_token_suffix_and_prefix()
    {
        $token = Keygen::token()->prefix("ihu-")->suffix("-pi")->generate();
        $this->assertIsString($token, "Is String");
    }
}
