<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Produkte</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('livewire.products.create')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Preis</th>
                                    <th>Einheit</th>
                                    <th>Währung</th>
                                    <th>Steuern</th>
                                    <th>Optionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productList as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->singlePrice / 100.00 }} €</td>
                                        <td>{{ $product->unit }}</td>
                                        <td>{{ $product->currency }}</td>
                                        <td>{{ $product->tax_rate * 100.00 }} %</td>
                                        <td>
                                            <button wire:click="editProduct({{ $product->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button wire:click="deleteProduct({{ $product->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
