<div class="container-fluid">
    <main class="row">
        <div class="col col-12 col-md-2 p-2" style="">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <div class="nav-link @if($activeMenue === 'general') active @endif" aria-current="page"
                         wire:click="$set('activeMenue', 'general')">
                        Allgemein
                    </div>
                </li>
            </ul>
        </div>
        <div class="col col-12 col-md-10 p-2">
            @include('livewire.settings.' . $activeMenue)
        </div>
    </main>
</div>
