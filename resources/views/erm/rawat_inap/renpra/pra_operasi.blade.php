<form id="form-{{ Illuminate\Support\Str::slug($renpra->nama_renpra, '-') }}" class="form-renpra w-100" method="post" autocomplete="off">
    @csrf
    <input type="hidden" name="id_dokumen" value="{{ $renpra->id_dokumen }}" />
    <input type="hidden" name="id_renpra" value="{{ $renpra->id }}" />
    <input type="hidden" name="nama_renpra" value="{{ $renpra->nama_renpra }}" />
    <input type="hidden" name="created_at" value="{{ $renpra->created_at }}" />
    <input type="hidden" name="action" value="save" />
    <input type="hidden" name="password" value="" />

    <table class="w-100 table-renpra mt-1">
        @include('erm.rawat_inap.renpra.header', ['renpra' => $renpra])
        <tr class="align-top">
            <td class="p-1">
                <input class="form-control border-0 rounded-0 datetimepicker" type="text" value="{{$renpra->tanggal->format('d-m-Y H:i')}}" name="tanggal" required />
            </td>
            <td class="p-1">
                <span><b>Pola Nafas tidak efektif </b> berhubungan dengan :</span>
                <ul class="list-unstyled">
                    @foreach([
                    'Hiperventilasi.',
                    'Penurunan energi/kelelahan.',
                    'Perusakan/pelemahan muskulo-skeletal.',
                    'Kelelahan otot pernafasan.',
                    'Hipoventilasi sindrom.',
                    'Nyeri.',
                    'Kecemasan.',
                    'Disfungsi Neuromuskuler.',
                    'Obesita.',
                    'Injuri tulang belakan.',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="diagnosa_keperawatan[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->diagnosa_keperawatan) &&
                            in_array($item, $renpra->diagnosa_keperawatan) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p>DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Dyspnea',
                    'Nafas pendek',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ds[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->ds) && in_array($item, $renpra->ds) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p>DO:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Penurunan tekanan inspirasi/ekspirasi',
                    'Penurunan pertukaran udara per menit',
                    'Menggunakan otot pernafasan tambah',
                    'Respirasi: < 11-24 x /mnt',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="do[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->do) && in_array($item, $renpra->do) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <p class="font-weight-bold">NOC:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Respiratory status : Ventilation',
                    'Respiratory status : Airway patency',
                    'Vital sign Status',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="noc[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->noc) && in_array($item, $renpra->noc) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p>Setelah dilakukan asuhan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /> ketidakefektifan perfusi jaringan gastrointestinal teratasi dengan kriteria hasil:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Mendemonstrasikan batuk efektif dan suara nafas yang bersih, tidak ada sianosis dan dyspneu (mampu mengeluarkan sputum, mampu bernafas dg mudah, tidakada pursed lips).',
                    'Menunjukkan jalan nafas yang paten (klien tidak merasa tercekik, irama nafas, frekuensi pernafasan dalam rentang normal, tidak ada suara nafas abnormal)',
                    'Tanda Tanda vital dalam rentang normal (tekanan darah, nadi, pernafasan)',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="kriteria_hasil[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-input" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->kriteria_hasil) && in_array($item, $renpra->kriteria_hasil) ? 'checked' : '' }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-label">
                                {{ $item }}
                            </label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <p class="font-weight-bold">NIC:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Posisikan pasien untuk memaksimalkan ventilasi',
                    'Pasang mayo bila perlu',
                    'Lakukan fisioterapi dada jika perlu',
                    'Keluarkan sekret dengan batuk atau suction',
                    'Auskultasi suara nafas, catat adanya suara tambahan',
                    'Berikan bronkodilator :',
                    'Berikan pelembab udara Kassa basah NaCl Lembab',
                    'Atur intake untuk cairan mengoptimalkan keseimbangan.',
                    'Monitor respirasi dan status O2',
                    'Bersihkan mulut, hidung dan secret trakea',
                    'Pertahankan jalan nafas yang paten',
                    'Observasi adanya tanda tanda hipoventilasi',
                    'Monitor adanya kecemasan pasien terhadap oksigenasi',
                    'Monitor  vital sign',
                    'Informasikan pada pasien dan keluarga tentang tehnik relaksasi untuk memperbaiki pola nafas.',
                    'Ajarkan bagaimana batuk efektif',
                    'Monitor pola nafas',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-input" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->intervensi) && in_array($item, $renpra->intervensi) ? 'checked' : '' }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-label">
                                {{ $item }}
                            </label>
                            @if($index == 5)
                            <input type="text" name="ket_intervensi" id="{{ $renpra->id }}-ket_intervensi" class="form-control rounded-0 input-dotted" value="{{ $renpra->ket_intervensi }}" />
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <input type="text" name="jam" id="{{ $renpra->id }}-jam" class="form-control timepicker rounded-0 border-0" value="{{ $renpra->jam ? $renpra->jam->format('H:i') : ($renpra->tanggal ? $renpra->tanggal->format('H:i') : '') }}" required />
            </td>
            <td class="p-1">
                <textarea name="implementasi" id="{{ $renpra->id }}-implementasi" class="form-control rounded-0 border-0" rows="10" required>{{ $renpra->implementasi }}</textarea>
            </td>
            <td class="p-1 text-center">
                <button type="button" class="mb-2 btn btn-block btn-outline-secondary btn-submit" data-action="save">Simpan</button>
                @if($renpra->status == 1)
                <div class="my-4 w-100">
                    @if (isset($employee))
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                    @else
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                    @endif
                    <div>{{ $renpra->verifikator }}</div>
                </div>
                @else
                @endif
                <button type="button" class="mb-2 btn btn-block btn-success btn-submit" data-action="verify">Verifikasi</button>
            </td>
        </tr>
    </table>
    <div class="w-100 text-right mb-2">RSHM/RI/67.01/Rev.00</div>
</form>
