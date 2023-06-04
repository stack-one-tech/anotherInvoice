<div class="container-fluid">
    <main class="row">
        <div class="col col-12 col-md-2 p-2" style="">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <div class="nav-link" aria-current="page" wire:click="redirectBack">
                        zurück
                    </div>
                </li>
            </ul>
        </div>
        <div class="col col-12 col-md-9 p-2">
            <div class="mt-2 d-flex justify-content-between">
                <div>
                    @if($editId !== null)
                        <h2>Rechnung {{$editId}} editieren</h2>
                    @else
                        <h2>neue Rechnung</h2>
                    @endif
                </div>
                <div>
                    <button class="btn btn-primary" wire:click="saveInvoice">
                        @if($editId !== null)
                            Änderungen speichern
                        @else
                            Erstellen
                        @endif
                    </button>
                    <button class="btn btn-outline-secondary" wire:click="testGenerateInvoice">Testen</button>
                </div>

            </div>

            <hr>
            <div class="row">
                <div class="col col-12 col-md-4">
                    Absender: {{$sender?->companyName}}
                    <select class="form-select mt-2" aria-label="Default select example" wire:model="newInvoice.reciverID">
                        <option value="null" disabled>Empfänger</option>
                        @foreach($companyList as $company)
                            <option @if($customer?->CompanyName === $company->companyName) selected @endif
                            value="{{ $company->id }}">{{ $company->companyName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-12 col-md-4">

                </div>
                <div class="col col-12 col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rechnungsnummer</span>
                        <input type="text" class="form-control" wire:model="newInvoice.invoiceNumber"
                               aria-label="Rechnungsnummer" aria-describedby="basic-addon1">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">RechnungsDatum</span>
                        <input type="text" class="form-control" wire:model="newInvoice.invoiceDate"
                               aria-label="Rechnungsnummer" aria-describedby="basic-addon1">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Kundennummer</span>
                        <input disabled type="text" class="form-control" value="{{$customer?->customerNumbr}}"
                               aria-label="Rechnungsnummer" aria-describedby="basic-addon1">

                    </div>
                </div>
            </div>
            <hr>

            <div class="row mb-3">
                <div class="col col-12 col-md-12">
                    <div class="input-group">
                        <span class="input-group-text">openingText</span>
                        <textarea class="form-control" aria-label="With textarea"
                                  wire:model="newInvoice.openingText" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col col-12 col-md-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Text Leistungszeitraum:</span>
                        <input type="text" class="form-control" wire:model="newInvoice.serviceTimeText">
                    </div>
                </div>
            </div>
            <hr>

            <div>
                <div class="mb-3">
                    <button class="btn btn-primary" wire:click="$set('addProductModalIsOpen', true)">Add Product</button>
                </div>
                <div class="modal @if($addProductModalIsOpen) d-block @endif" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        wire:click="$set('addProductModalIsOpen', false)"></button>
                            </div>
                            <div class="modal-body">
                                @foreach($productList as $product)
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>{{ $product->name }}</span>
                                        <button class="btn btn-primary" wire:click="addProduct({{ $product->id }})">Add</button>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        wire:click="$set('addProductModalIsOpen', false)">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Menge</th>
                        <th>Einheit</th>
                        <th>Beschreibung</th>
                        <th>Optionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( json_decode($newInvoice['invoice_items']) as $item)
                        @php
                            $product = \App\Models\Product::find($item->product_id);
                        @endphp
                        <tr wire:key="{{ $product->id }}">
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                <input wire:change="updateQty({{$loop->index}}, $event.target.value)"
                                       type="number" name="qty_p_{{$product->id}}" id="qty_p_{{$product->id}}" step=".01"
                                       value="{{$item->qty}}">
                                {{$item->qty}}
                            </td>
                            <td>{{$product->unit}}</td>
                            <td> {{$product->name}}</td>
                            <td>
                                <button wire:click="deleteProduct({{$loop->index}})" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


            <hr>
            <div class="row">
                <div class="col col-12 col-md-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Ust Hinweis</span>
                        <input type="text" class="form-control" wire:model="newInvoice.ustNotice">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-12 col-md-12">
                    <div class="input-group">
                        <span class="input-group-text">closingText</span>
                        <textarea class="form-control" aria-label="With textarea" rows="8"
                                  wire:model="newInvoice.closingText"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @if($preview_pdf)
        <div class="modal modal-lg fade show" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel" style="display: block;"
             aria-modal="true"
             role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLiveLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="$set('preview_pdf', false)"></button>
                    </div>
                    <div class="modal-body">
                        <iframe src="{{route('previewInvoice')}}" frameborder="0" class="w-100 border-0" style="height: 75vh;"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                wire:click="$set('preview_pdf', false)">Abbr.
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="saveInvoice"
                        >Rechnung erstellen
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
