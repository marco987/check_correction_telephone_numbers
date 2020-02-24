<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Number;

class TelephoneController extends Controller
{
    public function index()
    {
        return view('home-page');
    }

    public function show(Request $request)
    {
        $csv = [];
        $numeri_validi = [];
        $numeri_non_validi = [];

        // Verifica esistenza file
        if ($request->csv) {
            // Allocazione file caricato
            $pathName = $request->csv->getPathName();
            // Apertura file in sola lettura
            $file = fopen($pathName, "r");
            // Lettura riga per riga fino all'ultima (EndOfFile)
            while(!feof($file)) {
                // Metodo fgetcsv riconosce la virgola come separatore di due elementi
                // e li salva come array
                $numero = fgetcsv($file);
                // Push del numero di telefono, che corrisponde al secondo elemento dell'array
                $csv[] = $numero[1];
            }
            // Chiusura file
            fclose($file);
            // Eliminazione primo elemento (refuso dal file .csv)
            $csv = array_slice($csv, 1);
        
            foreach ($csv as $numero) {
                // Verifica lunghezza corretta numero (11 caratteri)
                if (strlen($numero) == 11) {
                    // Verifica presenza all'inizio del prefisso internazionale (27)
                    if (strpos($numero, '27') === 0) {
                        // Aggiunta + per prefisso internazionale
                        $numero = "+" . $numero;
                        // Push in "array di array" $numeri_validi
                        // Il secondo elemento è vuoto perché il numero non contiene correzioni
                        array_push($numeri_validi, [$numero, ""]);
                    } else {
                        $numeri_non_validi[] = $numero;                    
                    }
                    // Tentativo correzione numeri
                    // Verifica che il numero inizi per 27
                } else if (strpos($numero, '27') === 0) {
                    // Ipotesi che il carattere "_" sia presente a causa di un bug; verifica presenza
                    if (substr($numero, 11, 1) === '_') {
                        $numero_non_valido = $numero;
                        // Estrazione numero telefonico (11 caratteri)
                        $numero = substr($numero, 0, 11);
                        // Aggiunta + per prefisso internazionale
                        $numero = "+" . $numero;
                        // Push in "array di array" $numeri_validi
                        // Il secondo elemento è il numero non corretto
                        array_push($numeri_validi, [$numero, $numero_non_valido]);
                    } else {
                        $numeri_non_validi[] = $numero;                    
                    }
                } else {
                    $numeri_non_validi[] = $numero;
                }
            }

        } else {
            // Alert nel caso non fosse stato caricato alcun file
            echo "<p class='alert'>ATTENZIONE: Caricare un file con estensione .csv</p>";
        }

        foreach ($numeri_validi as $numero) {
            // Salvataggio in database (ignora duplicati)
            DB::table('numbers')->insertOrIgnore([
                ['telephone-numbers' => $numero[0]]
            ]);
        }

        // print_r($csv);
        // print_r($numeri_validi);
        // print_r($numeri_non_validi);
        // exit;

        return view('show', compact('numeri_validi', 'numeri_non_validi'));
    }

    public function verify_number(Request $request)
    {
        $numero_digitato = $request->number;
        $lunghezza = strlen($numero_digitato);
        $numero_valido = "";
        $numero_corretto = "";
        $numero_non_valido = "";

        // Verifica presenza prefisso internazionale "+27" e lunghezza corretta numero
        if ($numero_digitato[0] === "+" && $numero_digitato[1] === "2" && $numero_digitato[2] === "7" && $lunghezza === 12) {
            $numero_valido = $numero_digitato;
                    // Caso di mancanza "+" ma presenza "27" e lunghezza corretta
        } else if ($numero_digitato[0] === "2" && $numero_digitato[1] === "7" && $lunghezza === 11) {
            $numero_corretto = "+" . $numero_digitato;
                    // Caso di mancanza "+27" ma lunghezza corretta
        } else if ($numero_digitato[0] !== "2" && $numero_digitato[1] !== "7" && $lunghezza === 9) {
            $numero_corretto = "+27" . $numero_digitato;
        } else {
            $numero_non_valido = $numero_digitato;
        }

        return view('verify_number', compact('numero_digitato', 'numero_valido', 'numero_corretto', 'numero_non_valido'));
    }
}
