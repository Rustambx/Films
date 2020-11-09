@extends('layouts.layout')

@section('content')

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <i class="fa fa-check mx-2"></i>
            {{ session()->get('status') }}!
        </div>
    @endif

    <div class="main-content-container container-fluid px-4">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Default Light Table -->
        <div class="row">
            <div class="col">
                <div class="card card-small mb-4">
                    <div class="card-header border-bottom">
                        <a href="{{ route('genre.create') }}" class="btn btn-primary">Добавить</a>
                    </div>
                    <div class="card-body p-0 pb-3 text-center">
                        <table class="table mb-0">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">#</th>
                                <th scope="col" class="border-0">Название</th>
                                <th scope="col" class="border-0">Редактирование</th>
                                <th scope="col" class="border-0">Удаление</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($genres as $genre)
                                <tr>
                                    <td>{{ $genre->id }}</td>
                                    <td>{{ $genre->name }}</td>
                                    <td>
                                        <a href="{{ route('genre.edit', $genre) }}" class="btn btn-primary">Редактирование</a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('genre.delete', $genre) }}" >
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Удаление</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
