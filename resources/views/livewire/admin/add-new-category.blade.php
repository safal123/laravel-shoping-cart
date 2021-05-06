<div>
    <form wire:submit.prevent="saveCategory">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" wire:model="name" class="form-control" placeholder="Enter Category Name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="name">Description</label>
            <textarea wire:model="description" id="" cols="30" rows="10" class="form-control"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="card-footer bg-info">
            <button type="submit" class="product-create btn btn-sm btn-primary">Save</button>
            <a href="{{ route('admin.categories.index') }}" class="product-create btn btn-sm btn-danger">Cancel</a>
        </div>
    </form>
</div>