@extends('layout.layout-base')

@section('content')

    <h3>Carica il file CSV e verifica i numeri di telefono</h3>
    <br>
    <form action="{{route('show')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <input type="file" name="csv" accept=".csv" onchange="file_selezionato = true;">
        <input type="submit" value="Apri CSV" onclick="filePresente();">
    </form>
    <script type="text/javascript">
        var file_selezionato = false; 
        function filePresente() { 
            if (!file_selezionato) {
                alert('Nessun file selezionato');
            }
        }
    </script>
    <br><br>
    <h3>Scrivi il numero e verificane la validità</h3>
    <br>
    <form action="{{route('verify_number')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <input type="text" name="number" onchange="testo_scritto = true;" placeholder="Formato +27123456789">
        <input type="submit" value="Verifica" onclick="testoPresente();">
    </form>
    <script type="text/javascript">
        var testo_scritto = false; 
        function testoPresente() { 
            if (!testo_scritto) {
                alert('Scrivi un numero di telefono!');
            }
        }
    </script>

@endsection