<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" wire:click="$set('create_product_isOpen', true)">
    Add Product
</button>
<!-- Modal -->
<div class="modal @if($create_product_isOpen) show d-block @endif" id="addProductModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProductModalLabel">Add Product</h1>
                <button type="button" class="btn-close" aria-label="Close"
                        wire:click="$set('create_product_isOpen', false)"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" wire:model="new_product.name">
                </div>
                <div class="form-group">
                    <label for="singlePrice">Single Price</label>
                    <input type="number" class="form-control" id="singlePrice" wire:model="new_product.singlePrice">
                </div>
                <div class="form-group">
                    <label for="unit">Unit</label>
                    <select class="form-control" id="unit" wire:model="new_product.unit">
                        <option value="Stk.">Stk.</option>
                        <option value="h">h</option>
                        <option value="psch.">psch.</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="currency">Currency</label>
                    <input type="text" class="form-control" id="currency"
                           wire:model="new_product.currency">
                </div>
                <div class="form-group">
                    <label for="tax_rate">Tax Rate</label>
                    <select class="form-control" id="tax_rate" wire:model="new_product.tax_rate">
                        <option value="19">19 %</option>
                        <option value="7">7 %</option>
                        <option value="0">0 %</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="$set('create_product_isOpen', false)">Close
                </button>
                <button type="button" class="btn btn-primary" wire:click="saveProduct">Save changes</button>
            </div>
        </div>
    </div>
</div>

@if($create_product_isOpen)
    <div class="modal-backdrop fade show"></div>
@endif
