<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class Services
 * @author rivald_ideplex_team
 */
class KonsulDokterService
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function getData()
    {

        $getQuery = DB::table('smis_mjm_konsul')
                ->select(
                    '*'
                )
                ->get();

        return $getQuery;

    }

 
}
