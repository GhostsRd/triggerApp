<div class="container bg-white shadow p-2 rounded-1 ">
    @if(auth()->user()->email  ==  config('app.email')  )
      <h4 class="fw-bold text-muted mt-1">Audit de versement</h4>
   
      @else
      <h4 class="fw-bold text-muted mt-1">Historique versement</h4>
          
      @endif
      <hr>
     <table class="table text-muted bg-white">
        <thead class="bg-white">
            <tr>
            {{-- <th scope="col" class="bg-white">ID</th> --}}
            <th class="bg-white">Utilisateur</th>
            <th class="bg-white">Type Action</th>
            {{-- <th class="bg-white">Date Operation</th> --}}
            <th class="bg-white">N° versement</th>
            <th class="bg-white">N° compte</th>
            <th class="bg-white">Nom client</th>
            <th class="bg-white">Ancien montant (Ar)</th>
            <th class="bg-white">Nouveau montant (Ar)</th>
            <th class="bg-white">Versement  (Ar)</th>
            
            <th class="bg-white">Date d'operation</th>
            {{-- <th class="bg-white"> Date de modification</th> --}}
        </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
                <tr>
                    {{-- <th class="bg-white" scope="row">{{ $audit->id }}</th> --}}
                    <td class="bg-white">
                <img src="https://ui-avatars.com/api/?name={{ $audit->utilisateur }}&background=0D8ABC&color=ffff"  class="rounded-circle" width="20" height="20">
                       
                        {{ $audit->utilisateur }}</td>
                    <td class="bg-white">{{$audit->type_action}}</td>
                    {{-- <td class="bg-white">{{ $audit->date_operation }}</td> --}}
                    <td class="bg-white text-center ">{{ $audit->num_versement }}</td>
                    <td class="bg-white"><span >{{ $audit->num_compte }}</span></td>
                    <td class="bg-white">
                        <img src="https://ui-avatars.com/api/?name={{ $audit->nom_client }}&background=0D8ABC&color=ffff"  class="rounded-circle" width="20" height="20">
                        {{ $audit->nom_client }}</td>
                    <td class="bg-white">{{ number_format($audit->ancien_montant, 0, ',', ' ') }}</td>
                    <td class="bg-white">
                        @if( $audit->nouveau_montant > $audit->ancien_montant )
                           <span class="text-success fw-bold"> {{ number_format($audit->nouveau_montant, 0, ',', ' ') }}</span>
                        @elseif($audit->nouveau_montant < $audit->ancien_montant )
                         <span class="text-danger fw-bold"> {{ number_format($audit->nouveau_montant, 0, ',', ' ') }}</span>
                        @else
                             <span class="text-dark fw-bold">  {{ number_format($audit->nouveau_montant, 0, ',', ' ') }}</span>
                        @endif
                    </td>
                    <td class="bg-white">
                        @foreach ($versements as $versement)
                        @if($versement->num_versement == $audit->num_versement)
                                @if( $audit->nouveau_montant > $audit->ancien_montant )
                                     <span class="text-success fw-bold">  {{ number_format($versement->montant, 0, ',', ' ') }}</span>  
                                @elseif($audit->nouveau_montant < $audit->ancien_montant )
                                     <span class="text-danger fw-bold">  {{ number_format($versement->montant, 0, ',', ' ') }}</span>  
                                @else
                                     <span class="text-dark fw-bold">  {{ number_format($versement->montant, 0, ',', ' ') }}</span>  

                                @endif
                                @endif
                        @endforeach
                    </td>
                    <td class="bg-white">{{ $audit->created_at->format('d M Y H:i:s') }}</td>
                    {{-- <td class="bg-white">{{ $audit->updated_at->format('d M Y H:i:s') }}</td> --}}


                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div>
        {{ $audits->links()}}
    </div>
    <div class="mb-3">
    <span class="badge bg-success">Nb Insertion : {{$count_insertion}}</span> 
    <span class="badge bg-primary">Nb Update : {{$count_update}}</span> 
    <span class="badge bg-danger">Nb Deletion : {{$count_deletion}}</span>
</div>
</div>

