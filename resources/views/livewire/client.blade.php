<div class="container">

    <h3>Clients</h3>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nouveau
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" wire:submit.prevent="store" >
                <div class="modal-body">
                        <label for="">Nom du client</label>
                        <input type="text" wire:model='nomclient' class="form-control" placeholder="Nom de produit">
                        <label for="">numero de compte</label>
                        <input type="number" name="" id="" wire:model="num_compte" class="form-control">

                        </textarea>
                        <label for="">Solde (Ar)</label>
                        <input type="number" wire:model='solde' class="form-control" placeholder="Nouveau">
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
     <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom du client</th>
                <th scope="col">Numero de compte</th>
                <th scope="col">Solde</th>
                <th>Action</th>
              
                
                
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <th scope="row">{{ $client->id }}</th>
                    <td>{{ $client->nomclient }}</td>
                    <td>{{ $client->num_compte }}</td>
                    <td>{{ $client->solde }}</td>
                    <td><button class="btn btn-sm " wire:click="edit({{ $client->id }})">Edit</button>
                        <button class="btn btn-sm" wire:click="delete({{ $client->id }})">Delete</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
