<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Audit_versement;

class AuditVersement extends Component
{
    
    public function render()
    {
        $audits = Audit_versement::all();
        return view('livewire.audit_versement',
        [
            'audits' => $audits,
        ]);
    }
}
