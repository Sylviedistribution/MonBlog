@section('title','Lister les postes')

@include('layout.header')
<h2>Liste des Postes</h2>
<div class="row float-right">
    @if(auth()->user()->role == "admin")
        <a href="{{route('create.categorie')}} " class="btn tm-btn-primary p-2 mr-2">
            <i class="fas fa-tag"></i> Créer une catégorie
        </a>
    @endif
    <a href="{{route('create.post')}} " class="btn tm-btn-primary px-3" style="margin-right: 30px">
        <i class="fas fa-blog"></i> Créer un post
    </a>
</div>
<table class="table" style="overflow-x: auto;">
    <thead>
    <tr>
        <td>Id</td>
        <td>Auteur</td>
        <td>Titre</td>
        <td>Slug</td>
        <td>Categorie</td>
        <td>Image</td>
        <td>Options</td>
    </tr>
    </thead>
    <tbody>
    @forelse($listPosts as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->user->nom}}</td>
            <td>{{$p->titre}}</td>
            <td>{{$p->slug}}</td>
            <td>{{$p->categorie}}</td>
            <td><img src="{{$p->imageUrl()}}" alt="" class="rounded-5" style="width: 60px; height: 60px"></td>
            <td>
                <a href="{{ route('edit.post', $p) }}" class="btn btn-warning">
                    <i class="fas fa-book"></i>
                </a>
                <a href="{{ route('delete.post', $p) }}" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i>
                </a>

            </td>
        </tr>
    @empty

    @endforelse
    </tbody>
</table>

{{ $listPosts->links('vendor.pagination.personalPagination') }}

@include('layout.footer')
