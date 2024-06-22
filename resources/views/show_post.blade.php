@section('title','Voir un article')

@include('layout.header')
<div class="row tm-row">
    <div class="col-12">
        <hr class="tm-hr-primary tm-mb-55">
        <!-- Video player 1422x800 -->
        <img style="width:100%; height:600px" src="{{$post->imageUrl()}}" alt="Image" class="img-fluid">

    </div>
</div>
<div class="container-fluid col-md-12">
    <div class="tm-post-full">
        <div class="mb-4">
            <h2 class="pt-2 tm-color-primary tm-post-title">Titre: {{$post->titre}}</h2>
            <p class="tm-mb-40">Posté le {{$post->created_at->format('d/m/Y H:i')}}
                par {{$user->nom}}</p>
            <p>
                {{$post->contenu}}
            </p>

            <span class="d-block text-right tm-color-primary">Creative . Design . Business</span>
        </div>

        <!-- Comments -->
        <div>
            <h2 class="tm-color-primary tm-post-title">Commentaires</h2>
            <hr class="tm-hr-primary">
            <div class="tm-mb-40 column">
                @forelse($listeComments as $c)
                    <div class="ml-3 mb-2" style="display: flex">
                        <figure class="tm-comment-figure">
                            <img style="width: 70px" src="{{asset("img/img.png")}}" alt="Image"
                                 class="mb-2 rounded-circle img-thumbnail">
                            <figcaption class="tm-color-primary text-center">{{$c->auteur}}</figcaption>
                        </figure>
                        <div class="col-md-10 text-justify">
                            <p>{{$c->message}}</p>
                            <div class="d-flex">
                                <span class="tm-color-primary ">{{$c->created_at->format('d/m/Y H:i:s')}}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="ml-3 row">
                        <p>
                            Aucun commentaire
                        </p>
                    </div>
            </div>
            @endforelse
        </div>

        @auth
            <form action="{{route("comment.store",$post->id)}}" method="POST" class="mb-5">
                @csrf
                <div class="mb-4">
                    Votre commentaire
                    <textarea class="form-control" name="message" rows="6"></textarea>
                </div>
                <div class="text-right">
                    <button class="tm-btn tm-btn-primary tm-btn-small" type="submit">Envoyer</button>
                </div>
            </form>
        @else
            <div class="col-md-12 justify-content-center align-items-center text-center "
                 style="background-color: #ff945c">
                <i class="fas fa-exclamation-triangle mt-1" style="color: white; font-size: 60px"></i>
                <p style="color: white;">Information <br> Seuls les membres peuvent ajouter un commentaire.<br>
                    <b>Merci de vous enregister !</b></p>
            </div>

            <!-- TENTATIVE D'INSCRIPTION DIRECTE LORS DE LA SAISIE DU COMMENTAIRE ECHOUE
                <form action="{{route("comment.store", $post->id)}}" method="POST" class="mb-5">
                    @csrf
            <h2 class="tm-color-primary tm-post-title mb-4">Votre commentaire</h2>
            <div class="mb-4">
                <input class="form-control" name="nom" type="text" placeholder="Nom">
            </div>
            <div class="mb-4">
                <input class="form-control" name="email" type="text" placeholder="Email">
            </div>
            <div class="mb-4">
                <input class="form-control" name="password" type="password" placeholder="Password">
            </div>
            <div class="mb-4">
                Commentaire
                <textarea class="form-control" name="message" rows="6"
                          placeholder="Ecrivez votre commentaire ici"></textarea>
            </div>
            <div class="text-right">
                <button class="tm-btn tm-btn-primary tm-btn-small" type="submit">Envoyer</button>
            </div>
        </form> -->
        @endauth
    </div>
</div>
@include('layout.footer')
