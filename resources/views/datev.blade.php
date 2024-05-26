<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('backend/fontawesome-pro/css/all.min.css') }}">
    <title>asdf</title>
    <style>
        table {
            border-collapse: collapse;
            width:100%;
        }
        table, tr, th, td {
            border: 1px solid;
            padding: 5px;
        }

        th{
            background-color:#ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <div class="card-body">
        <table id="abrechnung" class="table table-sm table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        EXTF;{{ $verionNumber }};21;Buchungsstapel;7;202404{{ rand(100000000, 999999999) }};RE;;;{{ $datevs->berater }};{{ $datevs->mandant }};{{ date('Ym01', strtotime($selectDate)) }};4;{{ date('Ym01', strtotime($selectDate)) }};{{ date('Ymt', strtotime($selectDate)) }};Rechnungen_{{ __('bill_print.month.'.date('F', strtotime($selectDate))) }} {{ date('Y', strtotime($selectDate)) }};;1;0;0;EUR;;;;;;;;;mp.com;"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";
                    </th>

                </tr>
                <tr>
                    <th>
                        Umsatz (ohne Soll/Haben-Kz);Soll/Haben-Kennzeichen;WKZ Umsatz;Kurs;Basis-Umsatz;WKZ Basis-Umsatz;Konto;Gegenkonto (ohne BU-Schl?ssel);BU-Schl?ssel;Belegdatum;Belegfeld 1;Belegfeld 2;Skonto;Buchungstext;Postensperre;Diverse Adressnummer;Gesch?ftspartnerbank;Sachverhalt;Zinssperre;Beleglink;Beleginfo - Art 1;Beleginfo - Inhalt 1;Beleginfo - Art 2;Beleginfo - Inhalt 2;Beleginfo - Art 3;Beleginfo - Inhalt 3;Beleginfo - Art 4;Beleginfo - Inhalt 4;Beleginfo - Art 5;Beleginfo - Inhalt 5;Beleginfo - Art 6;Beleginfo - Inhalt 6;Beleginfo - Art 7;Beleginfo - Inhalt 7;Beleginfo - Art 8;Beleginfo - Inhalt 8;KOST1 - Kostenstelle;KOST2 - Kostenstelle;KOST-Menge;EU-Land u. UStID;EU-Steuersatz;Abw. Versteuerungsart;Sachverhalt L+L;Funktionserg?nzung L+L;BU 49 Hauptfunktionstyp;BU 49 Hauptfunktionsnummer;BU 49 Funktionserg?nzung;Zusatzinformation - Art 1;Zusatzinformation- Inhalt 1;Zusatzinformation - Art 2;Zusatzinformation- Inhalt 2;Zusatzinformation - Art 3;Zusatzinformation- Inhalt 3;Zusatzinformation - Art 4;Zusatzinformation- Inhalt 4;Zusatzinformation - Art 5;Zusatzinformation- Inhalt 5;Zusatzinformation - Art 6;Zusatzinformation- Inhalt 6;Zusatzinformation - Art 7;Zusatzinformation- Inhalt 7;Zusatzinformation - Art 8;Zusatzinformation- Inhalt 8;Zusatzinformation - Art 9;Zusatzinformation- Inhalt 9;Zusatzinformation - Art 10;Zusatzinformation- Inhalt 10;Zusatzinformation - Art 11;Zusatzinformation- Inhalt 11;Zusatzinformation - Art 12;Zusatzinformation- Inhalt 12;Zusatzinformation - Art 13;Zusatzinformation- Inhalt 13;Zusatzinformation - Art 14;Zusatzinformation- Inhalt 14;Zusatzinformation - Art 15;Zusatzinformation- Inhalt 15;Zusatzinformation - Art 16;Zusatzinformation- Inhalt 16;Zusatzinformation - Art 17;Zusatzinformation- Inhalt 17;Zusatzinformation - Art 18;Zusatzinformation- Inhalt 18;Zusatzinformation - Art 19;Zusatzinformation- Inhalt 19;Zusatzinformation - Art 20;Zusatzinformation- Inhalt 20;St?ck;Gewicht;Zahlweise;Forderungsart;Veranlagungsjahr;Zugeordnete;F?lligkeit;Skontotyp;Auftragsnummer;Buchungstyp;Ust-Schl?ssel (Anzahlungen);EU-Land (Anzahlungen);Sachverhalt L+L (Anzahlungen);EU-Steuersatz (Anzahlungen);Erl?skonto (Anzahlungen);Herkunft-Kz;Leerfeld;KOST-Datum;Mandatsreferenz;Skontosperre;Gesellschaftername;Beteiligtennummer;Identifikationsnummer;Zeichnernummer;Postensperre bis;Bezeichnung SoBil-Sachverhalt;Kennzeichen SoBil-Buchung	Festschreibung;Leistungsdatum;Datum Zuord.Steuerperiode;
                    </th>
                </tr>
            </thead>

            <tbody>


                @foreach ($bills as $key => $bill)

{{--                    @if($bill->patient->insurance_id == 73)--}}
{{--                        @php($number = $datevs->erloskonto_privat)--}}
{{--                    @else--}}
{{--                        @php($number = $datevs->erloskonto_kasse)--}}
{{--                    @endif--}}

                    <tr><td>{{ $bill->total_bill }};"H";"EUR";"";"";"";"100";"{{ !empty($bill->patient->insurance) ? $bill->patient->insurance->customer_number : "" }}";"";{{ $bill->year }};{{ $bill->serial_number }};"";"";"{{ $datevs->berater }}";"";"";"";"";"";"";"Leistungsperiode";"{{ __('bill_print.month.'.date('F', strtotime($bill->year.'-'.$bill->month))) }} {{ $bill->year }}";"Rechnungsdatum";"{{ Date('d.m.Y', strtotime($bill->created_at)) }}";"Klientnr.";"{{ $bill->patient->client_no }}";"Kostentr ger";"{{ $bill->insurance_company }}";"Leistungsdatum";"{{ Date('d.m.Y', strtotime($bill->created_at)) }}";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"";"{{ Date('d.m.Y', strtotime($bill->created_at)) }}";"";</td></tr>

                @endforeach

            </tbody>
        </table>
    </div>
</body>
</html>
