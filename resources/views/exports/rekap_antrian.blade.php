<table>
    <thead>
        <tr>
            <th colspan="13" align="center"><b>REKAP ANTRIAN</b></th>
        </tr>
        <tr>
            <th colspan="13" align="center"><b>Tanggal {{ date('d-m-Y', strtotime($dari)) }} sampai {{ date('d-m-Y', strtotime($sampai)) }}</b></th>
        </tr>
    </thead>
</table>
<table border="1">
    <thead>
        <tr>
            <th align="center"><b>Tanggal</b></th>
            <th align="center"><b>Nama Poli</b></th>
            <th align="center"><b>Kode Booking</b></th>
            <th align="center"><b>Nomor Antrian</b></th>
            <th align="center"><b>Nama Pasien</b></th>
            <th align="center"><b>No. RM</b></th>
            <th align="center"><b>Task 1</b></th>
            <th align="center"><b>Task 2</b></th>
            <th align="center"><b>Task 3</b></th>
            <th align="center"><b>Task 4</b></th>
            <th align="center"><b>Task 5</b></th>
            <th align="center"><b>Task 6</b></th>
            <th align="center"><b>Task 7</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ date('d-m-Y', strtotime($d->tanggalperiksa)) }}</td>
            <td>{{$d->namapoli}}</td>
            <td align="center">{{$d->kodebooking}}</td>
            <td align="center">{{$d->nomorantrean}}</td>
            <td>{{$d->nama}}</td>
            <td align="center">{{$d->norm}}</td>
            <td align="center">
                <?php
                if ($d->pasien_baru == 1) {
                    if ($d->waktu_checkin != '' && $d->waktu_checkin != null) {
                        echo date('d-m-Y H:i:s A', ($d->waktu_checkin/1000));
                    }
                }
                ?>
            </td>
            <td align="center">
                @if($d->waktu_taskid_dua != null && $d->waktu_taskid_dua != '')
                {{ date('d-m-Y H:i:s A', ($d->waktu_taskid_dua/1000)) }}
                @endif
            </td>
            <td align="center">
                <?php
                if ($d->pasien_baru == 0) {
                    if ($d->waktu_checkin != '' && $d->waktu_checkin != null) {
                        echo date('d-m-Y H:i:s A', ($d->waktu_checkin/1000));
                    }
                } else {
                    if ($d->waktu_taskid_tiga != '' && $d->waktu_taskid_tiga != null) {
                        echo date('d-m-Y H:i:s A', ($d->waktu_taskid_tiga/1000));
                    }
                }
                ?>
            </td>
            <td align="center">
                @if($d->waktu_taskid_empat != null && $d->waktu_taskid_empat != '')
                {{ date('d-m-Y H:i:s A', ($d->waktu_taskid_empat/1000)) }}
                @endif
            </td>
            <td align="center">
                @if($d->waktu_taskid_lima != null && $d->waktu_taskid_lima != '')
                {{ date('d-m-Y H:i:s A', ($d->waktu_taskid_lima/1000)) }}
                @endif
            </td>
            <td align="center">
                @if($d->waktu_taskid_enam != null && $d->waktu_taskid_enam != '')
                {{ date('d-m-Y H:i:s A', ($d->waktu_taskid_enam/1000)) }}
                @endif
            </td>
            <td align="center">
                @if($d->waktu_taskid_tujuh != null && $d->waktu_taskid_tujuh != '')
                {{ date('d-m-Y H:i:s A', ($d->waktu_taskid_tujuh/1000)) }}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>