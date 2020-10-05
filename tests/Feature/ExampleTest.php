<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $count = DB::selectOne('SELECT count(*) AS cnt FROM users');
        $this->artisan('scrumworks:example')
          ->expectsOutput("Found {$count->cnt} users")
          ->assertExitCode(0);
    }
}
