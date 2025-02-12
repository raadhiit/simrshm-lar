<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use DB;
use App\Models\RsCredential;

class UpdateAvailableBeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:beds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task for update available beds';

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
        $credentials = RsCredential::where('layanan', 'aplicare')->first();
        if ($credentials == null) {
            logger('Credentials RS tidak ditetmukan');
        }

        $berhasil = 0;

        try {
            $selected = DB::table('available_beds')->select('id', 'kodekelas', 'koderuang', 'namaruang', 'kapasitas', 'tersedia', 'tersediapria', 'tersediawanita', 'tersediapriawanita')
                ->where('updated_at', '<>', null)->where('deleted_at', null)
                ->get();
            // return response()->json($selected[0]);
            if (sizeof($selected) == 0) {
                logger('Tidak ada data yg diupdate ke BPJS');
            } else {
                for ($i = 0; $i < sizeof($selected); $i++) {
                    date_default_timezone_set('UTC');
                    $timeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
                    $signature = $this->get_signature($timeStamp, $credentials->cons_id, $credentials->cons_secret);
                    $guzzleClient = new Client([
                        'verify' => false
                    ]);
                    $response = $guzzleClient->request('post', 'https://apijkn.bpjs-kesehatan.go.id/aplicaresws/rest/bed/update/' . $credentials->kode_ppk, [
                        'headers' => [
                            'X-cons-id'     => $credentials->cons_id,
                            'X-timestamp'  => $timeStamp,
                            'X-signature'   => $signature,
                            'Content-Type: Application/JSON',
                            'Accept: Application/JSON',
                        ],
                        'body' => json_encode([
                            'kodekelas' => $selected[$i]->kodekelas,
                            'namaruang' => $selected[$i]->namaruang,
                            'koderuang' => $selected[$i]->koderuang,
                            'kapasitas' => $selected[$i]->kapasitas,
                            'tersedia' => $selected[$i]->tersedia,
                            'tersediapria' => $selected[$i]->tersediapria,
                            'tersediawanita' => $selected[$i]->tersediawanita,
                            'tersediapriawanita' => $selected[$i]->tersediapriawanita,
                        ])
                    ]);
                    if ($response->getStatusCode() == 200) {
                        DB::table('available_beds')->where('id', $selected[$i]->id)->update([
                            'updated_at' => date('Y-m-d H:i:s', strtotime('+7 hours'))
                        ]);
                        $berhasil++;
                    }
                }
                logger('Update beds berhasil ' . $berhasil . ' dari ' . sizeof($selected));
            }
        } catch (\Throwable $th) {
            logger($th->getMessage());
        }
    }

    function get_signature($timeStamp, $cons_id, $cons_secret)
    {
        $signature = hash_hmac('sha256', $cons_id . "&" . $timeStamp, $cons_secret, true);
        $encodedSignature = base64_encode($signature);
        return $encodedSignature;
    }
}
