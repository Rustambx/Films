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
                                    <form action="{{ route('genre.update', $genre) }}" method="post">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="name">Название</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{ $genre->name }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Добавить</button>
                                        <a href="{{ route('genre') }}" class="btn btn-danger">Назад</a>
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
