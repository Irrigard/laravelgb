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
                <div class="form-group">
                    <label for="status">Статус</label>
                    <select class="form-control" id="status" name="status">
                        <option @if(old('status') === 'Draft') selected @endif>Draft</option>
                        <option @if(old('status') === 'Published') selected @endif>Published</option>
                        <option @if(old('status') === 'Blocked') selected @endif>Blocked</option>
                    </select>
                </div>
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
