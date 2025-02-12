@extends('layouts.app')
<!-- Main Content -->
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen Hak Akses</h1>
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
                <div class="row" style="width: 100%; margin-left: 0;">
                    <div class="col-lg-8" style="display: flex; align-items: center;">
                        <p>&nbsp;</p>
                    </div>
                    <form method="get" action="{{ url('hak_akses/cari') }}" class="col-lg-4 mb-3" style="display: flex; justify-content: flex-end;">
                        <input type="text" class="form-control" placeholder="Cari..." value="{{$keyword}}" name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Username</th>
                                <th>Email</th>
                                <th>Authority</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($user) < 1)
                            <tr class="text-center">
                                <td colspan="4">Data tidak ditemukan.</td>
                            </tr>
                            @else
                            @foreach ($user as $u)
                            <tr style="text-align: center;">
                                <td>{{$u->username}}</td>
                                <td>{{$u->email}}</td>
                                <td>{{$u->authority}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('hak_akses/create?id='.$u->id) }}"><i class="fas fa-key"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row mb-3" style="width: 100%; margin-left:0;">
                    <div class="col-lg-6" style="display: flex; align-items: center;">
                        @if(sizeof($user) > 0)
                        Showing data {{$user->firstItem()}} to {{$user->lastItem()}}, Page {{ $user->currentPage() }} of {{$user->lastPage()}} @if($keyword != '') (Filtered) @endif
                        @else
                        Empty result @if($keyword != '') (Filtered) @endif
                        @endif
                    </div>
                    <div class="col-lg-6" style="justify-content: flex-end; display: flex;">
                        {{ $user->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    $('#menu').on('change', function() {
        if ($('#menu').val() == '') {
            $('#formToggle').html('');
        } else {
            $('#formToggle').html('<p>Doing Ajax</p>');
            $.ajax({
                url: '../ajax/sub/menu',
                data: {
                    menu: $('#menu').val(),
                },
                success: function(response) {
                    console.log(response);
                }
            })
        }
    })
</script>
@endsection