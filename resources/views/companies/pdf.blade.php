<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Companies Report</title>

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

            text-align:left;

        }

        th{

            background:#e5e7eb;

        }

        h2{

            text-align:center;

        }

    </style>

</head>

<body>

<h2>Company Report</h2>

@if($search)

<p>

Search :
<strong>{{ $search }}</strong>

</p>

@endif

<table>

<thead>

<tr>

<th>#</th>

<th>Code</th>

<th>Name</th>

<th>Contact</th>

<th>Email</th>

<th>Phone</th>

<th>City</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($companies as $company)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $company->company_code }}</td>

<td>{{ $company->company_name }}</td>

<td>{{ $company->contact_person }}</td>

<td>{{ $company->email }}</td>

<td>{{ $company->phone }}</td>

<td>{{ $company->city }}</td>

<td>{{ $company->status }}</td>

</tr>

@endforeach

</tbody>

</table>

<br>

<p>

Total Companies :

<strong>{{ $companies->count() }}</strong>

</p>

</body>

</html>