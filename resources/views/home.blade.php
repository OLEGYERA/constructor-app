@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Создание приложения</div>

                <form class="card-body" method="post" action="{{route('home')}}">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">Название Приложения</div>
                        <div class="col-md-6">
                            <input type="text" name="file_name" required="" placeholder="App name" value="app">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Выберите Header</div>
                        <div class="col-md-6">
                            <select name="app_header">
                                <option value="1">Привет, Мир!</option>
                                <option value="2">Пока, Мир!</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Выберите Content</div>
                        <div class="col-md-6">
                            <select name="app_content">
                                <option value="1">Слайдер 1</option>
                                <option value="2">Слайдер 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-4 col-md-3">
                            <button>Отправить</button>
                        </div>
                    </div>                                          
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
