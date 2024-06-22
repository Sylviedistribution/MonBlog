@include('layout.header')
<div class="container-fluid">

    <!-- Search form -->
    <div class="card">
        <div class="card-header text-center">
            <h2>Ajouter une nouvelle catégorie</h2>
        </div>
        <div class="card-body">
            <form method="POST" class=" tm-mb-80" action="{{route("save.categorie")}}">
                @csrf
                <h3>Nom</h3>
                <input name="nom" type="text" class="form-control @error('nom') is-invalid @enderror">
                @error('nom')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror<br>
                <button class="tm-btn-primary" type="submit">
                    Ajouter
                </button>
            </form>
        </div>
    </div>

@include('layout.footer')
