@extends('layouts.master', [
    'namePage' => 'Task List',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
    ])

@section('content')

<task-component
  task-list-api="{{ route('api.task.list') }}"
  task-create-url="{{ route('task.create') }}"
></task-component>

@endsection