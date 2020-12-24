<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Jawaban;
use Storage;
class GenerateJawaban extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:jawaban';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        return Storage::put('jawaban.json', json_encode(Jawaban::all()));
    }
}
