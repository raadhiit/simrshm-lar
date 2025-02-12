<form id="form-{{ Illuminate\Support\Str::slug($renpra->nama_renpra, '-') }}" class="form-renpra w-100" method="post" autocomplete="off">
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
                <input class="form-control border-0 rounded-0 datetimepicker" type="text" value="{{$renpra->tanggal->format('d-m-Y H:i')}}" name="tanggal" required />
            </td>
            <td class="p-1">
                <p><strong>Gangguan Pertukaran gas</strong></p>
                <p>Berhubungan dengan :</p>
                <p></p>
                <ul class="list-unstyled">
                    @foreach([
                    'Ketidakseimbangan perfusi ventilasi',
                    'Perubahan membran kapiler-alveolar',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="diagnosa_keperawatan[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->diagnosa_keperawatan) &&
                            in_array($item,
                            $renpra->diagnosa_keperawatan) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <p>DS :</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Sakit kepala ketika bangun',
                    'Dyspnoe',
                    'Gangguan penglihatan',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ds[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->ds) &&
                            in_array($item,
                            $renpra->ds) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <p>DO :</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Penurunan CO2',
                    'Takikardi',
                    'Hiperkapnia',
                    'Keletihan',
                    'Iritabilitas',
                    'Hypoxia',
                    'Kebingungan',
                    'Sianosis',
                    'Warna kulit abnormal (pucat, kehitaman)',
                    'Hipoksemia',
                    'Hiperkarbia',
                    'AGD abnormal',
                    'Frekuensi dan kedalaman nafas abnormal.',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="do[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->do) &&
                            in_array($item,
                            $renpra->do) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <p>Setelah dilakukan tindakan keperawatan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /></p>
                <p>Gangguan pertukaran pasien teratasi dengan kriteria hasil : </p>
                <ul class="list-unstyled">
                    @foreach(
                    [
                    'Mendemonstrasikan peningkatan ventilasi dan oksigenasi yang adekuat',
                    'Memelihara kebersihan paru paru dan bebas dari tanda tanda distress pernafasan',
                    'Mendemonstrasikan batuk efektif dan suara nafas yang bersih, tidak ada sianosis dan dyspneu (mampu mengeluarkan sputum, mampu bernafas dengan mudah, tidak ada pursed lips)',
                    'Tanda tanda vital dalam rentang normal',
                    'AGD dalam batas normal',
                    'Status neurologis dalam batas normal.',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="kriteria_hasil[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-input" value="{{ $item }}" {{ is_array($renpra->kriteria_hasil) && in_array($item, $renpra->kriteria_hasil) ? 'checked' : '' }} {{ $index == 0 ? 'required' : ''}} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-label">
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
                    'Posisikan pasien untuk memaksimalkan ventilasi',
                    'Pasang mayo bila perlu',
                    'Lakukan fisioterapi dada jika perlu',
                    'Keluarkan sekret dengan batuk atau suction',
                    'Auskultasi suara nafas, catat adanya suara tambahan',
                    'Berikan Bronkodilator',
                    'Barikan pelembab udara',
                    'Atur intake untuk cairan mengoptimalkan keseimbangan.',
                    'Monitor respirasi dan status O2',
                    'Catat pergerakan dada,amati kesimetrisan, penggunaan otot tambahan, retraksi otot supraclavicular dan intercostal',
                    'Monitor suara nafas, seperti dengkur',
                    'Monitor pola nafas : bradipena, takipenia, kussmaul, hiperventilasi, cheyne stokes, biot',
                    'Auskultasi suara nafas, catat area penurunan / tidak adanya ventilasi dan suara tambahan',
                    'Monitor TTV, AGD, elektrolit dan ststus mental',
                    'Observasi sianosis khususnya membran mukosa',
                    'Jelaskan pada pasien dan keluarga tentang persiapan tindakan dan tujuan penggunaan alat tambahan (O2, Suction, Inhalasi)',
                    'Auskultasi bunyi jantung, jumlah, irama dan denyut jantung',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-input" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->intervensi) && in_array($item, $renpra->intervensi) ? 'checked' : '' }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-label">
                                {{ $item }}
                                @if($item == 'Berikan Bronkodilator')
                                <input type="text" name="intervensi[{{ Str::slug('Berikan Bronkodilator', '-') }}]" id="{{ $renpra->id.'-'.Str::slug('Berikan Bronkodilator', '-') }}" class="form-control rounded-0 input-dotted" value="{{ isset($renpra->intervensi[Str::slug('Berikan Bronkodilator', '-')]) ? $renpra->intervensi[Str::slug('Berikan Bronkodilator', '-')] : '' }}" {{ $index == 0 ? 'required' : '' }} />
                                @endif
                            </label>
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
    <div class="w-100 text-right mb-2">RSHM/RI/38.01/Rev.00</div>
</form>
