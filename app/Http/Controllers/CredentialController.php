<?php

namespace App\Http\Controllers;

use App\Http\Requests\CredentialRequest;
use App\Services\CredentialService;

class CredentialController extends Controller
{
    public function index(CredentialService $credentialService)
    {
        return view('aplicare.credential.index', $credentialService->getCredential());
    }

    public function create(CredentialRequest $request, CredentialService $credentialService)
    {
        return $credentialService->createCredential($request);
    }
}
