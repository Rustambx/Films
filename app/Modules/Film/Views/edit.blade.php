@extends('layouts.layout')

@section('content')
    <div class="main-content-container container-fluid px-4">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
        </div>
    @include('includes.error_messages')
    <!-- End Page Header -->
        <!-- Default Light Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-small mb-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('film.update', $film) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="name">Название</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ $film->name }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="name">Описание</label>
                                                <textarea class="form-control" name="description" id="description"  cols="30" rows="10">{{ $film->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="name">Текущая картинка</label>
                                                <img src="{{ $film->resized_image }}" alt="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="name">Картинка</label>
                                                <input type="file" class="form-control" name="image" id="image">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="name">Дата выхода</label>
                                                <input type="date" class="form-control" name="release_date" id="release_date" value="{{ $film->release_date }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="name">Жанры</label>
                                                <select name="genres[]" id="genre_id" class="form-control" multiple>
                                                    <option value="0">Выберите жанр</option>
                                                    @foreach($genres as $genre)
                                                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Добавить</button>
                                        <a href="{{ route('film') }}" class="btn btn-danger">Назад</a>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
