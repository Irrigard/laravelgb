@extends('layouts.admin')

@section('title')
    Категории
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Создать категорию:</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div style="margin-left: 11px">
            <form method="post" action="{{ route('admin.categories.store') }}" class="col-5">
                @csrf
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" class="form-control" id="title" name="title" value="{!! old('title') !!}">
                </div>
                @if($errors->has('title'))
                    <div class="alert alert-danger">
                        @foreach($errors->get('title') as $error)
                            <p style="margin-bottom: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" id="description" name="description">{!! old('description') !!}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        <!-- /.content -->
    </div>
@endsection
