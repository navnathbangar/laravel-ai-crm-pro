<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Lead Report</title>

    <style>

        body{

            font-family: DejaVu Sans, sans-serif;

            font-size:12px;

        }

        table{

            width:100%;

            border-collapse:collapse;

        }

        th,td{

            border:1px solid #000;

            padding:6px;

        }

        th{

            background:#eeeeee;

        }

        h2{

            text-align:center;

            margin-bottom:20px;

        }

    </style>

</head>

<body>

<h2>Lead Report</h2>

<table>

    <thead>

    <tr>

        <th>#</th>

        <th>Lead Code</th>

        <th>Lead Name</th>

        <th>Company</th>

        <th>Email</th>

        <th>Phone</th>

        <th>Source</th>

        <th>Status</th>

        <th>Expected Value</th>

    </tr>

    </thead>

    <tbody>

    @foreach($leads as $lead)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $lead->lead_code }}</td>

        <td>{{ $lead->lead_name }}</td>

        <td>{{ $lead->company_name }}</td>

        <td>{{ $lead->email }}</td>

        <td>{{ $lead->phone }}</td>

        <td>{{ $lead->source }}</td>

        <td>{{ $lead->status }}</td>

        <td>{{ number_format($lead->expected_value,2) }}</td>

    </tr>

    @endforeach

    </tbody>

</table>

</body>
</html>