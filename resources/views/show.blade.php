@extends('layout.layout-base')

@section('content')

    <a href={{route('home-page')}}>Torna alla Home-Page</a><br><br>

    <section>
        <div class="">
            <h3>Numeri accettati</h3>
            <br>
            @foreach ($numeri_validi as $numero_valido)
                {{-- Stampa dei soli numeri che non hanno avuto correzioni --}}
                @if ($numero_valido[1] == "")
                    <p><b>{{$numero_valido[0]}}</b></p>
                @endif
            @endforeach
        </div>
        <div class="">
            <h3>Numeri corretti</h3>
            <br>
            @foreach ($numeri_validi as $numero_valido)
                {{-- Stampa dei soli numeri che sono stati corretti --}}
                @if ($numero_valido[1] != "")
                    <p><b>{{$numero_valido[0]}}</b></p>
                    <p style="color: red">(Prima della correzione: <b>{{$numero_valido[1]}}</b>)</p>
                @endif                
            @endforeach
        </div>
        <div class="">
            <h3>Numeri non validi</h3>
            <br>
            @foreach ($numeri_non_validi as $numero_non_valido)
                <p><b>{{$numero_non_valido}}</b></p>
            @endforeach
        </div>
    </section>

@endsection