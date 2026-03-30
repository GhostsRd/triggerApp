<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Versement as ModelVersement;
use App\Models\Client;
use App\Models\Audit_versement;

class Versement extends Component
{
    public $num_cheque;
    public $num_compte;
    public $montant;
    public $num_versement;
    public $current_user;
    public $new_montant;
    public $operation;

    protected $listeners = ['refresh' => '$refresh'];

    public function store(ModelVersement $versenent,Client $client){
        
        $current_user = Client::where('num_compte',$this->num_compte)->first();
        if($current_user){
            $current_user->solde = $this->montant + $current_user->solde;
            $current_user->save();
        }else{
              echo 'introuvable user';
        }
        $client_nouveausolde = Client::where('num_compte',$this->num_compte)->first();
        $dernier_versement = ModelVersement::latest()->first()->num_versement + 1;
         //dd($dernier_versement);
        DB::statement("SET @app_type_action = ?", [auth()->user()->email ?? null]);
        DB::statement("SET @app_num_compte = ?", [$this->num_compte ?? null]);
        DB::statement("SET @app_nom_client = ?", [$current_user->nomclient ?? null]);
        DB::statement("SET @app_ancien_montant = ?", [$current_user->solde]);
        DB::statement("SET @app_utilisateur = ?", [auth()->user()->name ?? null]);
        DB::statement("SET @app_nouveau_montant = ?", [$client_nouveausolde->solde]);
        DB::statement("SET @app_num_versement = ?", [$dernier_versement ?? null]);

        $versenent->num_cheque = $this->num_cheque; 
        $versenent->num_compte = $this->num_compte; 
        $versenent->montant = $this->montant; 
        $versenent->save();
        
        //dd($current_user->solde);
       $this->reset();
       
    }
    public function verifier_compte(Client $client){
      
        $this->current_user = Client::where('num_compte', $this->num_compte)->first();
    }
    public function edit($id){
  
      $current_versement = ModelVersement::where('num_versement',$id)->first();
      $this->current_user = Client::where('num_compte', $current_versement->num_compte)->first();
      $this->num_compte = $current_versement->num_compte;
      $this->num_cheque= $current_versement->num_cheque;
      $this->montant = $current_versement->montant;
      $this->num_versement = $current_versement->num_versement;


    }

    public function update(){
    $current_versement = ModelVersement::where('num_versement',$this->num_versement )->first();
    $current_user = Client::where('num_compte', $current_versement->num_compte)->first();
    if($this->operation == 'exces'){
        $current_versement->montant = (float) $current_versement->montant - (float) $this->new_montant; 
        ModelVersement::where('num_versement',$this->num_versement )->update(
            ['montant' => $current_versement->montant],
        );
        
        //dd($current_versement->montant,$this->new_montant);
        $current_user->solde = $current_user->solde - $this->new_montant;
        $current_user->save();
    }
    if($this->operation == 'manque'){
       $current_versement->montant = $current_versement->montant + $this->new_montant; 
       ModelVersement::where('num_versement',$this->num_versement )->update(
            ['montant' => $current_versement->montant],
        );
        $current_user->solde = $current_user->solde + $this->new_montant;
        $current_user->save();
    }
    if($this->operation == 'erreur'){
    $current_versement->montant = 0; 
    ModelVersement::where('num_versement',$this->num_versement )->update(
            ['montant' => $current_versement->montant],
        );
    $current_user->solde = $current_user->solde - $this->montant;
    $current_user->save();
    }
    $this->emitSelf('refresh');
    }
    public function mount(){
      
        //dd($this->current_user);
       $this->num_compte;
       $this->num_cheque;
       $this->num_versement;
       $this->montant;
       $this->current_user;
    }
    public function delete($id){
     
        $versement = ModelVersement::where('num_versement',$id)->delete();
     
    }
    public function render()
    {   
        $versement = Modelversement::all();
        return view('livewire.versement',[
            'versements' => $versement,
        ]);
    }
    
}
