<ul class="sidebar-menu" id="main-menu">
    @if (Auth::user()->authority == 'administrator')
        <li class="menu">
            <a class="nav-link" href="{{ url('pengguna') }}">
                <i class="fas fa-bullseye"></i>
                <span>Pengguna</span>
            </a>
        </li>
    @endif
    @if (session('menu'))
        <?php
        $mymenu = json_decode(Auth::user()->menu, true); ?>
        @foreach (session('menu') as $m)
            <?php $cek = false;
            $key = '';
            if ($mymenu != null) {
                for ($i = 0; $i < sizeof($mymenu); $i++) {
                    if (array_key_exists($m->menu, $mymenu)) {
                        foreach ($mymenu[$m->menu] as $cekmysub) {
                            if ($cekmysub == 1) {
                                $cek = true;
                                $key = $m->menu;
                                break;
                            }
                        }
                    }
                }
            } ?>
            @if ($cek)
                <li class="nav-item dropdown menu {{ request()->segment(1) == $m->menu ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" <?php if (strlen($m->menu_alias) > 21) { ?> data-toggle="tooltip"
                        data-placement="top" title="<?php echo $m->menu_alias; ?>" <?php } ?>><i
                            class="fas fa-bullseye"></i><span>{{ substr($m->menu_alias, 0, 21) }}</span></a>
                    <ul class="dropdown-menu sub-menu">
                        <?php $sub = json_decode($m->sub_menu); ?>
                        @foreach ($sub as $s)
                            <?php $ceksub = false; ?>
                            @for ($j = 0; $j < sizeof($mymenu[$key]); $j++)
                                @if (array_key_exists($s->slug, $mymenu[$key]) && $mymenu[$key][$s->slug] == '1')
                                    <?php $ceksub = true; ?>
                                @endif
                            @endfor
                            @if ($ceksub)
                                @php
                                    $protokol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
                                @endphp
                                @if ($s->is_laravel == 0)
                                    @if ($m->prototype == 'rawat')
                                        @php
                                            $url = request()->getHost() . env('SMIS_URL') . '/login.php?session=' . Session::get('rsudslg2-sessionid') . '&page=' . $m->menu . '&action=' . $s->slug . '&pname=' . $m->menu_alias . '&pslug=' . $m->menu . '&pimpl=' . $m->prototype;
                                        @endphp
                                    @else
                                        @php
                                            $url = request()->getHost() . env('SMIS_URL') . '/login.php?session=' . Session::get('rsudslg2-sessionid') . '&page=' . $m->menu . '&action=' . $s->slug . '&pname=&pslug=&pimpl=';
                                        @endphp
                                    @endif
                                @else
                                    @php
                                        $url = request()->getHost() . env('APP_URL') . '/' . $m->menu . '/' . $s->slug;
                                    @endphp
                                @endif
                                <li class="{{ request()->segment(2) == $s->slug ? 'active' : '' }}"
                                    style="margin-left:-50px" <?php if (strlen($s->name) > 23) { ?> data-toggle="tooltip"
                                    data-placement="top" title="<?php echo $s->name; ?>" <?php } ?>><a
                                        class="nav-link" href="<?php echo $protokol . $url; ?>"><i
                                            class="fas fa-arrow-right"></i>{{ substr($s->name, 0, 23) }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    @endif
    @if (Auth::user()->authority == 'administrator')
        <li
            class="nav-item dropdown menu {{ request()->segment(1) == 'profil' ? 'active' : '' }}{{ request()->segment(1) == 'banner' ? 'active' : '' }}{{ request()->segment(1) == 'hak_akses' ? 'active' : '' }}{{ request()->segment(1) == 'nama_ruangan_igd' ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-bullseye"></i><span>General
                    Settings</span></a>
            <ul class="dropdown-menu sub-menu">
                <li style="margin-left: -50px;" class="{{ request()->segment(1) == 'profil' ? 'active' : '' }}"><a
                        class="nav-link" href="{{ url('profil') }}"><i class="fas fa-arrow-right"></i> Profil</a></li>
                <li style="margin-left: -50px;" class="{{ request()->segment(1) == 'banner' ? 'active' : '' }}"><a
                        class="nav-link" href="{{ url('banner') }}"><i class="fas fa-arrow-right"></i> Banner</a></li>
                <li style="margin-left: -50px;" class="{{ request()->segment(1) == 'hak_akses' ? 'active' : '' }}"><a
                        class="nav-link" href="{{ url('hak_akses') }}"><i class="fas fa-arrow-right"></i> Hak Akses</a>
                </li>
                <li style="margin-left: -50px;"
                    class="{{ request()->segment(1) == 'nama_ruangan_igd' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ url('nama_ruangan_igd') }}"><i class="fas fa-arrow-right"></i> Dashboard</a></li>
                <li style="margin-left: -50px;" class="{{ request()->segment(1) == 'keuangan' ? 'active' : '' }}"><a
                        class="nav-link" href="{{ url('keuangan') }}"><i class="fas fa-arrow-right"></i> Keuangan</a>
                </li>
                <li style="margin-left: -50px;" class="{{ request()->segment(1) == 'asuransi' ? 'active' : '' }}"><a
                        class="nav-link" href="{{ url('asuransi') }}"><i class="fas fa-arrow-right"></i> Asuransi</a>
                </li>
                <li style="margin-left: -50px;" class="{{ request()->segment(1) == 'invoice' ? 'active' : '' }}">
                    <a style="{{ request()->segment(1) == 'invoice' ? 'color:#6777ef;' : '' }}" class="nav-link" href="{{ url('invoice') }}"><i class="fas fa-arrow-right"></i> Invoice</a>
                </li>
            </ul>
        </li>
    @endif
</ul>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function($) {
        $("#search-menu").on("keyup", function() {
            if (this.value.length > 0) {
                $('#main-menu > li > a').each(function(ev) {
                    var name = $(this).text();
                    if (name.toLowerCase().includes($('#search-menu').val())) {
                        $(this).show();
                    } else {
                        $('.dropdown-menu').hide();
                        $(this).hide();
                    }
                });
            } else {
                $('#main-menu > li > a').each(function(ev) {
                    $(this).show();
                });
            }
            $.ajax({
                url: '{{ url('ajax_request/set_session') }}',
                data: {
                    'key': 'search_key',
                    'nilai': this.value
                },
                success: function(response) {
                    console.log(<?php echo Session::get('serach-key'); ?>);
                }
            })
        });

        filter_menu("{{ Session::get('search_key') }}")
    });

    function filter_menu(param) {
        console.log(param.trim());
        if (param.length > 0) {
            $('#main-menu > li > a').each(function(ev) {
                var name = $(this).text();
                if (name.toLowerCase().includes(param)) {
                    $(this).show();
                } else {
                    $('.dropdown-menu').hide();
                    $(this).hide();
                }
            });
        } else {
            $('#main-menu > li > a').each(function(ev) {
                $(this).show();
            });
        }
    }
</script>
