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
                <p><strong>Defisit Perawatan Diri</strong> </br> Berhubungan dengan :
                </p>
                <p>penurunan atau kurangnya motivasi, hambatan lingkungan, kerusakan muskuloskeletal, kerusakan neuromuskular, nyeri, kerusakan persepsi/ kognitif, kecemasan, kelemahan dan kelelahan</p>
                <p>DO:</p>
                <ul class="list-unstyled">
                    @foreach([
                        'Ketidakmampuan untuk mandi',
                        'Ketidakmampuan untuk berpakaian',
                        'Ketidakmampuan untuk makan',
                        'Ketidakmampuan untuk toileting'
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
                        Defisit perawatan diri teratas dengan kriteria hasil :
                </p>
                <ul class="list-unstyled">
                    @foreach([
                        'Klien terbebas dari bau badan',
                        'Menyatakan kenyamanan terhadap kemampuan untuk melakukan ADLs',
                        'Dapat melakukan ADLS dengan bantuan'
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
                        'Monitor kemempuan klien untuk perawatan diri yang mandiri.',
                        'Monitor kebutuhan klien untuk alat-alat bantu untuk kebersihan diri, berpakaian, berhias, toileting dan makan.',
                        'Sediakan bantuan sampai klien mampu secara utuh untuk melakukan self-care.',
                        'Dorong klien untuk melakukan aktivitas sehari-hari yang normal sesuai kemampuan yang dimiliki.',
                        'Dorong untuk melakukan secara mandiri, tapi beri bantuan ketika klien tidak mampu melakukannya.',
                        'Ajarkan klien/ keluarga untuk mendorong kemandirian, untuk memberikan bantuan hanya jika pasien tidak mampu untuk melakukannya.',
                        'Berikan aktivitas rutin sehari- hari sesuai kemampuan.',
                        'Pertimbangkan usia klien jika mendorong pelaksanaan aktivitas sehari-hari.'
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

