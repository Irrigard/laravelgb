@extends('layouts.admin')

@section('title')
    Пользователи
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактировать пользователя:</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div style="margin-left: 11px">
            <form method="post" action="{{ route('admin.users.update', ['user'=>$user->id]) }}" class="col-5">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" value="{!! $user->name !!}">
                </div>
                @if($errors->has('name'))
                    <div class="alert alert-danger">
                        @foreach($errors->get('name') as $error)
                            <p style="margin-bottom: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" value="{!! $user->email !!}">
                </div>
                @if($errors->has('email'))
                    <div class="alert alert-danger">
                        @foreach($errors->get('email') as $error)
                            <p style="margin-bottom: 0;">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_admin" @if($user->is_admin === true) checked @endif>
                    <label class="form-check-label" for="is_admin">Админ</label>
                </div>
                @if($errors->has('is_admin'))
                    <div class="alert alert-danger">
                        @foreach($errors->get('is_admin') as $error)
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


