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
                <p><strong>Kelebihan Volume Cairan</strong> Berhubungan dengan :</p>
                <ul class="list-unstyled">
                    @foreach([
                        'Mekanisme pengaturan melemah', 
                        'Asupan cairan berlebihan'] as $index => $item )
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
                <p>DO/DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Berat badan meningkat pada waktu singkat', 
                    'Asupan berlebihan dibanding output', 
                    'Distensi vena jugularis', 
                    'Perubahan pada pola nafas, dyspnoe/sesak nafas, orthopnoe, suara nafas abnormal (Rales atau crakles), pleural effusion', 
                    'Oliguria, azotemia', 
                    'Perubahan status mental, kegelisahan, kecemasan'
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
                    Kelebihan volume cairan teratasi dengan kriteria</p>
                @php
                    $kriteria = [
                        'Terbebas dari edema, efusi, anaskara',
                        'Bunyi nafas bersih, tidak ada dyspneu/ortopneu',
                        'Terbebas dari distensi vena jugularis', 
                        'Memelihara tekanan vena sentral, tekanan kapiler paru, output jantung dan vital sign DBN',
                        'Terbebas dari kelelahan, kecemasan atau bingung.',
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
                            'Pertahankan catatan intake dan output yang akurat',
                            'Pasang urin kateter jika diperlukan',
                            'Monitor hasil lab yang sesuai dengan retensi cairan (BUN , Hmt , osmolalitas urin)',
                            'Monitor vital sign',
                            'Monitor indikasi retensi / kelebihan cairan (cracles, CVP , edema, distensi vena leher, asites)',
                            'Kaji lokasi dan luas edema',
                            'Monitor masukan makanan / cairan', 
                            'Monitor status nutrisi',
                            'Berikan diuretik sesuai interuksi',
                            'Kolaborasi pemberian obat:',
                            'Monitor berat badan',
                            'Monitor  elektrolit', 
                            'Monitor tanda dan gejala dari odema'
                        ]
                    @endphp
                    @foreach($intervensi as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input {{$item == 'Kolaborasi pemberian obat:' ? 'check-with-input': ''}}" type="checkbox" 
                            name="intervensi[]" 
                            id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" 
                            value="{{ $item }}" {{ $index == 0 ? 'required' : '' }} 
                            {{ is_array($renpra->intervensi) && in_array($item, $renpra->intervensi ) ? 'checked' : ''}}/>
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                            @if($item == 'Kolaborasi pemberian obat:')
                                <input type="text" name="intervensi[{{ Str::slug($item) }}]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}-obat" class="form-control rounded-0 input-dotted input-with-check" 
                                    value="{{ isset($renpra->intervensi[Str::slug($item)]) ? $renpra->intervensi[Str::slug($item)] : '' }}"/>
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
    <div class="col-12 text-right my-2">RSHM/RI/46.01/Rev.00</div>
</div>