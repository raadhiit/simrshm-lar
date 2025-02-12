<form id="form-{{ Illuminate\Support\Str::slug($renpra->id.' '.$renpra->nama_renpra, '-') }}" class="form-renpra w-100" method="post" autocomplete="off">
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
                <p><b>Mual</b> berhubungan dengan:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Pengobatan : iritasi gaster, distensi gaster, obat kemoterapi, toksin',
                    'Biofisika : gangguan biokimia (KAD, Uremia), nyeri jantung, tumor intra abdominal, penyakit oesofagus / pankreas.',
                    'Situasional : faktor psikologis seperti nyeri, takut, cemas.',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="diagnosa_keperawatan[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->diagnosa_keperawatan) && in_array($item, $renpra->diagnosa_keperawatan) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <p>DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Hipersalivasi',
                    'Penigkatan reflek menelan',
                    'Menyatakan mual / sakit perut',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ds[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->ds) && in_array($item, $renpra->ds) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <p>Setelah dilakukan asuhan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /> mual pasien teratasi dengan kriteria hasil:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Melaporkan bebas dari mual',
                    'Mengidentifikasi hal-hal yang mengurangi mual',
                    'Nutrisi adekuat',
                    'Status hidrasi: hidrasi kulit membran mukosa baik, tidak ada rasa haus yang abnormal, panas, urin output normal, TD, HCT normal.',
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
                <ul class="list-unstyled">
                    @foreach([
                    'Pencatatan intake output secara akurat',
                    'Monitor status nutrisi',
                    'Monitor status hidrasi (Kelembaban membran mukosa, vital sign adekuat)',
                    'Anjurkan untuk makan pelan-pelan',
                    'Jelaskan untuk menggunakan napas dalam untuk menekan reflek mual',
                    'Batasi minum 1 jam sebelum, 1 jam sesudah dan selama makan',
                    'Instruksikan untuk menghindari bau makanan yang menyengat',
                    'Berikan terapi IV kalau perlu',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-input" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->intervensi) && in_array($item, $renpra->intervensi) ? 'checked' : '' }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-label">
                                {{ $item }}
                            </label>
                        </div>
                    </li>
                    @endforeach
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.'Kelola pemberian anti emetik', '-') }}" class="form-check-input" value="Kelola pemberian anti emetik" {{ is_array($renpra->intervensi) && in_array('Kelola pemberian anti emetik', $renpra->intervensi) ? 'checked' : '' }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.'Kelola pemberian anti emetik', '-') }}" class="form-check-label">
                                Kelola pemberian anti emetik
                                <input type="text" name="intervensi[{{ Str::slug('Kelola pemberian anti emetik', '-') }}]" id="{{ $renpra->id.'-'.Str::slug('Kelola pemberian anti emetik', '-') }}-input" class="form-control rounded-0 input-dotted" value="{{ isset($renpra->intervensi[Str::slug('Kelola pemberian anti emetik', '-')]) ? $renpra->intervensi[Str::slug('Kelola pemberian anti emetik', '-')] : '' }}" />
                            </label>
                        </div>
                    </li>
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
    <div class="w-100 text-right mb-2">RSHM/RI/52.01/Rev.00</div>
</form>