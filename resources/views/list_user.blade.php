@section('title','Lister les utilisateurs')

@include('layout.header')
<h2>Liste des utilisateurs</h2><br>

<table class="table ">
    <thead>
    <tr>
        <td>Id</td>
        <td>Nom</td>
        <td>Email</td>
        <td>Nombre de posts</td>
        <td>Etat</td>
        <td>Options</td>
    </tr>
    </thead>

    <tbody>
    @foreach($listUsers as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->nom}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->posts_count}}</td>
            <td>
                <a href="{{ route('change.state.user', $user) }}"
                   class="btn btn-{{$user->etat==1 ? 'primary': 'danger'}}">
                    <i class="fas fa-toggle-{{$user->etat==1 ? 'on': 'off'}}"></i>
                </a>
            </td>
            <td>
                <a href="{{ route('delete.user', $user->id) }}" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>
@include('layout.footer')
