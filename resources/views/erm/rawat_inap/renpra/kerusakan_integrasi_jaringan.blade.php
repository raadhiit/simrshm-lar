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
            <td>
                <p><strong>Kerusakan integritas jaringan </strong> 
                    berhubungan dengan :
                    Gangguan sirkulasi, iritasi kimia (ekskresi dan sekresi tubuh, medikasi), defisit cairan, kerusakan mobilitas fisik, keterbatasan pengetahuan, faktor mekanik (tekanan, gesekan),kurangnya nutrisi, radiasi, faktor suhu (suhu yang ekstrim)</p>
                <p>DO:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Kerusakan jaringan (membran mukosa, integumen, subkutan)'] as $index => $item)
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
                    kerusakan integritas jaringan pasien teratasi dengan kriteria hasil :
                </p>
                @php
                    $kriteria = [
                        'Perfusi jaringan normal',
                        'Tidak ada tanda-tanda infeksi',
                        'Ketebalan dan tekstur jaringan normal',
                        'Menunjukkan pemahaman dalam proses perbaikan kulit dan mencegah terjadinya cidera berulang',
                        'Menunjukkan  terjadinya proses penyembuhan luka.',
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
                            'Anjurkan pasien untuk menggunakan pakaian yang longgar',
                            'Jaga kulit agar tetap bersih dan kering',
                            'Mobilisasi pasien (ubah posisi pasien) setiap dua jam sekali',
                            'Monitor kulit akan adanya kemerahan',
                            'Oleskan lotion atau minyak/baby oil pada daerah yang tertekan ',
                            'Monitor aktivitas dan mobilisasi pasien',
                            'Monitor status nutrisi pasien',
                            'Memandikan pasien dengan sabun dan air hangat', 
                            'Kaji lingkungan dan peralatan yang menyebabkan tekanan',
                            'Observasi luka : lokasi, dimensi, kedalaman luka, karakteristik,warna cairan, granulasi, jaringan nekrotik, tanda-tanda infeksi lokal, formasi traktus',
                            'Ajarkan pada keluarga tentang luka dan perawatan luka',
                            'Kolaborasi ahli gizi pemberian diet TKTP, vitamin',
                            'Cegah kontaminasi feses dan urin',
                            'Lakukan tehnik perawatan luka dengan steril',
                            'Berikan posisi yang mengurangi tekanan pada luka',
                            'Hindari kerutan pada tempat tidur.',
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
    <div class="col-12 text-right my-2">RSHM/RI/48.01/Rev.00</div>
</div>