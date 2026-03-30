<div class="container">
      <h3>Audit de versement</h3>
     <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th>Type Action</th>
            <th>Date Operation</th>
            <th>Num Versement</th>
            <th>Num Compte</th>
            <th>Nom Client</th>
            <th>Ancien Montant</th>
            <th>Nouveau Montant</th>
            <th>Utilisateur</th>
            <th>Date de creation</th>
            <th>Date de modification</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
                <tr>
                    <th scope="row">{{ $audit->id }}</th>
                    <th>{{$audit->type_action}}</th>
                    <td>{{ $audit->date_operation }}</td>
                    <td>{{ $audit->num_versement }}</td>
                    <td>{{ $audit->num_compte }}</td>
                    <td>{{ $audit->nom_client }}</td>
                    <td>{{ $audit->ancien_montant }}</td>
                    <td>{{ $audit->nouveau_montant }}</td>
                    <td>{{ $audit->utilisateur }}</td>
                    <td>{{ $audit->created_at }}</td>
                    <td>{{ $audit->updated_at }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
</div>

