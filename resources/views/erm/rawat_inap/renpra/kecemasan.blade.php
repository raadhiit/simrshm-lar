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
                <p><strong>Kecemasan </strong> berhubungan dengan faktor keturunan, krisis situasional, stress, perubahan status kesehatan, ancaman kematian, perubahan konsep diri, kurang pengetahuan dan hospitalisasi.</p>
                <p>DO/DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Insomnia', 
                    'Kurang istirahat',
                    'Berfokus pada diri sendiri',
                    'Iritabilitas',
                    'Takut',
                    'Nyeri perut',
                    'Penurunan TD dan denyut nadi',
                    'Diare, mual, kelelahan',
                    'Gangguan tidur',
                    'Gemetar',
                    'Anoreksia, mulut kering',
                    'Peningkatan TD, denyut nadi, RR',
                    'Kesulitan bernafas',
                    'Bingung',
                    'Sulit berkonsentrasi',
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
                <p>Setelah dilakukan tindakan asuhan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /> Klien kecemasan teratasi dengan</p>
                <p><strong>kriteria Hasil :</strong></p>
                @php
                    $kriteria = [
                    'Klien mampu mengidentifikasi dan mengungkapkan gejala cemas', 
                    'Mengidentifikasi, mengungkapkan dan menunjukkan teknik untuk mengontrol cemas', 
                    'Vital sign dalam batas normal',
                    'Postur tubuh, ekspresi wajah, bahasa tubuh, dan tingkat aktivitas menunjukkan berkurangnya kecemasan',
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
                            'Gunakan pendekatan yang menenangkan',
                            'Nyatakan dengan jelas harapan terhadap pelaku pasien',
                            'Jelaskan semua prosedur dan apa yang dirasakan selama prosedur',
                            'Temani pasien untuk memberikan keamanan dan mengurangi takut',
                            'Berikan informasi faktual mengenai diagnosis, tindakan prognosis',
                            'Libatkan keluarga untuk mendampingi klien',
                            'Instruksikan pada pasien untuk menggunakan teknik relaksasi',
                            'Dengarkan dengan penuh perhatian',
                            'Identifikasi tingkat kecemasan',
                            'Bantu pasien mengenal situasi yang menimbulkan kecemasan',
                            'Dorong pasien untuk mengungkapkan perasaan, ketakutan, persepsi',
                            'Kelola pemberian obat anti cemas:',
                        ]
                    @endphp
                    @foreach($intervensi as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input {{$item == 'Kelola pemberian obat anti cemas:' ? 'check-with-input': ''}}" type="checkbox" 
                            name="intervensi[]" 
                            id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" 
                            value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} 
                            {{ is_array($renpra->intervensi) && in_array($item, $renpra->intervensi ) ? 'checked' : ''}}/>
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                            @if($item == 'Kelola pemberian obat anti cemas:')
                                <input type="text" name="intervensi[{{ Str::slug($item) }}]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}-obat" 
                                class="form-control rounded-0 input-dotted input-with-check" 
                                value="{{ isset($renpra->intervensi[Str::slug($item)]) ? $renpra->intervensi[Str::slug($item)] : '' }}" />
                            @endif
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
    <div class="col-12 text-right my-2">RSHM/RI/45.01/Rev.00</div>
</div>