<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pengguna;
use Storage;
use JWTAuth;
class SalinJawaban extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salin:jawaban {pengguna_id?} {sekolah_id?}';

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
        $pengguna_id = $this->argument('pengguna_id');
        $sekolah_id = $this->argument('sekolah_id');
        $all_jawaban = Storage::get('jawaban.json');
        $all_jawaban = json_decode($all_jawaban);
        $user = Pengguna::find($pengguna_id);
        $token = JWTAuth::fromUser($user);
        DB::table('log.login')->insert([
            'login_id' => Str::uuid(),
            'pengguna_id' => $pengguna_id,
            'tanggal' => date('Y-m-d'),
            'jenis_login' => 'TUKAR_PENGGUNA',
            'token' => $token,
            'create_date' => date('Y-m-d H:i:s'),
            'last_update' => date('Y-m-d H:i:s'),
            'soft_delete' => 0,
            'updater_id' => $pengguna_id,
            'last_sync' => date('Y-m-d H:i:s')
        ]);
        foreach($all_jawaban as $jawaban){
            DB::table('jawaban')->updateOrInsert(
                [
                    'pengguna_id' => $pengguna_id,
                    'instrumen_id' => $jawaban->instrumen_id,
                    'sekolah_id' => $sekolah_id,
                ],
                [
                    'jawaban_id' => Str::uuid(),
                    'isian' => $jawaban->isian,
                    'nilai' => $jawaban->nilai,
                    'updater_id' => $pengguna_id,
                    'create_date' => date('Y-m-d H:i:s'),
                    'last_update' => date('Y-m-d H:i:s'),
                    'soft_delete' => 0,
                    'last_sync' => date('Y-m-d H:i:s')
                ]
            );
            /*Jawaban::updateOrCreate(
                [
                    'pengguna_id' => $pengguna_id,
                    'instrumen_id' => $jawaban->instrumen_id,
                    'sekolah_id' => $jawaban->sekolah_id,
                ],
                [
                    'isian' => $jawaban->isian,
                    'nilai' => $jawaban->nilai,
                    'updater_id' => $pengguna_id,
                    'last_sync' => date('Y-m-d H:i:s')
                ]
            );*/
        }
    }
}
