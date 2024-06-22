@section('title','Creer un poste')

@include('layout.header')
<div class="container-fluid">

    <!-- Search form -->
    <div class="card">
        <div class="card-header text-center">
            <h2>Créer un nouveau post</h2>
        </div>
        <div class="card-body">
            <form method="POST" class=" tm-mb-80" action="{{route("store.post")}}" enctype="multipart/form-data">
                @csrf
                <h3>Titre</h3>
                <input name="titre" type="text" class="form-control @error('titre') is-invalid @enderror"
                       value="{{ old('titre')}}">
                @error('titre')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror<br>

                <h3>Categories</h3>
                <select name="categorie" class="form-control @error('categorie') is-invalid @enderror">
                    <option></option>
                    @foreach($listeCategories as $c)
                        <option value="{{old('categorie',$c->nom)}}">{{$c->nom}}</option>
                    @endforeach
                </select>
                @error('categorie')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror<br>

                <h3>Contenu</h3>
                <textarea id="content" name="contenu" rows="6" class="form-control @error('contenu') is-invalid @enderror">{{ old('contenu')}}</textarea>
                @error('contenu')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <br>

                <h3>Choisir une image</h3>
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)"
                       class="@error('image') is-invalid @enderror"><br>
                @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <!--PREVISUALITION DE L'IMAGE -->

                <img id="preview" src="#" alt="Aperçu de l'image"
                     style="display: none; width: 600px; height: 600px;"><br><br>

                <button class="tm-btn-primary" type="submit">
                    Poster
                </button>
            </form>
        </div>
    </div>

@include('layout.footer')
