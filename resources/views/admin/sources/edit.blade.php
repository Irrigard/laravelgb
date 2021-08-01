@extends('layouts.admin')

@section('title')
    Источники
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать источник:</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div style="margin-left: 11px">
            <form method="post" action="{{ route('admin.sources.update', ['source'=>$source->id]) }}" class="col-5">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" class="form-control" id="title" name="title" value="{!! $source->title !!}">
                </div>
                @if($errors->has('title'))
                    <div class="alert alert-danger">
                        @foreach($errors->get('title') as $error)
                            <p style="margin-bottom: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="url">Ссылка</label>
                    <input type="text" class="form-control" id="url" name="url" value="{!! $source->url !!}">
                </div>
                @if($errors->has('url'))
                    <div class="alert alert-danger">
                        @foreach($errors->get('url') as $error)
                            <p style="margin-bottom: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        <!-- /.content -->
    </div>
@endsection


