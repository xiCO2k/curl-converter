<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CurlCommandTest extends TestCase
{
    /**
     * @test
     * @dataProvider curlCommandFixtures
     */
    public function it_converts_curl_requests_to_http_client_code($fixture)
    {
        $code = Artisan::call('shift:' . trim(file_get_contents('tests/fixtures/' . $fixture . '.in')));
        $output = Artisan::output();

        $this->assertSame(0, $code);
        $this->assertSame(file_get_contents('tests/fixtures/' . $fixture . '.out'), $output);
    }

    public function curlCommandFixtures()
    {
        return [
            'GET request' => ['basic-get'],
            'POST request' => ['basic-post'],
            'POST request with data' => ['post-with-data'],
            'POST request with JSON data' => ['post-json'],
            'POST request with multipart/form-data' => ['post-with-form-data'],
            'GET request with headers' => ['with-headers'],
            'Mailgun example request' => ['mailgun-example'],
            'Digital Ocean example request' => ['digital-ocean-example'],
            'Stripe example request' => ['stripe-example'],
        ];
    }
}
