<?php

namespace App\Services;

use App\Models\RsCredential;

/**
 * Class Services
 * @author rivv 
 */
class CredentialService
{
    public function getCredential()
    {
        $data['data'] = RsCredential::where('layanan', 'aplicare')->first();
        return $data;
    }

    public function createCredential($request)
    {
        try {
            RsCredential::updateOrCreate([
                'layanan' => 'aplicare'
            ], [
                'cons_id' => $request->cons_id,
                'cons_secret' => $request->cons_secret,
                'user_key' => $request->user_key,
                'nama_rs' => $request->nama_rs,
                'kode_ppk' => $request->kode_ppk,
                'base_url' => $request->base_url,
            ]);
            return response()->json([
                'message' => 'Credentials berhasil disimpan'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal menyimpan data silahkan hubungi admin',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
