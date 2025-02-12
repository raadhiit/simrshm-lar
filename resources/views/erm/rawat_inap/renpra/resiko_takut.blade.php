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
                <span><b>Takut</b><br> berhubungan dengan efek terhadap gaya hidup, kebutuhan injeksi secara mandiri, komplikasi DM, ditandai dengan</span><br>
                <span>DS :</span><br>
                <span>Peningkatan ketegangan,panik, penurunan kepercayaan diri, cemas</span><br>
                <span>DO :</span><br>
                <span>Penurunan produktivitas, kemampuan belajar, kemampuan menyelesaikan masalah, mengidentifikasi obyek ketakutan, peningkatan kewaspadaan, anoreksia, mulut kering, diare, mual, pucat, muntah, perubahan tanda-tanda vital.</span>
            </td>
            <td class="p-1">
                <p>Setelah dilakukan tindakan keperawatan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /> takut klien teratasi dengan kriteria hasil  :</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Memiliki informasi untuk mengurangi takut.',
                    'Menggunakan tehnik relaksasi.',
                    'Mempertahankan hubungan sosial dan fungsi peran',
                    'Mengontrol respon takut.',
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
                    'Jelaskan pada pasien tentang proses penyakit',
                    'Jelaskan semua tes dan pengobatan pada pasien dan keluarga',
                    'Sediakan reninforcement positif ketika pasien melakukan perilaku untuk mengurangi takut',
                    'Sediakan perawatan yang berkesinambungan',
                    'Kurangi stimulasi lingkungan yang dapat menyebabkan misinterprestasi',
                    'Dorong mengungkapkan secara verbal perasaan, persepsi dan rasa takutnya',
                    'Perkenalkan dengan orang yang mengalami penyakit yang sama',
                    'Dorong klien untuk mempraktekan tehnik relaksasi.',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-input" value="{{ $item }}" {{ is_array($renpra->intervensi) && in_array($item, $renpra->intervensi) ? 'checked' : '' }} {{ $index == 0 ? 'required' : '' }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" class="form-check-label">
                                {{ $item }}
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
