@section('title','Accueil du blog')

@include('layout.header')

<div class="row tm-row">
    @foreach($listePostes as $p)

        <article class="col-12 col-md-6 tm-post">
            <hr class="tm-hr-primary">
            <a href="{{route('show.post',['slug'=>$p->slug, 'id'=>$p->id])}}" class="effect-lily tm-post-link tm-pt-60">
                <div class=" tm-post-link-inner">
                    <img style="width:100%; height:300px" src="{{$p->imageUrl()}}" alt="Image" class="img-fluid">
                </div>
                <span class="position-absolute tm-new-badge">New</span>
                <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{$p->titre}}</h2>
            </a>
            <p class="tm-pt-30">
                {{ \Illuminate\Support\Str::words($p->contenu, 30,'...') }}
            </p>
            <a href="{{route('show.post',['slug'=>$p->slug, 'id'=>$p->id])}}">Lire la suite</a>
            <div class="d-flex justify-content-between tm-pt-45">
                <span class="tm-color-primary"> <strong>Catégorie:</strong> {{$p->categorie}}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span>{{$p->comments_count}} commentaires</span>
                <span class="tm-color-primary">Publié le {{$p->created_at->format('d/m/Y')}} par {{$p->user->nom }}
                </span>
            </div>
        </article>
    @endforeach
</div>
{{ $listePostes->links('vendor.pagination.personalPagination') }}

@include('layout.footer')
