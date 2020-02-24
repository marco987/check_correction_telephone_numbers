@extends('layout.layout-base')

@section('content')

    <a href={{route('home-page')}}>Torna alla Home-Page</a><br><br>

    @if ($numero_valido !== "")
        <p>Numero digitato: <b>{{$numero_valido}}</b></p>
        <p style="color: green">Il numero è valido</p>
    @endif

    @if ($numero_corretto !== "")
        <p>Numero digitato NON valido: <b>{{$numero_digitato}}</b></p>
        <p style="color: green">Numero corretto: <b>{{$numero_corretto}}</p>
    @endif

    @if ($numero_non_valido !== "")
        <p>Numero digitato NON valido: <b>{{$numero_non_valido}}</b></p>
        <p style="color: red">Non è stato possibile apportare correzioni</p>
    @endif

@endsection