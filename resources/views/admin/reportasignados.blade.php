@extends('layouts.admin')

@section('titulos')
<section class="content-header">
    <ol class="breadcrumb">
    <li><a href="{{ url('/backdoor') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Completos</li>
    </ol>
</section>
@endsection


@section('usuarios')
<h1>RETOS COMPLETOS </h1>

<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Nivel</th>
                <th>S</th>
                <th>G</th>
                <th>I</th>
                <th>Fecha Creado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $user->firstname }} </td>
                    <td>{{ $user->lastname }} </td>
                    <td>{{ $user->username }} </td>
                    <td>{{ $user->email }} </td>
                    <td>{{ $user->level }}</td>
                    <td>{{ $user->s_point }} </td>
                    <td>{{ $user->g_point }} </td>
                    <td>{{ $user->i_point }} </td>
                    <td>{{ $user->created_at }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
