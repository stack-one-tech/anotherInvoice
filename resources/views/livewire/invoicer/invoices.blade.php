<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Rechnungen</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('create_invoice') }}" class="btn btn-primary">Rechnung erstellen</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Empfänger</th>
                                    <th>ReNum</th>
                                    <th>Datum</th>
                                    <th>Betrag</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoiceList as $invoice)
                                    <tr>
                                        <td>{{ $invoice->reciverID }}</td>
                                        <td>{{ $invoice->invoiceNumber}}</td>
                                        <td>{{ $invoice->invoiceDate }}</td>
                                        <td>TODO</td>
                                        <td>
                                            <button wire:click="editInvoice({{ $invoice->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button wire:click="deleteInvoice({{ $invoice->id }})" class="btn btn-danger btn-sm">Delete</button>
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
