<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Firmendaten </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('livewire.companyInfos.create')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Stadt</th>
                                    <th>Optionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companyInfoList as $companyInfo)
                                    <tr>
                                        <td>{{ $companyInfo->companyName }}</td>
                                        <td>{{ $companyInfo->email }}</td>
                                        <td>{{ $companyInfo->zipCode }} {{ $companyInfo->cityName }}</td>
                                        <td>
                                            <button wire:click="editCompanyInfo({{ $companyInfo->id }})"
                                                    class="btn btn-primary btn-sm">Edit</button>
                                            <button wire:click="deleteCompanyInfo({{ $companyInfo->id }})"
                                                    class="btn btn-danger btn-sm">Delete</button>
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
