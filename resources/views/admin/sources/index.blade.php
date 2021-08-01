@extends('layouts.admin')

@section('title')
    Источники
@endsection
@section('header')
    Список источников:
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Источники</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Таблица источников</h3>
                                <a href="{{ route('admin.sources.create') }}" class="btn btn-primary" style="float: right;">Добавить источник</a>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            @include('inc.message')
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Название</th>
                                        <th>Ссылка</th>
                                        <th>Дата добавления</th>
                                        <th>Управление</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($sourcesList as $source)
                                        <tr>
                                            <td>{{ $source->id }}</td>
                                            <td>{{ $source->title }}</td>
                                            <td>{{ $source->url }}</td>
                                            <td>{{ $source->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.sources.edit', ['source'=>$source->id]) }}" style="font-size: 16px;">ред.</a>&nbsp; | &nbsp;
                                                <a href="javascript:;" rel="{{ $source->id }}" class="delete" style="font-size: 16px; color:red;">уд.</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Записей не найдено</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('js')
    <script>
        $(function (){
            $(".delete").on('click', function() {
                if (confirm('Удалить запись?')){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "/admin/sources/" + $(this).attr('rel'),
                        complete: function () {
                            alert('Запись удалена');
                            location.reload();
                        }
                    })
                }
            })
        });
    </script>
@endpush

