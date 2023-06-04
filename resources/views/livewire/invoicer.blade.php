<div class="container-fluid">
    <main class="row">
        <div class="col col-12 col-md-2 p-2" style="">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <div class="nav-link @if($activeMenue === 'invoices') active @endif" aria-current="page"
                    wire:click="$set('activeMenue', 'invoices')">
                        Rechnungen
                    </div>
                </li>
                <li>
                    <div class="nav-link @if($activeMenue === 'products') active @endif"
                         wire:click="$set('activeMenue', 'products')">
                        Produkte
                    </div>
                </li>
                <li>
                    <div class="nav-link @if($activeMenue === 'companyInfos') active @endif"
                         wire:click="$set('activeMenue', 'companyInfos')">
                        Adressen
                    </div>
                </li>
            </ul>
        </div>
        <div class="col col-12 col-md-10 p-2">
            @include('livewire.invoicer.' . $activeMenue)
        </div>
    </main>
</div>
