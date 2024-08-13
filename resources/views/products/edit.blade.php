<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POST CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="bg-dark">
        <h3 class="text-white text-center">POST CRUD</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-3">
                    <div class="card-header bg-dark h4">
                        <h3 class="text-white">Edit Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3 h5">
                                <label for="name" class="form-label" h4>Name</label>
                                <input type="text" value="{{ old('name', $product->name) }}" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name">
                                @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 h5">
                                <label for="sku" class="form-label" h4>SKU</label>
                                <input type="text" value="{{ old('sku', $product->sku) }}" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="SKU" name="sku">
                                @error('sku')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 h5">
                                <label for="price" class="form-label" h4>Price</label>
                                <input type="text" value="{{ old('price', $product->price) }}" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price" name="price">
                                @error('price')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 h5">
                                <label for="description" class="form-label" h4>Description</label>
                                <textarea name="description" placeholder="Description" class="form-control" cols="30" rows="5">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="mb-3 h5">
                                <label for="image" class="form-label" h4>Image</label>
                                <input type="file" id="image" class="image form-control form-control-lg" name="image" accept="image/*">
                                <div id="image-preview-container">
                                    @if ($product->image)
                                        <img id="current-image" class="w-50 my-3" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('image-preview-container');
            const currentImage = document.getElementById('current-image');
            
            // Remove current image if exists
            if (currentImage) {
                previewContainer.removeChild(currentImage);
            }

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.id = 'current-image';
                    img.classList.add('w-50', 'my-3');
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>
