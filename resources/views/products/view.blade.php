<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .product-container {
            width: 60%;
            margin: 50px auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-title {
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
        }
        .product-details {
            width: 100%;
            border-collapse: collapse;
        }
        .product-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .product-details img {
            max-width: 100px;
        }
        .product-not-found {
            text-align: center;
            font-size: 1.5em;
            color: red;
        }
        .img{
            max-width: 250px;
            height: auto;
            object-fit: cover;
            margin-bottom: 20px;
            transition: transform 0.3s;
            transform: scale(1);
            will-change: transform;
        }
        .buy-btn{
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
        }
    </style>
</head>
<body>  
    <div class="product-container">
        <div style="margin-left: 180px; " class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>
        @if ($product)
            <h1 class="product-title">{{ $product->name }}</h1>
            <table class="product-details">
                <tbody>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>SKU:</strong></td>
                        <td>{{ $product->sku }}</td>
                    </tr>
                    <tr>
                        <td><strong>Price:</strong></td>
                        <td>${{ $product->price }}</td>
                    </tr>
                    <tr>
                        <td><strong>Description:</strong></td>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                    <div class="img"></div>
                        <td><strong>Image:</strong></td>
                        <td><img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}"></td>
                    </div>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="buy-btn">Buy Now</button>
        @else
            <p class="product-not-found">Product not found.</p>
        @endif
    </div>
</body>
</html>

