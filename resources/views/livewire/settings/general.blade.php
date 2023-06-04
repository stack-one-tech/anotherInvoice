<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex w-100 justify-content-between">
                        <h2>Allgemeine Einstellungen</h2>
                        <div><button class="btn btn-primary" wire:click="saveSettings">
                                save
                            </button></div>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="myCompDataList" class="form-label">Meine Firma wählen:</label>
                            <input class="form-control" list="datalistOptions" id="myCompDataList" wire:model="myCompanyName"
                                   placeholder="Firma festlegen...">
                            <datalist id="datalistOptions">
                                @foreach(\App\Models\CompanyInfo::all() as $comp)
                                    <option value="{{$comp->companyName}}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
