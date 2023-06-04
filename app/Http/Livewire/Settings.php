<?php

namespace App\Http\Livewire;

use App\Models\CompanyInfo;
use Auth;
use Livewire\Component;

class Settings extends Component
{
    public $activeMenue = 'general';

    public $myCompanyName = null;

    public function mount()
    {
        $this->myCompanyName = CompanyInfo::find(Auth::user()->company_id)->companyName;
    }

    public function render()
    {
        return view('livewire.settings');
    }

    public function saveSettings() {
        $u = Auth::user();
        $u->company_id = CompanyInfo::where('companyName', $this->myCompanyName)->first()->id;
        $u->save();
    }
}
