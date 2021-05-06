<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <th scope="row">{{$product->id}}</th>
            <td>{{$product->name}}</td>
            <td>
                <img src="{{ url('storage/'.$product->image) }}" class="" alt="" height="100" width="100">
            </td>
            <td>
                {{ $product->description }}
            </td>
            <td>
                {{ $product->is_active ? 'Active' : 'Inactive' }}

                <button wire:click="updateStatus({{ $product->id }})" class="btn btn-sm btn-info">
                    {{ $product->is_active ? 'Make Inacitve' : 'Make Active' }}
                </button>

            </td>
            <td>
                <button class="btn btn-sm btn-info">Edit</button>
                <button wire:click="delete({{ $product->id }})" class="btn btn-sm btn-danger">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-2">
    {{ $products->links() }}
</div>