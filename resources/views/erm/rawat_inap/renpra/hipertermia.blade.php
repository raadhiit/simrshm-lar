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
                <p><strong>Hipertermia,</strong> </br> Suatu kondisi dimana suhu tubuh meningkat drastis dari suhu normal Berhubungan dengan :
                </p>
                <ul class="list-unstyled">
                    @foreach([
                    'Penyakit/ trauma',
                    'Peningkatan metabolisme',
                    'Aktivitas yang berlebih',
                    'Dehidrasi'
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
                <p>DO/DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Kenaikan suhu tubuh diatas rentang normal',
                    'Serangan atau konvulsi (kejang)',
                    'Kulit kemerahan',
                    'Pertambahan RR',
                    'Takikardi',
                    'Kulit teraba panas / hangat.'
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
                <p>Thermoregulasi</p>
                <br>
                <p>Setelah dilakukan tindakan keperawatan selama
                    <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan"
                        class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required />
                    pasien menunjukkan : Suhu tubuh dalam batas normal dengan kreiteria hasil :
                </p>
                <ul class="list-unstyled">
                    @foreach(['Suhu 36,5 - 37,5 °C',
                    'Nadi dan RR dalam rentang normal',
                    'Tidak ada perubahan warna kulit dan tidak ada pusing, merasa nyaman.'
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
                        'Monitor suhu sesering mungkin',
                        'Monitor warna dan suhu kulit',
                        'Monitor tekanan darah, nadi dan RR',
                        'Monitor penurunan tingkat kesadaran',
                        'Monitor WBC, Hb, dan Hct',
                        'Monitor intake dan output',
                        'Berikan anti piretik:',
                        'Selimuti pasien',
                        'Berikan cairan intravena',
                        'Kompres pasien pada lipat paha dan aksila',
                        'Tingkatkan sirkulasi udara',
                        'Tingkatkan intake cairan dan nutrisi',
                        'Monitor TD, nadi, suhu, dan RR',
                        'Catat adanya fluktuasi tekanan darah',
                        'Monitor hidrasi seperti turgor kulit, kelembaban membran mukosa.'
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
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.'Kelola Antibiotik', '-') }}" class="form-check-input" value="Kelola Antibiotik" {{ $renpra->status ? 'disabled' : '' }} {{ is_array($renpra->intervensi) && in_array('Kelola Antibiotik', $renpra->intervensi) ? 'checked' : '' }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.'Kelola Antibiotik', '-') }}" class="form-check-label">
                                Kelola Antibiotik
                                <input type="text" name="intervensi[{{ Str::slug('Kelola Antibiotik', '-') }}]" id="{{ $renpra->id.'-'.Str::slug('Kelola Antibiotik', '-') }}" class="form-control rounded-0 input-dotted" value="{{ isset($renpra->intervensi[Str::slug('Kelola Antibiotik', '-')]) ? $renpra->intervensi[Str::slug('Kelola Antibiotik', '-')] : '' }}" {{ $renpra->status ? 'disabled' : '' }} />
                            </label>
                        </div>
                    </li>
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
                <button type="button" class="mb-2 btn btn-block btn-outline-secondary btn-submit"
                    data-action="save">Simpan</button>
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
                <button type="button" class="mb-2 btn btn-block btn-success btn-submit"
                    data-action="verify">Verifikasi</button>
            </td>
        </tr>
    </table>
    <div class="w-100 text-right mb-2">RSHM/RI/59.01/Rev.00</div>
</form>
