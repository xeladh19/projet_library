<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        .wave{
            width: 150%;
            height: 400px;
            background-size: cover;
            z-index: -1;
            position: fixed;
            bottom: -50px;
            left: -50px;
        }
        .wave-container{
            width: 100%;
        }
        .payement-container{
            width: 100%;
            margin-top: 75px;
            position: absolute;
            bottom: 425px;
        }
        .last-txt{
            position: absolute;
            bottom: 7.5px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td align="left">
                <h3>KAMEO bikes SPRL</h3>
                Quai de Rome, 22
                <br>
                B-4000 Liège
                <br>
                Belgium
                <br><br>
                BE0681.879.712
            </td>
            <td align="center" valign="top"><img src="{{ asset('images/logo.png') }}" alt="" width="150" /></td>
            
            <td align="right">
                <h3>{{ $company['name'] }}</h3>
                {{ $company['address']['street'] }}, {{ $company['address']['number'] }}
                <br>
                {{ $company['address']['zip'] }}, {{ $company['address']['city'] }} 
                <br>
                {{ $company['address']['country'] }}
                <br><br>
                {{ $company['vat_number'] }}
            </td>
        </tr>

    </table>

    <table width="100%" style="margin-top: 100px;">
        <tr>
            <td><strong>De:</strong> KAMEO Bikes SPRL</td>
            <td><strong>À:</strong> {{ $company['name'] }}</td>
        </tr>

    </table>

    <br />

    <table width="100%">
        <thead style="background-color: #3cb295; color: #fff;">
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
            for($i = 0; $i < count($items); $i++){
                $items[$i]['quantity'] = array_count_values(array_column($items, 'id'))[$items[$i]['id']];
            }
            $unique_items   = array_unique(array_column($items, 'id'));
            $items          = array_intersect_key($items, $unique_items);
            $totalHTVA  = 0;
            $index      = 0;
            @endphp
            {{-- Article --}}
            @foreach($items as $item)
            @php 
            $totalHTVA += $item['selling_price'] * $item['quantity'];
            @endphp
                <tr>
                    <th scope="row">{{ $index++ + 1 }}</th>
                    <td align="center">{{ $item['brand'] }} {{ $item['model'] }}</td>
                    <td align="center">{{ $item['quantity'] }}</td>
                    <td align="right">{{ $item['selling_price'] }}</td>
                    <td align="right">{{ $item['selling_price'] * $item['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            {{-- Subtotal, TVA and total --}}
            <tr>
                <td colspan="3"></td>
                <td align="right">Total HTVA €</td>
                <td align="right">{{ $totalHTVA }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">TVA €</td>
                <td align="right">{{ number_format((($totalHTVA * 1.21) / 100) * 21, 2, '.') }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total TVAC €</td>
                <td align="right" class="gray">{{ number_format($totalHTVA * 1.21, 2, '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <table class="payement-container">
        <tr>
            <td>
                {{-- Payement infos --}}
                <table>
                    <tr>
                        <td align="left">
                            <strong>Bénéficiaire :</strong>
                        </td>
                        <td align="left">
                            KAMEO Bikes SPRL
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <strong>IBAN :</strong>
                        </td>
                        <td align="left">
                            BE90 5230 8139 8132
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <strong>SWIFT/BIC :</strong>
                        </td>
                        <td align="left">
                            TRIOBEBB
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <strong>Montant :</strong>
                        </td>
                        <td align="left">
                            {{ number_format($totalHTVA * 1.21, 2, '.') }} €
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <strong>Communication libre :</strong>
                        </td>
                        <td align="left">
                            +++202/2004/11625+++
                        </td>
                    </tr>
                </table>
            </td>
            OU
            <td>
                {{-- qrCode --}}
                <table>
                    <tr>
                        <td align="center">
                            <img src="{{ asset('storage/qrcode/example.png') }}" alt="KAMEO bikes wave" style="width: 150px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="wave-container">
        <tr>
            <td valign="top">
                <img src="{{ asset('images/wave.svg') }}" alt="KAMEO bikes wave" class="wave" />
            </td>
        </tr>
    </table>

    <table class="last-txt">
        <tr>
            <td style="color: #fff;">
                Par ce paiement, vous adhérez à nos conditions générales de vente
            </td>
        </tr>
    </table>
</body>

</html>