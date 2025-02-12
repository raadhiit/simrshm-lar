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
                <p><strong>Nyeri Kronis</strong> berhubungan dengan ketidakmampuan fisik-psikososial kronis (metastase kanker, injuri neurologis, artritis)</p>
                <p>DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Kelelahan',
                    'Takut untuk injuri ulang',
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
                    'Atropi otot',
                    'Gangguan aktifitas',
                    'Anoreksia',
                    'Perubahan pola tidur',
                    'Respon simpatis (suhu dingin, perubahan posisi tubuh , hipersensitif, perubahan berat badan)',
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
                <p>Setelah dilakukan asuhan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /> Nyeri kronis pasien berkurang dengan kriteria hasil :</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Tidak ada gangguan tidur',
                    'Tidak ada gangguan konsentrasi',
                    'Tidak ada gangguan hubungan interpersonal',
                    'Tidak ada ekspresi menahan nyeri dan ungkapan secara verbal',
                    'Tidak ada tegangan otot',
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
                    'Monitor kepuasan pasien terhadap manajemen nyeri',
                    'Tingkatkan istirahat dan tidur yang adekuat',
                    'Kelola analgetik',
                    'Nyeri',
                    'Lakukan tehnik nonfarmakologis (relaksasi, masase punggung).',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-input" value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} {{ is_array($renpra->intervensi) && in_array($item, $renpra->intervensi) ? 'checked' : '' }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-label">
                                {{ $item }}
                                @if($item == 'Kelola analgetik')
                                <input type="text" name="intervensi[{{ Str::slug('Kelola analgetik', '-') }}]" id="{{ $renpra->id.'-'.Str::slug('Kelola analgetik', '-') }}" class="form-control rounded-0 input-dotted" value="{{ isset($renpra->intervensi[Str::slug('Kelola analgetik', '-')]) ? $renpra->intervensi[Str::slug('Kelola analgetik', '-')] : '' }}" {{ $index == 0 ? 'required' : '' }} />
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
    <div class="w-100 text-right mb-2">RSHM/RI/54.01/Rev.00</div>
</form>
