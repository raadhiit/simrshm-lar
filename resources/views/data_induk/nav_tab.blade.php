<div class="card-header">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class=" nav-link {{ $role == 'bagian' ? 'active' : '' }}" href="{{ route('bagian.index') }}"
                style="font-weight:bold;"><i class="fas fa-star"></i>Bagian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $role == 'pendidikan' ? 'active' : '' }}" href="{{ route('pendidikan.index') }}"
                style="font-weight:bold;"><i class="fas fa-graduation-cap"></i> Pendidikan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $role == 'ruangan_pegawai' ? 'active' : '' }}"
                href="{{ route('ruangan_pegawai.index') }}" style=" font-weight:bold;"><i class="fas fa-university"></i>
                Ruangan Pegawai</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $role == 'status_tenaga' ? 'active' : '' }}" href="{{ route('status_tenaga.index') }}"
                style="font-weight:bold;"><i class="fas fa-users"></i> Status Tenaga</a>
        </li>
    </ul>

</div>
