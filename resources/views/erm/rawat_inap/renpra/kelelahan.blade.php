<form id="form-{{Illuminate\Support\Str::slug($renpra->id.' '.$renpra->nama_renpra, '-')}}" class="form-renpra w-100" method="post" autocomplete="off">
    @csrf
    <input type="hidden" name="id_dokumen" value="{{ $renpra->id_dokumen }}"/>
    <input type="hidden" name="nama_renpra" value="{{ $renpra->nama_renpra }}"/>
    <input type="hidden" name="created_at" value="{{ $renpra->created_at }}"/>
    <input type="hidden" name="action" value="save"/>
    <input type="hidden" name="password" value=""/>
    <table class="w-100 table-renpra mt-1">
        @include('erm.rawat_inap.renpra.header', ['renpra' => $renpra])
        <tr class="align-top">
            <td class="p-1">
                <input type="text" name="tanggal" id="{{ $renpra->id }}-tanggal" class="form-control border-0 rounded-0 datetimepicker" value="{{ $renpra->tanggal->format('d-m-Y H:i') }}" {{ $renpra->status ? 'disabled' : '' }} required/>
            </td>
            <td class="p-1">
                <p><strong>kelelahan</strong> Berhubungan dengan :</p>
                <ul class="list-unstyled">
                    @foreach([
                        'Psikologis : kecemasan, gaya hidup yang membosankan, depresi, stress',
                        'Lingkungan : kelembaban, cahaya, kebisingan, suhu',
                        'Situasi : Kejadian hidup yang negatif,', 
                        'Psikologis : Anemia, status penyakit, malnutrisi, kondisi fisik yang buruk, gangguan tidur.',
                        ] as $index => $item )
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                name="diagnosa_keperawatan[]" 
                                id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" 
                                value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->diagnosa_keperawatan) && in_array($item, $renpra->diagnosa_keperawatan ) ? 'checked' : ''}}/>
                            <label class="form-check-label" 
                                for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">
                                {{ $item }}
                            </label>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p>DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                        'Gangguan konsentrasi',
                        'Tidak tertarik pada lingkungan',
                        'Meningkatnya komplain fisik',
                        'Kelelahan',
                        'Secara verbal menyatakan kurang energi'
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                            name="ds[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" 
                            value="{{ $item }}" {{ $index == 0 ? 'required' : ''}}
                            {{ is_array($renpra->ds) && in_array($item, $renpra->ds ) ? 'checked' : ''}}/>
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p>DO:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Penurunan kemampuan',
                    'Ketidakmampuan mempertahankan rutinitas',
                    'Ketidakmampuan mendapatkan energi sesudah tidur',
                    'Kurang energi',
                    'Ketidakmampuan untuk mempertahankan aktivitas fisik',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                            name="do[]" 
                            id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" 
                            value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} 
                            {{ is_array($renpra->do) && in_array($item, $renpra->do ) ? 'checked' : ''}}/>
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <p>Setelah dilakukan tindakan keperawatan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /> 
                    kelelahan pasien teratasi dengan kriteria hasil:</p>
                @php
                    $kriteria = [
                        'Kemampuan aktivitas adekuat',
                        'Mempertahankan nutrisi adekuat',
                        'Keseimbangan aktivitas dan istirahat',
                        'Menggunakan tehnik energi konservasi',
                        'Mempertahankan interaksi sosial',
                        'Mengidentifikasi faktor-faktor fisik dan psikologis yang menyebabkan kelelahan',
                        'Mempertahankan kemampuan untuk konsentrasi'

                        ]
                @endphp
                <ul class="list-unstyled">
                    @foreach($kriteria as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                            name="kriteria_hasil[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" 
                            value="{{ $item }}" {{ $index == 0 ? 'required' : ''}}
                            {{ is_array($renpra->kriteria_hasil) && in_array($item, $renpra->kriteria_hasil ) ? 'checked' : ''}}/>
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <ul class="list-unstyled">
                    @php
                        $intervensi = [
                            'Monitor respon kardiorespirasi terhadap aktivitas (takikardi, disritmia, dispneu, diaphoresis, pucat, tekanan hemodinamik dan jumlah respirasi)',
                            'Monitor dan catat pola dan jumlah tidur pasien',
                            'Monitor lokasi ketidaknyamanan atau nyeri selama bergerak dan aktivitas',
                            'Monitor intake nutrisi',
                            'Monitor pemberian dan efek samping obat depresi',
                            'Instruksikan pada pasien untuk mencatat tanda-tanda dan gejala kelelahan',
                            'Ajarkan tehnik dan manajemen aktivitas untuk mencegah kelelahan',
                            'Jelaskan pada pasien hubungan kelelahan dengan proses penyakit',
                            'Kolaborasi dengan ahli gizi tentang cara meningkatkan intake makanan tinggi energi',
                            'Dorong pasien dan keluarga mengekspresikan perasaannya',
                            'Catat aktivitas yang dapat meningkatkan kelelahan',
                            'Anjurkan pasien melakukan yang meningkatkan relaksasi (membaca, mendengarkan musik)',
                            'Tingkatkan pembatasan bedrest dan aktivitas',
                            'Batasi stimulasi lingkungan untuk memfasilitasi.'
                        ]
                    @endphp
                    @foreach($intervensi as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                            name="intervensi[]" 
                            id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" 
                            value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} 
                            {{ is_array($renpra->intervensi) && in_array($item, $renpra->intervensi ) ? 'checked' : ''}}/>
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <input type="text" name="jam" id="{{ $renpra->id }}-input-jam" class="form-control rounded-0 border-0 timepicker" value="{{ $renpra->jam ? $renpra->jam->format('H:i') : $renpra->tanggal->format('H:i') }}" required/>
            </td>
            <td class="p-1">
                <textarea name="implementasi" id="{{ $renpra->id }}-implementasi" class="form-control rounded-0 border-0" rows="10" {{ $renpra->status ? 'disabled' : '' }} required>{{ $renpra->implementasi }}</textarea>
            </td>
            <td class="p-1 text-center">
                <button type="button" class="mb-2 btn btn-block btn-outline-secondary btn-submit" data-action="save">Simpan</button>
                @if($renpra->status == 1)
                <div class="my-4 w-100">
                    @if ($renpra->user_verifikator && $renpra->user_verifikator->hrd_employee && $renpra->user_verifikator->hrd_employee->ttd)
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $renpra->user_verifikator->hrd_employee->ttd }}" style="width: 100%;object-fit: contain;" alt="">
                    @else
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                    @endif
                    <div>{{ $renpra->user_verifikator ? $renpra->user_verifikator->realname : $renpra->verifikator }}</div>
                </div>
                @else
                @endif
                <button type="button" class="mb-2 btn btn-block btn-success btn-submit" data-action="verify">Verifikasi</button>
            </td>
        </tr>
    </table>
</form>
<div class="row">
    <div class="col-12 text-right my-2">RSHM/RI/47.01/Rev.00</div>
</div>