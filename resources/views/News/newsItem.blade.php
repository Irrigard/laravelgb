@extends('layouts/main')
@section('title')
    Новость
@endsection
@section('header')
    Новость c id = {{ $id }} из категории c id = {{ $catId }}
@endsection
@section('content')
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>{{ $newsItemText }}</p>
                </div>
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Еще новости →</a></div>
            </div>
        </div>
    </article>
@endsection
