@extends('layouts.app')
<!-- Main Content -->
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Hak Akses</h1>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="section-body">
            <div class="row card pt-3" style="width: 100%; margin-left: 0px;">
                <form action="{{ url('hak_akses/create') }}" method="post" id="formGhoib">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id_user" value="{{$user->id}}">
                    <input type="hidden" id="menu_baru" name="menu">
                </form>
                <div class="col-lg-12" style="text-align: right;">
                    <button class="btn btn-success mb-3" onclick="update()"><i class="fas fa-save"></i> Save</button>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Username</th>
                                <th>Email</th>
                                <th>Authorization</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->authority}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    @php
                    $mymenu = json_decode($user->menu);
                    $menu = Session::get('menu');
                    @endphp
                    <div class="accordion" id="accordionExample">
                        @foreach($menu as $m)
                        <div class="card" style="background-color: #DEDEDE;">
                            <div class="card-header" id="heading_{{$m->menu}}">
                                <h5 class="mb-0">
                                    <button style="text-decoration: none; color:#111; font-weight: bolder;" class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$m->menu}}" aria-expanded="true" aria-controls="{{$m->menu}}">
                                        {{$m->menu_alias}}
                                    </button>
                                </h5>
                            </div>
                            <div id="{{$m->menu}}" class="collapse" aria-labelledby="heading_{{$m->menu}}" data-parent="#accordionExample">
                                <div class="card-body">
                                    @php
                                    $master_sub_menu = json_decode($m->sub_menu);
                                    @endphp
                                    <div class="form-group">
                                        <label for="" class="mr-5">Semua</label>
                                        <button class="btn btn-primary" onclick="aktifSemua('{{$m->menu}}')">On</button>
                                        <button class="btn btn-danger" onclick="unactiveSemua('{{$m->menu}}')">Off</button>
                                    </div>
                                    <?php $cek = ''; ?>
                                    @foreach($master_sub_menu as $master_sub)
                                    @if($mymenu != null)
                                    @foreach($mymenu as $may => $val)
                                    @if($may == $m->menu)
                                    <?php $mss = $master_sub->slug; ?>
                                    @if(property_exists($val, $master_sub->slug) && $val->$mss == 1)
                                    <?php $cek = 'checked'; ?>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endif
                                    <div class="form-group">
                                        <label for="" class="mr-5">{{$master_sub->name}}</label>
                                        <input class="{{$m->menu}}" type="checkbox" id="{{$master_sub->slug.''.$m->menu}}" data-toggle="toggle" {{$cek}}>
                                    </div>
                                    <?php $cek = ''; ?>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    function aktifSemua(param) {
        $('.' + param).prop('checked', 'checked').trigger('change');
    }

    function unactiveSemua(param) {
        $('.' + param).prop('checked', '').trigger('change');
    }

    var sub = [];
    var baru = {};

    $(document).ready(function() {
        sub = <?php if ($user->menu != '') {
                    echo $user->menu;
                } else {
                    echo '{}';
                } ?>;
        console.log(sub);
    })

    function cekSubMenu(param, menu) {
        for (let j = 0; j < param.length; j++) {
            if ($('#' + param[j].slug + menu).is(":checked")) {
                return true;
                break;
            }
        }

        return false;
    }

    function addSubMenu(param, menu) {
        var ins = '';
        var temp = {};
        for (let j = 0; j < param.length; j++) {
            if ($('#' + param[j].slug + menu).is(':checked')) {
                temp[param[j].slug] = '1';
            } else {
                temp[param[j].slug] = '0';
            }
        }
        baru[menu] = temp;
        console.log(baru);
    }

    function update() {
        baru = {};
        var menus = <?php echo $menu; ?>;
        for (let i = 0; i < menus.length; i++) {
            var submenus = JSON.parse(menus[i].sub_menu);
            if (cekSubMenu(submenus, menus[i].menu)) {
                addSubMenu(submenus, menus[i].menu);
            }
        }
        $('#menu_baru').val(JSON.stringify(baru));
        var form = document.getElementById("formGhoib");
        form.submit();
    }
</script>
@endsection