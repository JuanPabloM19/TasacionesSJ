@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="text-center pt">
    <h1 class="mb-3 mt-8">¡Bienvenido, Usuario!</h1>
    <p>Desde esta pantalla puedes acceder a las diferentes secciones del sistema.</p>
</div>
@endsection

<style>
    .pt{
        padding-top: 100px;
    }
</style>
