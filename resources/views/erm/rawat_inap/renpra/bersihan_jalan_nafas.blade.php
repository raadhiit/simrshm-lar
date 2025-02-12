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
                <p><strong>Bersihan jalan nafas tidak efektif</strong> </br> Berhubungan dengan :
                </p>
                <ul class="list-unstyled">
                    @foreach([
                    'Infeksi, disfungsi neuromuskular, hiperplasia dinding bronkus, alergi jalan nafas, asma, trauma',
                    'Obstruksi jalan nafas'
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
                <p>DO:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Dispneu'
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
                <p>DS:</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Penurunan suara nafas',
                    'Orthopneu',
                    'Cyanosis',
                    'Kelainan suara nafas (rales, wheezing)',
                    'Kesulitan berbicara',
                    'Batuk, tidak efekotif atau tidak ada',
                    'Produksi sputum',
                    'Gelisah',
                    'Perubahan frekuensi dan irama nafas'
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ds[]"
                                id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}"
                                {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->ds) && in_array($item,
                            $renpra->ds) ? 'checked' : '' }} />
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
                    pasien menunjukkan keefektifan jalan nafas dibuktikan dengan kriteria hasil :
                </p>
                <ul class="list-unstyled">
                    @foreach([
                    'Mendemonstrasikan batuk efektif dan suara nafas yang bersih, tidak ada sianosis dan dyspneu (mampu
                    mengeluarkan sputum, bernafas dengan mudah, tidak ada pursed lips)',
                    'Menunjukkan jalan nafas yang paten (klien tidak merasa tercekik, irama nafas, frekuensi pernafasan
                    dalam rentang normal, tidak ada suara nafas abnormal)',
                    'Mampu mengidentifikasikan dan mencegah faktor yang penyebab.',
                    'Saturasi O2 dalam batas normal',
                    'Foto thorak dalam batas normal'
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
                    'Pastikan kebutuhan oral / tracheal suctioning.',
                    'Berikan O2',
                    'Anjurkan pasien untuk istirahat dan napas dalam ',
                    'Posisikan pasien untuk memaksimalkan ventilasi',
                    'Lakukan fisioterapi dada jika perlu',
                    'Keluarkan sekret dengan batuk atau suction',
                    'Auskultasi suara nafas, catat adanya suara tambahan',
                    'Berikan bronkodilator',
                    'Monitor status hemodinamik',
                    'Berikan pelembab udara Kassa basah NaCl Lembab',
                    'Berikan antibiotik',
                    'Atur intake untuk cairan mengoptimalkan keseimbangan',
                    'Monitor respirasi dan status O2',
                    'Pertahankan hidrasi yang adekuat untuk mengencerkan sekret',
                    'Jelaskan pada pasien dan keluarga tentang penggunaan peralatan : O2, Suction, Inhalasi.'
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input type="checkbox" name="intervensi[]"
                                id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}"
                                class="form-check-input" value="{{ $item }}" {{ $index==0 ? 'required' : '' }} {{
                                is_array($renpra->intervensi) && in_array($item, $renpra->intervensi) ? 'checked' : ''
                            }} />
                            <label for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}"
                                class="form-check-label">
                                {{ $item }}
                                @if($item == 'Berikan O2')
                                <input type="text" name="intervensi[{{ Str::slug('Berikan O2', '-') }}]"
                                    id="{{ $renpra->id.'-'.Str::slug('Berikan O2', '-') }}"
                                    class="form-control rounded-0 input-dotted"
                                    value="{{ isset($renpra->intervensi[Str::slug('Berikan O2', '-')]) ? $renpra->intervensi[Str::slug('Berikan O2', '-')] : '' }}"
                                    {{ $index==0 ? 'required' : '' }} />
                                metode
                                <input type="text" name="intervensi[{{ Str::slug('metodeO2', '-') }}]"
                                    id="{{ $renpra->id.'-'.Str::slug('metodeO2', '-') }}"
                                    class="form-control rounded-0 input-dotted"
                                    value="{{ isset($renpra->intervensi[Str::slug('metodeO2', '-')]) ? $renpra->intervensi[Str::slug('metodeO2', '-')] : '' }}"
                                    {{ $index==0 ? 'required' : '' }} />
                                @elseif ($item == 'Berikan bronkodilator')
                                <input type="text" name="intervensi[{{ Str::slug('Berikan bronkodilator', '-') }}]"
                                    id="{{ $renpra->id.'-'.Str::slug('Berikan bronkodilator', '-') }}"
                                    class="form-control rounded-0 input-dotted"
                                    value="{{ isset($renpra->intervensi[Str::slug('Berikan bronkodilator', '-')]) ? $renpra->intervensi[Str::slug('Berikan bronkodilator', '-')] : '' }}"
                                    {{ $index==0 ? 'required' : '' }} />
                                @elseif ($item == 'Berikan antibiotik')
                                <input type="text" name="intervensi[{{ Str::slug('Berikan antibiotik', '-') }}]"
                                    id="{{ $renpra->id.'-'.Str::slug('Berikan antibiotik', '-') }}"
                                    class="form-control rounded-0 input-dotted"
                                    value="{{ isset($renpra->intervensi[Str::slug('Berikan antibiotik', '-')]) ? $renpra->intervensi[Str::slug('Berikan antibiotik', '-')] : '' }}"
                                    {{ $index==0 ? 'required' : '' }} />
                                @endif
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
                <button type="button" class="mb-2 btn btn-block btn-outline-secondary btn-submit"
                    data-action="save">Simpan</button>
                @if($renpra->status == 1)
                <div class="my-4 w-100">
                    @if ($renpra->user_verifikator && $renpra->user_verifikator->hrd_employee &&
                    $renpra->user_verifikator->hrd_employee->ttd)
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' . $renpra->user_verifikator->hrd_employee->ttd }}"
                        style="width: 100%;object-fit: contain;" alt="">
                    @else
                    <img src="{{ env('SMIS_UPLOAD_URL') . '/' }}" style="width: 90%;" alt="">
                    @endif
                    <div>{{ $renpra->user_verifikator ? $renpra->user_verifikator->realname : $renpra->verifikator }}
                    </div>
                </div>
                @endif
                <button type="button" class="mb-2 btn btn-block btn-success btn-submit"
                    data-action="verify">Verifikasi</button>
            </td>
        </tr>
    </table>
    <div class="w-100 text-right mb-2">RSHM/RI/59.01/Rev.00</div>
</form>