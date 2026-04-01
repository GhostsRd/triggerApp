<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Audit_versement;
use Livewire\WithPagination;
use App\Models\Client;
use App\Models\Versement;


class AuditVersement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
   // public $audits;

    public function render()
    {
        $audits = [];
        $client = Client::where('nomclient',auth()->user()->name)->first();
        if(auth()->user()->email != config('app.email') ){
            $audits = Audit_versement::where('num_compte',$client->num_compte)->orderBy('updated_at','desc')->paginate(10);
        }
        
         if(auth()->user()->email == config('app.email') ){
      
            $audits = Audit_versement::orderBy('updated_at', 'desc')
            ->paginate(20);
        }
        $count_insertion = Audit_versement::where('type_action','insertion')->count();
        $count_update = Audit_versement::where('type_action','update')->count();
        $count_deletion = Audit_versement::where('type_action','delete')->count();

        return view('livewire.audit_versement',
        [
            'audits' => $audits,
            'versements' => Versement::all(),
            'count_insertion' => $count_insertion,
            'count_update' => $count_update,
            'count_deletion' => $count_deletion,


        ]);
    }
}
