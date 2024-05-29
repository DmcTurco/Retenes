<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Padrones</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Reporte de Padrones</h2>

    <h3>Turno 1</h3>
    <table>
        <thead>
            <tr>
                <th>N° Orden</th>
                <th>Padron</th>
                <th>Vuelta</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($retainersTurn1 as $index1 => $item)
                <tr>
                    <td>{{ $index1 + 1 }}</td>
                    <td>Padron: {{ $item->padron }}</td>
                    <td>{{ $item->turn_name }}</td>
                    <td>{{ $item->state_name }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Turnos 2 y 3</h3>
    <table>
        <thead>
            <tr>
                <th>N° Orden</th>
                <th>Padron</th>
                <th>Vuelta</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($retainersTurn2And3 as $index2 => $item)
                <tr>
                    <td>{{ $index2 + 1 }}</td>
                    <td>Padron: {{ $item->padron }}</td>
                    <td>{{ $item->turn_name }}</td>
                    <td>{{ $item->state_name }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
