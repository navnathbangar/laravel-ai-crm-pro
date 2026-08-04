<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<style>

body{

font-family: DejaVu Sans;

font-size:12px;

}

table{

width:100%;

border-collapse:collapse;

}

th,td{

border:1px solid #000;

padding:8px;

}

th{

background:#eeeeee;

}

h2{

text-align:center;

}

</style>

</head>

<body>

<h2>Customer Report</h2>

<table>

<thead>

<tr>

<th>#</th>

<th>Code</th>

<th>Name</th>

<th>Email</th>

<th>Phone</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($customers as $customer)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $customer->customer_code }}</td>

<td>{{ $customer->name }}</td>

<td>{{ $customer->email }}</td>

<td>{{ $customer->phone }}</td>

<td>{{ $customer->status }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>