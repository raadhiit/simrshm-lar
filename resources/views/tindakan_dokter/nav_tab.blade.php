<style type="text/css" media="screen">
    .nav-tabs {
        overflow-x: auto;
        overflow-y: hidden;
        flex-wrap: nowrap;
        transform: rotateX(180deg);
    }

    .nav-tabs .nav-link {
        white-space: nowrap;
        transform: rotateX(180deg);
    }
</style>

<div class="card-header">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class=" nav-link {{ $role == 'konsul_dokter' ? 'active' : '' }}" href="{{ route('konsul_dokter.index') }}"
                style="font-weight:bold;"><i class="fas fa-list-alt"></i>Konsul Dokter</a>
        </li>
        <li class="nav-item">
            <a class=" nav-link {{ $role == 'visite_dokter' ? 'active' : '' }}" href="{{ route('visite_dokter.index') }}"
                style="font-weight:bold;"><i class="fas fa-medkit"></i>Visite Dokter</a>
        </li>
        <li class="nav-item">
            <a class=" nav-link {{ $role == 'periksa_dokter' ? 'active' : '' }}" href="{{ route('periksa_dokter.index') }}"
                style="font-weight:bold;"><i class="fas fa-heartbeat"></i>Periksa Dokter</a>
        </li>
        <li class="nav-item">
            <a class=" nav-link {{ $role == 'tindakan_dokter_inap' ? 'active' : '' }}" href="{{ route('tindakan_dokter_inap.index') }}"
                style="font-weight:bold;"><i class="fas fa-procedures"></i>Tindakan Dokter Inap</a>
        </li>
        <li class="nav-item">
            <a class=" nav-link {{ $role == 'tindakan_dokter_jalan' ? 'active' : '' }}" href="{{ route('tindakan_dokter_jalan.index') }}"
                style="font-weight:bold;"><i class="fas fa-file-medical"></i>Tindakan Dokter Jalan</a>
        </li>
    </ul>
</div>

<script charset="utf-8">
    $(document).ready(function() {
        // mencari elemen li yang aktif
        var activeItem = $('.nav-item .active');

        // scroll ke elemen li aktif jika ada
        if (activeItem.length) {
            var scrollPos = activeItem.offset().left - $('.nav').offset().left + $('.nav').scrollLeft();
            $('.nav').animate({
                scrollLeft: scrollPos
            }, 500);
        }
    });
</script>
