<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Products Report</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{

            border:1px solid #000;

            padding:6px;

            text-align:left;

        }

        table th{

            background:#eeeeee;

        }

    </style>

</head>

<body>

<h2>Products Report</h2>

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

<th>SKU</th>

<th>Product</th>

<th>Category</th>

<th>Brand</th>

<th>Cost</th>

<th>Price</th>

<th>Stock</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($products as $product)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $product->sku }}</td>

<td>{{ $product->product_name }}</td>

<td>{{ $product->category }}</td>

<td>{{ $product->brand }}</td>

<td>{{ number_format($product->cost_price,2) }}</td>

<td>{{ number_format($product->selling_price,2) }}</td>

<td>{{ $product->stock }}</td>

<td>{{ $product->status }}</td>

</tr>

@endforeach

</tbody>

</table>

<br>

<p>

Total Products :

<strong>{{ $products->count() }}</strong>

</p>

</body>

</html>