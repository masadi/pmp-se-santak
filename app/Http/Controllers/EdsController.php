<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Sekolah;
use App\Models\Pengguna;
use App\Models\Instrumen;
use Artisan;

class EdsController extends Controller
{
    public function index(Request $request){
        $npsn = [
            '20527178',
            '20552093',
            '20552094',
            '20566321',
            '20552101',
            '69757252',
            '20577814',
            '20566538',
            '20537396',
            '20575281',
            '20566322',
            '20552129',
            '69943135',
            '69822425',
            '20527169',
            '20537411',
            '20566541',
            '20537415',
            '20566545',
            '69954356',
            '20537419',
            '20537399',
            '20579411',
            '69788145',
            '20574521',
            '20574533',
            '20577092',
            '20577070',
        ];
        $sekolah = Sekolah::first();
        $get_sekolah = NULL;
        if($sekolah){
            if(in_array($sekolah->npsn, $npsn)){
                $get_sekolah = $sekolah;
            }
        }
        $all_data = Pengguna::with(['peran', 'jawabans'])->withCount(['rekap_kemajuan' => function($query){
            $query->whereHas('instrumen', function($query){
                $query->where('tingkat_instrumen_id', 3);
                $query->where('soft_delete', 0);
            });
            $query->where('soft_delete', 0);
            $query->where('persentase', 100);
        }])->where(function($query) use ($get_sekolah){
            if($get_sekolah){
                $query->where('sekolah_id', $get_sekolah->sekolah_id);
                $query->whereIn('peran_id', [10,53]);
                $query->where('soft_delete', 0);
            } else {
                $query->where('peran_id', 1);
            }
        })->orderBy('peran_id')->orderBy('nama')->get();
        return response()->json(['status' => 'success', 'data' => $all_data, 'sekolah' => $get_sekolah]);
    }
    public function sekolah(Request $request){
        $npsn = [
            '20527178',
            '20552093',
            '20552094',
            '20566321',
            '20552101',
            '69757252',
            '20577814',
            '20566538',
            '20537396',
            '20575281',
            '20566322',
            '20552129',
            '69943135',
            '69822425',
            '20527169',
            '20537411',
            '20566541',
            '20537415',
            '20566545',
            '69954356',
            '20537419',
            '20537399',
            '20579411',
            '69788145',
            '20574521',
            '20574533',
            '20577092',
            '20577070',
        ];
        $all_data = Sekolah::whereIn('npsn', $npsn)->get();
        return response()->json(['status' => 'success', 'data' => $all_data]);
    }
    public function get_pengguna(Request $request){
        //$sekolah = Sekolah::find($request->sekolah_id);
        $all_data = Pengguna::with(['peran', 'jawabans'])->withCount(['rekap_kemajuan' => function($query){
            $query->whereHas('instrumen', function($query){
                $query->where('tingkat_instrumen_id', 3);
                $query->where('soft_delete', 0);
            });
            $query->where('soft_delete', 0);
            $query->where('persentase', 100);
        }])->where('sekolah_id', $request->sekolah_id)->whereIn('peran_id', [10,53])->get();
        return response()->json(['status' => 'success', 'data' => $all_data]);
    }
    public function salin_jawaban(Request $request){
        Artisan::call('salin:jawaban', ['pengguna_id' => $request->pengguna_id, $request->sekolah_id]);
        $response = Http::get('http://localhost:1746/api/HitungRekapKemajuan?start=0&limit=20&pengguna_id='.$request->pengguna_id.'&load_children=1&tingkat_instrumen=1&tahun_ajaran_id=2020&tahun=2020&sekolah_id='.$request->sekolah_id.'&jenjang=SMP&responden=guru&instrumen_id=bfbb3d49-87ed-4c49-96d5-5f9fb2daccce&media_id=1&kelompok_kode=[%22A%22,+%22B%22,+%22C%22,+%22D%22,+%22E%22,+%22F%22,+%22G%22,+%22H%22]');
        $jawaban_utama = self::simpanJawabanUtama($request);
        return response()->json(['status' => 'success', 'pengguna_id' => $request->pengguna_id, 'response' => $response, 'title' => 'Instrumen berhasil disimpan']);
    }
    public function reset_rapor_mutu(Request $request){
        if($request->sekolah_id){
            DB::table('master_pmp')->where('sekolah_id', $request->sekolah_id)->delete();
            DB::table('log.proses_rapor')->where('sekolah_id', $request->sekolah_id)->delete();
        }
        return response()->json(['status' => 'success']);
    }
    static function simpanJawabanUtama(Request $request){
        $pengguna_id = $request->input('pengguna_id') ? $request->input('pengguna_id') : null;
        $mandiri = $request->input('mandiri') ? $request->input('mandiri') : 0;
        $instrumen_id = $request->input('instrumen_id') ? $request->input('instrumen_id') : '4b0483fe-9834-47e2-82bd-8015727c7ff4';
        $tahun_ajaran_id = $request->input('tahun_ajaran_id') ? $request->input('tahun_ajaran_id') : '2020';

        //get sekolahnya dulu
        $fetch_pengguna = DB::table('pengguna')->where('pengguna_id','=',$pengguna_id)->get();

        if(sizeof($fetch_pengguna) > 0){
            //ketemu data penggunannya
            $sekolah_id = $fetch_pengguna[0]->sekolah_id;

            $fetch_sekolah = DB::table('sekolah')->where('sekolah_id','=',$sekolah_id)->get();

            if(sizeof($fetch_sekolah) > 0){
                //ketemu data sekolahnya
                $bentuk_pendidikan_id = $fetch_sekolah[0]->bentuk_pendidikan_id;
            }else{
                //nggak ketemu data sekolahnya
                $bentuk_pendidikan_id = 5;
            }

        }else{
            //nggak ketemu data penggunanya
            $sekolah_id = null;
            $bentuk_pendidikan_id = 5;
        }


        $recordInduk = DB::select(DB::raw("SELECT
            jawaban.isian,
            jawaban.nilai
        FROM
            instrumen
            LEFT JOIN (SELECT
                pengguna_id,
                instrumen_id,
                SUM ( 1 ) as total,
                MAX ( nilai ) AS nilai,
                MAX ( isian ) AS isian 
            FROM
                jawaban 
            WHERE
                soft_delete = 0 
            GROUP BY
                pengguna_id,
                instrumen_id
            ) jawaban ON jawaban.instrumen_id = instrumen.instrumen_id 
            -- AND jawaban.soft_delete = 0 
            and jawaban.pengguna_id = '".$pengguna_id."'
        WHERE
            instrumen.tingkat_instrumen_id = 6 
        AND instrumen.tahun_ajaran_id = '".$tahun_ajaran_id."'
        AND instrumen.soft_delete = 0
        ".((int)$bentuk_pendidikan_id != 29 ? " AND instrumen.slb != 1" : " AND instrumen.slb = 1")."
        ORDER BY instrumen.instrumen_id ASC"));

        $arrIsian = array();
        $arrNilai = array();

        for ($iJawaban=0; $iJawaban < sizeof($recordInduk); $iJawaban++) { 
            unset($recordInduk[$iJawaban]->jawaban_id);
            unset($recordInduk[$iJawaban]->sekolah_id);
            unset($recordInduk[$iJawaban]->pengguna_id);
            unset($recordInduk[$iJawaban]->instrumen_id);
            unset($recordInduk[$iJawaban]->create_date);
            unset($recordInduk[$iJawaban]->last_update);
            unset($recordInduk[$iJawaban]->soft_delete);
            unset($recordInduk[$iJawaban]->updater_id);
            unset($recordInduk[$iJawaban]->last_sync);  

            array_push($arrIsian, (string)$recordInduk[$iJawaban]->isian);
            array_push($arrNilai, (string)$recordInduk[$iJawaban]->nilai);
        }

        $return = array();
        $return['total'] = sizeof($recordInduk);

        // $return['rows'] = $recordInduk;

        $return['isian'] = $arrIsian;
        $return['nilai'] = $arrNilai;

        $sql_check = "select count(1) as total, max(last_sync) as last_sync from jawaban_utama where pengguna_id = '".$pengguna_id."' and master_instrumen_id = '".$instrumen_id."'";

        $check = DB::select(DB::raw($sql_check));

        if($check[0]->total < 1){

            $sql = "INSERT INTO jawaban_utama values(
                '".$pengguna_id."',
                '".$instrumen_id."',
                '".json_encode($return)."',
                '".date('Y-m-d H:i:s')."',
                '".date('Y-m-d H:i:s')."',
                0,
                null,
                '1990-01-01 23:59'
            )";
            //  ON CONFLICT (pengguna_id, master_instrumen_id) 
            // DO
            //     UPDATE
            //     SET json_jawaban = '".json_encode($return)."',
            //     last_update = '".date('Y-m-d H:i:s')."'";
    
            $exe = DB::statement($sql);

            if($mandiri == 1){

                $return = array();
                $return['success'] = ($exe ? true : false);

                if($exe){
                    $sql_fix = "update jawaban set last_sync = last_update where pengguna_id = '".$pengguna_id."'";
                    $exe = DB::statement($sql_fix);
                }

                return $return;

            }else{
                if($exe){
                    return true;
                }else{
                    return false;
                }
            }
            

        }else{

            $sql = "UPDATE jawaban_utama set
                json_jawaban = '".json_encode($return)."',
                last_update = '".date('Y-m-d H:i:s')."'
            WHERE pengguna_id = '".$pengguna_id."' AND master_instrumen_id = '".$instrumen_id."'";
            // last_update = '".date('Y-m-d H:i:s', strtotime($check[0]->last_sync . ' +1 day'))."'
            //  ON CONFLICT (pengguna_id, master_instrumen_id) 
            // DO
            //     UPDATE
            //     SET json_jawaban = '".json_encode($return)."',
            //     last_update = '".date('Y-m-d H:i:s')."'";
    
            $exe = DB::statement($sql);
            
            if($mandiri == 1){
                
                $return = array();
                $return['success'] = ($exe ? true : false);

                if($exe){
                    $sql_fix = "update jawaban set last_sync = last_update where pengguna_id = '".$pengguna_id."'";
                    $exe = DB::statement($sql_fix);
                }

                return $return;

            }else{
                if($exe){
                    return true;
                }else{
                    return false;
                }
            }

        }


        // file_put_contents('jsons/tesd.json',$sql);
        // die;

        // $exe = DB::statement($sql);
    }
}
