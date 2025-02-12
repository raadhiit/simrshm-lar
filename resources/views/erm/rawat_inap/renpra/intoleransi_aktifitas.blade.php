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
                <p><strong>Intoleransi aktivitas</strong> Berhubungan dengan :</p>
                <ul class="list-unstyled">
                    @foreach([
                        'Tirah Baring atau imobilisasi', 
                        'Kelemahan menyeluruh', 
                        'Ketidakseimbangan antara suplei oksigen dengan kebutuhan', 
                        'Gaya hidup yang dipertahankan'] as $index => $item )
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
                    @foreach(['Melaporkan secara verbal adanya kelelahan atau kelemahan.', 
                    'Adanya dyspneu atau ketidaknyamanan saat beraktivitas.'] as $index => $item)
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
                    'Respon abnormal dari tekanan darah atau nadi terhadap aktifitas', 
                    'Perubahan ECG : aritmia, iskemia'] as $index => $item)
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
                <p>Setelah dilakukan tindakan keperawatan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /> Pasien bertoleransi terhadap aktivitas dengan</p>
                <p><strong>kriteria Hasil :</strong></p>
                @php
                    $kriteria = ['Berpartisipasi dalam aktivitas fisik tanpa disertai Penigkatan tekanan darah, nadi dan RR', 
                    'Mampu melakukan aktivitas sehari-hari (ADLs) secara mandiri', 
                    'keseimbangan aktivitas dan istirahan']
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
                            'Observasi adanya pembatasan klien dalam melakukan aktivitas',
                            'Kaji adanya faktor yang menyebabkan kelelahan',
                            'Monitor nutrisi dan sumber energi yang adekuat',
                            'Monitor pasien akan adanya kelelahan fisik dan emosi secara berlebihan',
                            'Monitor respon kardivaskuler terhadap aktivitas (takikardi, disritmia, sesak nafas, diaporesis, pucat, perubahan hemodinamik)',
                            'Monitor pola tidur dan lamanya tidur/istirahat pasien',
                            'Kolaborasikan dengan tenaga rehabilitasi medik dalam merencanakan program terapi yang tepat.',
                            'Bantu klien untuk mengidentifikasi aktivitas yang mampu dilakukan',
                            'Bantu untuk memilih aktivitas',
                            'Konsisten yang sesuai dengan kemampuan fisik, psikologi, dan sosial',
                            'Bantu untuk mengidentifikasi dan mendapatkan sumber yang diperlukan untuk aktivitas yang diinginkan',
                            'Bantu untuk mendapatkan alat bantuan aktivitas seperti kursi roda, krek',
                            'Bantu untuk mengidentifikasi aktivitas yang disukai',
                            'Bantu klien untuk membuat jadwal latihan diwaktu luang',
                            'Bantu pasien/keluarga untuk mengidentifikasi kekurangan dalam beraktivitas',
                            'Monitor  respon fisik, emosi, sosial, dan spiritual.'
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
    <div class="col-12 text-right my-2">RSHM/RI/44.01/Rev.00</div>
</div>