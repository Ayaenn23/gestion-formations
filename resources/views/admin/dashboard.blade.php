@extends('layouts.admin')

@section('content')
    <h1>Dashboard Admin</h1>
    <p>Bienvenue {{ auth()->user()->name }}</p>
@endsection
