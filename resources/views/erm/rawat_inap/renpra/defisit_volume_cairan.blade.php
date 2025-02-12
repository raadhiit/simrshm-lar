<form id="form-{{ Illuminate\Support\Str::slug($renpra->nama_renpra, '-') }}" class="form-renpra w-100" method="post"
    autocomplete="off">
    @csrf
    <input type="hidden" name="id_dokumen" value="{{ $renpra->id_dokumen }}" />
    <input type="hidden" name="nama_renpra" value="{{ $renpra->nama_renpra }}" />
    <input type="hidden" name="created_at" value="{{ $renpra->created_at }}" />
    <input type="hidden" name="action" value="save" />
    <input type="hidden" name="password" value="" />
    <table class="w-100 table-renpra mt-1">
        @include('erm.rawat_inap.renpra.header', ['renpra' => $renpra])
        <tr class="align-top">
            <td class="p-1">
                <input class="form-control border-0 rounded-0 datetimepicker" type="text"
                    value="{{$renpra->tanggal->format('d-m-Y H:i')}}" name="tanggal" required />
            </td>
            <td class="p-1">
                <p><strong>Defisit Volume Cairan</strong> </br> Berhubungan dengan :
                </p>
                <ul class="list-unstyled">
                    @foreach([
                    'Kehilangan volume cairan secara aktif',
                    'Kegagalan mekanisme pengaturan'
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="diagnosa_keperawatan[]"
                                id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}"
                                {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->diagnosa_keperawatan) &&
                            in_array($item,
                            $renpra->diagnosa_keperawatan) ? 'checked' : '' }} />
                            <label class="form-check-label"
                                for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p>DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Haus'
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ds[]"
                                id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}"
                                {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->ds) && in_array($item,
                            $renpra->ds) ? 'checked' : '' }} />
                            <label class="form-check-label"
                                for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p>DO:</p>
                <ul class="list-unstyled">
                    @foreach([
                        'Penurunan turgor kulit/lidah',
                        'Membran mukosa/kulit kering',
                        'Peningkatan denyut nadi, penurunan tekanan darah, penurunan volume/tekanan nadi',
                        'Pengisian vena menurun',
                        'Perubahan status mental',
                        'Konsentrasi urine meningkat',
                        'Temperatur tubuh meningkat',
                        'Kehilangan berat badan secara tiba-tiba',
                        'Penurunan urine output',
                        'HMT meningkat',
                        'Kelemahan'
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="do[]"
                                id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}"
                                {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->do) && in_array($item,
                            $renpra->do) ? 'checked' : '' }} />
                            <label class="form-check-label"
                                for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <p>Setelah dilakukan tindakan keperawatan selama
                    <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan"
                        class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required />
                        defisit volume cairan teratasi dengan kriteria hasil :
                </p>
                <ul class="list-unstyled">
                    @foreach([
                        'Mempertahankan urine output sesuai dengan usia dan BB, BJ urine normal',
                        'Tekanan darah, nadi, suhu tubuh dalam batas normal',
                        'Tidak ada tanda tanda dehidrasi, Elastisitas turgor kulit baik, membran mukosa lembab, tidak ada rasa haus yang berlebihan',
                        'Orientasi terhadap waktu dan tempat baik',
                        'Jumlah dan irama pernapasan dalam batas normal',
                        'Elektrolit, Hb, Hmt dalam batas normal',
                        'pH urin dalam batas normal',
                        'Intake oral dan intravena adekuat',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="kriteria_hasil[]"
                                id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}"
                                class="form-check-input" value="{{ $item }}" {{ is_array($renpra->kriteria_hasil) &&
                            in_array($item, $renpra->kriteria_hasil) ? 'checked' : '' }} {{ $index == 0 ? 'required' :
                            ''}} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}"
                                class="form-check-label">
                                {{ $item }}
                            </label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <ul class="list-unstyled">
                    @foreach([
                        'Pertahankan catatan intake dan output yang akurat',
                        'Monitor status hidrasi (kelembaban membran mukosa, nadi adekuat, tekanan darah ortostatik), jika diperlukan',
                        'Monitor hasil lab yang sesuai dengan retensi cairan (BUN , Hmt , osmolalitas urin, albumin, total protein)',
                        'Monitor vital sign setiap 15menit - 1 jam',
                        'Kolaborasi pemberian cairan IV',
                        'Monitor status nutrisi',
                        'Berikan cairan oral',
                        'Berikan penggantian nasogatrik sesuai output (50 - 100cc/jam)',
                        'Dorong keluarga untuk membantu pasien makan',
                        'Kolaborasi dokter jika tanda cairan berlebih muncul meburuk',
                        'Atur kemungkinan tranfusi',
                        'Persiapan untuk tranfusi',
                        'Pasang kateter jika perlu',
                        'Monitor intake dan urin output setiap 8 jam'
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]"
                                id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}"
                                class="form-check-input" value="{{ $item }}" {{ is_array($renpra->intervensi) &&
                            in_array($item, $renpra->intervensi) ? 'checked' : '' }} {{ $index == 0 ? 'required' : '' }}
                            />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}"
                                class="form-check-label">
                                {{ $item }}
                            </label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <input type="text" name="jam" id="{{ $renpra->id }}-jam"
                    class="form-control timepicker rounded-0 border-0"
                    value="{{ $renpra->jam ? $renpra->jam->format('H:i') : ($renpra->tanggal ? $renpra->tanggal->format('H:i') : '') }}"
                    required />
            </td>
            <td class="p-1">
                <textarea name="implementasi" id="{{ $renpra->id }}-implementasi"
                    class="form-control rounded-0 border-0" rows="10" required>{{ $renpra->implementasi }}</textarea>
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
                @endif
                <button type="button" class="mb-2 btn btn-block btn-success btn-submit" data-action="verify">Verifikasi</button>
            </td>
        </tr>
    </table>
    <div class="w-100 text-right mb-2">RSHM/RI/59.01/Rev.00</div>
</form>

