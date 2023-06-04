<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" wire:click="$set('create_invoice_isOpen', true)">
    Add invoice
</button>
<!-- Modal -->
<div class="modal modal-lg @if($create_invoice_isOpen) show d-block @endif" id="addInvoiceModal" tabindex="-1">
    <div class="modal-dialog" style="z-index: 1100;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addInvoiceModalLabel">neue Rechnung</h1>
                <button type="button" class="btn-close" aria-label="Close"
                        wire:click="$set('create_invoice_isOpen', false)"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-3">
                        <div class="form-group">
                            <label for="iban">Kunde</label>
                            <input type="text" class="form-control" id="iban" name="iban" wire:model="newInvoiceRecAddr">
                            @if($invoiceRecAutoCompleteList)
                                    @foreach($invoiceRecAutoCompleteList as $item)
                                        <div class="autocomplete-suggestion" wire:click="setInvoiceReciverAddr({{$item['id']}})"
                                            {{$item['name']}}
                                        </div>
                                    @endforeach
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="$set('create_invoice_isOpen', false)">Close
                </button>
                <button type="button" class="btn btn-primary" wire:click="saveinvoice">Save changes</button>
            </div>
        </div>
    </div>
</div>

@if($create_invoice_isOpen)
    <div class="modal-backdrop fade show"></div>
@endif
