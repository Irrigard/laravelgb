@extends('layouts/main')
@section('title')
    Новости
@endsection
@section('header')
    Новости из категории c id = {{ $id }}
@endsection
@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
            @forelse($newsList as $news)
                <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{ route('news', ['catId'=>$id, 'id'=>$news->newsId]) }}">
                            <h2 class="post-title">{{ $news->newsTitle }}</h2>
                        </a>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
            @empty
                <div class="post-preview">
                        <h2 class="post-title">Записей не найдено</h2>
                </div>
            @endforelse
            <!-- Pager-->
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Еще новости →</a></div>
            </div>
        </div>
    </div>
@endsection
