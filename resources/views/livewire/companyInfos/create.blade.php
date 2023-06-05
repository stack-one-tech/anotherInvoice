<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" wire:click="$set('create_companyInfo_isOpen', true)">
    Add companyInfo
</button>
<!-- Modal -->
<div class="modal modal-lg @if($create_companyInfo_isOpen) show d-block @endif" id="addcompanyInfoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addcompanyInfoModalLabel">Firmendaten hinzufügen</h1>
                <button type="button" class="btn-close" aria-label="Close"
                        wire:click="$set('create_companyInfo_isOpen', false)"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col col-12 col-md-6">
                        <div class="form-group">
                            <label for="customerNumbr">Kundennummer</label>
                            <input type="text" class="form-control" id="customerNumbr" name="fullForename" wire:model="new_companyInfo.customerNumbr">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-12 col-md-6">
                        <div class="form-group">
                            <label for="companyName">Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" wire:model="new_companyInfo.companyName">
                        </div>
                        <div class="form-group">
                            <label for="fullForename">Forename</label>
                            <input type="text" class="form-control" id="fullForename" name="fullForename" wire:model="new_companyInfo.fullForename">
                        </div>
                        <div class="form-group">
                            <label for="fullSurname">Surname</label>
                            <input type="text" class="form-control" id="fullSurname" name="fullSurname" wire:model="new_companyInfo.fullSurname">
                        </div>
                        <div class="form-group">
                            <label for="supplement">Supplement</label>
                            <input type="text" class="form-control" id="supplement" name="supplement" wire:model="new_companyInfo.supplement">
                        </div>
                        <div class="form-group">
                            <label for="road">Road</label>
                            <input type="text" class="form-control" id="road" name="road" wire:model="new_companyInfo.road">
                        </div>
                        <div class="form-group">
                            <label for="houseNumber">House Number</label>
                            <input type="text" class="form-control" id="houseNumber" name="houseNumber" wire:model="new_companyInfo.houseNumber">
                        </div>
                        <div class="form-group">
                            <label for="streetSupplement">Street Supplement</label>
                            <input type="text" class="form-control" id="streetSupplement" name="streetSupplement" wire:model="new_companyInfo.streetSupplement">
                        </div>
                        <div class="form-group">
                            <label for="zipCode">Zip Code</label>
                            <input type="text" class="form-control" id="zipCode" name="zipCode" wire:model="new_companyInfo.zipCode">
                        </div>
                        <div class="form-group">
                            <label for="cityName">City Name</label>
                            <input type="text" class="form-control" id="cityName" name="cityName" wire:model="new_companyInfo.cityName">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" wire:model="new_companyInfo.country">
                        </div>
                    </div>
                    <div class="col col-12 col-md-6">
                        <div class="form-group">
                            <label for="countryCode">Country Code</label>
                            <input type="text" class="form-control" id="countryCode" name="countryCode" wire:model="new_companyInfo.countryCode">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" wire:model="new_companyInfo.phone">
                        </div>
                        <div class="form-group">
                            <label for="web">Web</label>
                            <input type="text" class="form-control" id="web" name="web" wire:model="new_companyInfo.web">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" wire:model="new_companyInfo.email">
                        </div>
                        <div class="form-group">
                            <label for="mimeLogoUrl">Logo URL</label>
                            <input type="text" class="form-control" id="mimeLogoUrl" name="mimeLogoUrl" wire:model="new_companyInfo.mimeLogoUrl">
                        </div>
                        <div class="form-group">
                            <label for="mimeLogoScale">Logo Scale</label>
                            <input type="text" class="form-control" id="mimeLogoScale" name="mimeLogoScale" wire:model="new_companyInfo.mimeLogoScale">
                        </div>
                        <div class="form-group">
                            <label for="iban">IBAN</label>
                            <input type="text" class="form-control" id="iban" name="iban" wire:model="new_companyInfo.iban">
                        </div>
                        <div class="form-group">
                            <label for="bic">BIC</label>
                            <input type="text" class="form-control" id="bic" name="bic" wire:model="new_companyInfo.bic">
                        </div>
                        <div class="form-group">
                            <label for="taxNumber">Tax Number</label>
                            <input type="text" class="form-control" id="taxNumber" name="taxNumber" wire:model="new_companyInfo.taxNumber">
                        </div>
                        <div class="form-group">
                            <label for="bankName">Bank Name</label>
                            <input type="text" class="form-control" id="bankName" name="bankName" wire:model="new_companyInfo.bankName">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="$set('create_companyInfo_isOpen', false)">Close
                </button>
                <button type="button" class="btn btn-primary" wire:click="saveCompanyInfo">Save changes</button>
            </div>
        </div>
    </div>
</div>

@if($create_companyInfo_isOpen)
    <div class="modal-backdrop fade show"></div>
@endif
