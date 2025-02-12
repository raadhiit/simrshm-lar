<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * Class Services
 * @author rivald_ideplex_team
 */
class VisiteDokterService
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function getData()
    {

        $getQuery = DB::table('smis_mjm_visite')
                ->select(
                    '*'
                )
                ->get();

        return $getQuery;

    }

 
}
