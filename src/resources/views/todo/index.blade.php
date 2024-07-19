@extends('layouts.base')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p class="text-left">
                <a class="btn btn-success" href="{{ route('todo.create') }}">Todoを追加</a>
            </p>
            <div class="card">
                <div class="card-header">
                    ToDo一覧
                </div>
                <div class="list-group list-group-flush">
                    {{-- $todos：Todoインスタンス(1レコードずつ配列の状態) --}}
                    @foreach ($todos as $todo)
                        <div class="d-flex align-items-center p-2">
                            {{-- カラム名で取得できるのは、Todoモデルのオブジェクトのcontentプロパティを呼び出しているから --}}
                            {{-- @dd($todo) --}}
                            <span class="col-9">{{ $todo->content }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
