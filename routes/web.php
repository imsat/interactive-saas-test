<?php

use App\Models\YearReport;
use App\Services\CustomDataExportService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;


Route::get('csv-export', function (\Illuminate\Http\Request $request) {
//    $data = [
//        ['Name', 'Age', 'City', 10, 20],
//        ['John Doe', 30, 'New York', 'dsfsf', 'fsdfsdf'],
//        ['Jane Smith', 25, 'Los Angeles', 'fsdfdsf'],
//        ['Tom Brown', 35, 'Chicago', "", "fsdfsf"]
//    ];

//    dd($data);
//    $data = array(
//        0 =>
//            array(
//                0 => 'EXTF;510;21;"Buchungsstapel";7;20240514120326528;;"RE";"";"";666682;20000;20240101;4;20240401;20240430;"Rechnungen April 2024";"";1;0;0;"EUR";;;;;;;;;mp.com',
//            ),
//        1 =>
//            array(
//                0 => 'Umsatz (ohne Soll/Haben-Kz);Soll/Haben-Kennzeichen;WKZ Umsatz;Kurs;Basis-Umsatz;WKZ Basis-Umsatz;Konto;Gegenkonto (ohne BU-Schl�ssel);BU-Schl�ssel;Belegdatum;Belegfeld 1;Belegfeld 2;Skonto;Buchungstext;Postensperre;Diverse Adressnummer;Gesch�ftspartnerbank;Sachverhalt;Zinssperre;Beleglink;Beleginfo - Art 1;Beleginfo - Inhalt 1;Beleginfo - Art 2;Beleginfo - Inhalt 2;Beleginfo - Art 3;Beleginfo - Inhalt 3;Beleginfo - Art 4;Beleginfo - Inhalt 4;Beleginfo - Art 5;Beleginfo - Inhalt 5;Beleginfo - Art 6;Beleginfo - Inhalt 6;Beleginfo - Art 7;Beleginfo - Inhalt 7;Beleginfo - Art 8;Beleginfo - Inhalt 8;KOST1 - Kostenstelle;KOST2 - Kostenstelle;KOST-Menge;EU-Land u. UStID;EU-Steuersatz;Abw. Versteuerungsart;Sachverhalt L+L;Funktionserg�nzung L+L;BU 49 Hauptfunktionstyp;BU 49 Hauptfunktionsnummer;BU 49 Funktionserg�nzung;Zusatzinformation - Art 1;Zusatzinformation- Inhalt 1;Zusatzinformation - Art 2;Zusatzinformation- Inhalt 2;Zusatzinformation - Art 3;Zusatzinformation- Inhalt 3;Zusatzinformation - Art 4;Zusatzinformation- Inhalt 4;Zusatzinformation - Art 5;Zusatzinformation- Inhalt 5;Zusatzinformation - Art 6;Zusatzinformation- Inhalt 6;Zusatzinformation - Art 7;Zusatzinformation- Inhalt 7;Zusatzinformation - Art 8;Zusatzinformation- Inhalt 8;Zusatzinformation - Art 9;Zusatzinformation- Inhalt 9;Zusatzinformation - Art 10;Zusatzinformation- Inhalt 10;Zusatzinformation - Art 11;Zusatzinformation- Inhalt 11;Zusatzinformation - Art 12;Zusatzinformation- Inhalt 12;Zusatzinformation - Art 13;Zusatzinformation- Inhalt 13;Zusatzinformation - Art 14;Zusatzinformation- Inhalt 14;Zusatzinformation - Art 15;Zusatzinformation- Inhalt 15;Zusatzinformation - Art 16;Zusatzinformation- Inhalt 16;Zusatzinformation - Art 17;Zusatzinformation- Inhalt 17;Zusatzinformation - Art 18;Zusatzinformation- Inhalt 18;Zusatzinformation - Art 19;Zusatzinformation- Inhalt 19;Zusatzinformation - Art 20;Zusatzinformation- Inhalt 20;St�ck;Gewicht;Zahlweise;Forderungsart;Veranlagungsjahr;Zugeordnete F�lligkeit;Skontotyp;Auftragsnummer;Buchungstyp;Ust-Schl�ssel (Anzahlungen);EU-Land (Anzahlungen);Sachverhalt L+L (Anzahlungen);EU-Steuersatz (Anzahlungen);Erl�skonto (Anzahlungen);Herkunft-Kz;Leerfeld;KOST-Datum;Mandatsreferenz;Skontosperre;Gesellschaftername;Beteiligtennummer;Identifikationsnummer;Zeichnernummer;Postensperre bis;Bezeichnung SoBil-Sachverhalt;Kennzeichen SoBil-Buchung;Festschreibung;Leistungsdatum;Datum Zuord.Steuerperiode',
//            ),
//        2 =>
//            array(
//                0 => '1000',
//                1 => '00;"H";"EUR";;;"";4100;21894;"";0705;"28271";"";;"Ebert GmbH ";;"";;;;"";"Leistungsperiode";"Mai 2024";"Rechnungsdatum";"07.05.2024";"Klientnr.";"21894";"Kostentr�ger";"Ebert GmbH ";"Leistungsdatum";"31.05.2024";"";"";"";"";"";"";"";"";;"";;"";;;;;;"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";;;;"";;;;"";"";;"";;;;"";"";;"";;"";;"";"";;"";;;31052024;',
//            ),
//    );

    $datevs = DB::table('datevs')->first();

    $selectDate = $request->get('selectDate');
    $monthYear = explode("-", $selectDate);

//    dd($monthYear);


//    $bills = DB::table('bills')->with(['patient', 'patient.insurance'])->where('month', $monthYear[1])->where('year', $monthYear[0])->get();
    $bills = YearReport::with(['patient', 'patient.insurance'])
        ->where('month', $monthYear[1])
        ->where('year', $monthYear[0])
        ->get();

//    dd($bills);
    $verionNumber = 100;

    return view('datev', compact('datevs', 'selectDate', 'bills', 'verionNumber'));


    return Excel::download(new CustomDataExportService($bills), 'test-csv.csv');
});


Route::get('{path}', function () {
    return view('app');
})->where('path', '([A-z\d\-\/_.]+)?');



