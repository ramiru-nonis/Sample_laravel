<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}">
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="{{ $product->description }}">
    </div>
    <div>
        <label for="price">Price</label>
        <input type="text" name="price" id="price" value="{{ $product->price }}">
    </div>
    <div>
        <label for="stock">Stock</label>
        <input type="text" name="stock" id="stock" value="{{ $product->stock }}">
    </div>
    <button type="submit">Update</button>
</form>