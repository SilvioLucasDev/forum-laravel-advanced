@extends('admin.layouts.app')

@section('title', 'Editar Dúvida')

@section('header')
    <h1 class="text-lg text-black-500">Editar Dúvida</h1>
@endsection

@section('content')
    <form action="{{ route('supports.update', $support->id) }}" method="post">
        @method('PUT')
        @include('admin.supports.partials.form', ['support' => $support])
    </form>
@endsection
