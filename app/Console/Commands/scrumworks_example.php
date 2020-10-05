<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class scrumworks_example extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrumworks:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will select users from the database and call some API.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = DB::select('SELECT * FROM users');
    
        $this->output->write("Found " . count($users) . " users", true);
        foreach ($users as $user) {
            $this->output->write( "\tCalling API for user {$user->name}({$user->id}) with result... ");
            $query = http_build_query(["userId" => $user->id, "name" => $user->name,]);
            $response = Http::get(env("EXAMPLE_API_ENDPOINT") . "?" . $query);
            $this->output->write( 200 == $response->status() ? 'OK' : "NOT OK", true);
        }
    }
}
