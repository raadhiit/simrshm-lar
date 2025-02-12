<form id="form-{{ Illuminate\Support\Str::slug($renpra->nama_renpra, '-') }}" class="form-renpra w-100" method="post" autocomplete="off">
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
                <p><strong>Gangguan mobilitas fisik</strong></p>
                <p>Berhubungan dengan :</p>
                <p></p>
                <ul class="list-unstyled">
                    @foreach([
                    'Gangguan metabolisme sel',
                    'Keterlembatan perkembangan',
                    'Pengobatan',
                    'Kurang support lingkungan',
                    'Keterbatasan ketahan kardiovaskuler',
                    'Terapi pembatasan gerak',
                    'Kurang pengetahuan tentang kegunaan pergerakan fisik',
                    'Kerusakan persepsi sensori',
                    'Tidak nyaman, nyeri',
                    'Kerusakan muskuloskeletal dan neuromuskuler',
                    'Intoleransi aktivitas/penurunan kekuatan dan stamina',
                    'Penurunan kekuatan otot, kontrol dan atau masa',
                    'Keengganan untuk memulai gerak',
                    'Malnutrisi selektif atau umum',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="diagnosa_keperawatan[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->diagnosa_keperawatan) &&
                            in_array($item,
                            $renpra->diagnosa_keperawatan) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <p>DO :</p>
                <ul class="list-unstyled">
                    @foreach([
                    'Penurunan waktu reaksi',
                    'Kesulitan merubah posisi',
                    'Perubahan gerakan (penurunan untuk berjalan, kecepatan, kesulitan memulai langkah pendek)',
                    'Keterbatasan motorik kasar dan halus',
                    'Keterbatasan ROM',
                    'Gerakan disertai nafas pendek atau tremor',
                    'Ketidak stabilan posisi selama melakukan ADL',
                    'Gerakan sangat lambat dan tidak terkoordinasi',
                    ] as $index => $item)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="do[]" id="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}" value="{{ $item }}" {{ $index==0 ? 'required' : '' }} {{ is_array($renpra->do) &&
                            in_array($item,
                            $renpra->do) ? 'checked' : '' }} />
                            <label class="form-check-label" for="{{ Illuminate\Support\Str::slug($renpra->id.' '.$item, '-') }}">{{ $item }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td class="p-1">
                <p>Setelah dilakukan tindakan keperawatan selama <input type="text" name="lama_tindakan" id="{{ $renpra->id }}-lama_tindakan" class="form-control rounded-0 input-dotted" value="{{ $renpra->lama_tindakan }}" required /> gangguan mobilitas pfisik teratasi dengan kriteria hasil :</p>
                <ul class="list-unstyled">
                    @foreach(
                    [
                    'Klien meningkat dalam aktivitas fisik',
                    'Mengerti tujuan dari peningkatan mobilitas',
                    'Memverbalisasikan perasaan dalam meningkatkan kekuatan dan kemampuan berpindah',
                    'Memperagakan penggunaan alat bantu untuk mobilisasi (walker).',
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
                    'Monitoring vital sign sebelm/sesudah latihan dan lihat respon pasien saat latihan',
                    'Konsultasikan dengan terapi fisik tentang rencana ambulasi sesuai dengan kebutuhan',
                    'Bantu klien untuk menggunakan tongkat saat berjalan dan cegah terhadap cedera',
                    'Ajarkan pasien atau tenaga kesehatan lain tentang teknik ambulasi',
                    'Kaji kemampuan pasien dalam mobilisasi',
                    'Latih pasien dalam pemenuhan kebutuhan ADLs secara mandiri sesuai kemampuan',
                    'Dampingi dan Bantu pasien saat mobilisasi dan bantu penuhi kebutuhan ADLs ps.',
                    'Berikan alat Bantu jika klien memerlukan.',
                    'Ajarkan pasien bagaimana merubah posisi dan berikan bantuan jika diperlukan.',
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
    <div class="w-100 text-right mb-2">RSHM/RI/40.01/Rev.00</div>
</form>
