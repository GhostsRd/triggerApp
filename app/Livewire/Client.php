<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client as clientModels;
class Client extends Component
{
    public $nomclient;
    public $num_compte;
    public $solde;

    public function render()
    {
        $data = clientModels::all();
        return view('livewire.client', [
            'clients' => $data,
        ]);
    }

    public function store(ClientModels $client){
        $client->nomclient = $this->nomclient; 
        $client->num_compte = $this->num_compte; 
        $client->solde = $this->solde; 
        $client->save();
    }
    
}
