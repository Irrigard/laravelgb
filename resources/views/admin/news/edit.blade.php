@extends('layouts.admin')

@section('title')
    Новости
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать новость:</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div style="margin-left: 11px">
            <form method="post" action="{{ route('admin.news.update', ['news'=>$news->id]) }}" class="col-5">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" id="title" name="title" value="{!! $news->title !!}">
                </div>
                @if($errors->has('title'))
                    <div class="alert alert-danger">
                        @foreach($errors->get('title') as $error)
                            <p style="margin-bottom: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="status">Статус</label>
                    <select class="form-control" id="status" name="status">
                        <option @if($news->status === 'Draft') selected @endif>Draft</option>
                        <option @if($news->status === 'Published') selected @endif>Published</option>
                        <option @if($news->status === 'Blocked') selected @endif>Blocked</option>
                    </select>
                </div>
                @if($errors->has('status'))
                    <div class="alert alert-danger">
                        @foreach($errors->get('status') as $error)
                            <p style="margin-bottom: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Изображение</label>
                    <input type="file" class="form-control" id="image" name="image" value="{!! $news->image !!}">
                </div>
                @if($categories)
                    <div class="form-group">
                        <label for="category">Категория</label>
                        <select class="form-control" id="category" name="category">
                            @foreach($categories as $category)
                                <option @if($news->categoryTitle === $category->title) selected @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if($sources)
                    <div class="form-group">
                        <label for="category">Источник</label>
                        <select class="form-control" id="source" name="source">
                            @foreach($sources as $source)
                                <option @if($news->sourceTitle === $source->title) selected @endif>{{$source->title}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="description">Текст</label>
                    <textarea class="form-control" id="description" name="description">{!! $news->description !!}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        <!-- /.content -->
    </div>
@endsection


