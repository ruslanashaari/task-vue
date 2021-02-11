@extends('layouts.master', [
    'namePage' => 'Create Task',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
    ])

@section('content')

<create-task
  create-task-api="{{ route('api.task.create') }}"
  task-list-url="{{ route('home') }}"
></create-task>

@endsection