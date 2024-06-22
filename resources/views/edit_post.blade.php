@section('title','Editer un post')

@include('layout.header')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h2>Editer le post</h2>
        </div>
        <div class="card-body col-12">
            <form method="POST" class="tm-mb-80" action="{{route("update.post",$post)}}" enctype="multipart/form-data" >
                @csrf
                <h3>Titre</h3>
                <input name="titre" type="text" value="{{ old('titre',$post->titre) }}"
                       class="form-control @error('titre') is-invalid @enderror">
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
                <textarea id="content" name="contenu" rows="6" cols="50" class="form-control @error('contenu') is-invalid @enderror">{{old('contenu',$post->contenu)}}
                </textarea>
                @error('contenu')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror<br>

                <h3>Choisir une image</h3>
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)"
                        class="@error('image') is-invalid @enderror"><br>
                @error('image')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <img id="preview" src="{{$post->imageUrl()}}" alt="Aperçu de l'image"
                     style="width: 500px; height: 500px;"><br><br>

                <button class="tm-btn-primary" type="submit">
                    Modifier
                </button>
            </form>
        </div>
    </div>

@include('layout.footer')
