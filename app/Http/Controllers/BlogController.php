<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Models\Categorie;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //POST

    //FONCTIONS DE LISTING

    public function index()
    {
        //JE DOIS APPRENDRE A RENDRE LES VARIABLE GLOBALES POUR NE PAS REPETER LISTE CATEGORIES
        $listePostes = Post::withCount('comments')->with('user')->paginate(6);
        $listeCategories = Categorie::all();

        return view('index', compact('listePostes', 'listeCategories'));

    }

    public function show($slug, $id)
    {

        $post = Post::where('id', $id)->with('comments')->where('slug', $slug)->first();


        //Utilisation de la relation entre post et user pour recuperer l'utilisateur
        $user = $post->user;
        //ou bien $user = User::findOrFail($post->user_id);


        $listeComments = $post->comments()->orderBy("created_at", "desc")->get();

        $listeCategories = Categorie::all();


        return view('show_post', compact('post', 'listeComments', 'listeCategories', 'user'));
    }

    public function listPost()
    {
        $listPosts = Post::with('user')->paginate(10);
        $listeCategories = Categorie::all();

        return view('list_post', compact('listPosts', 'listeCategories'));

    }

    public function listMyPost(User $user)
    {
        $listPosts = Post::where('user_id',$user->id)->paginate(10);
        $listeCategories = Categorie::all();

        return view('list_post', compact('listPosts', 'listeCategories'));

    }

    public function search(Request $request)
    {
        $motCle = $request->motCle;
        $listeCategories = Categorie::all();

        if ($motCle == "") {
            $listePostes = Post::withCount('comments')->with('user')->paginate(6);
            return view('index', compact('listePostes', 'listeCategories'));
        } else {
            $listePostes = Post::withCount('comments')->with('user')->where('titre', 'like', '%' . $motCle . '%')->paginate(6);
            return view('index', compact('listePostes', 'listeCategories'));
        }
    }

    //FONCTIONS D'ACTION
    public function create()
    {
        $listeCategories = Categorie::all();

        return view('create_post', compact('listeCategories'));
    }

    public function store(BlogFilterRequest $request)
    {
        //Valider donnner
        $request->validated();

        /*Validator::make($request->all(), [
            'titre' => 'required|min:4',
            'categorie' => 'required',
            'contenu' => 'required',
            'image' => 'required',

        ])->validate();*/

        $image = $request->image;
        //Creer le chemin de l'image
        if ($image && !$image->getError()) {
            $imagePath = $image->store('imagePost', 'public'); // Utilisation d'un chemin spécifique
        } else {
            // Gérer l'erreur si le fichier n'est pas présent
            return back()->withErrors(['image' => 'Image non telecharger']);
        }
        //Generation du slug pour personnaliser les urls
        $chaine = $request['categorie'] .'-'. $request['titre'];
        $slug = Str::slug($chaine);

        $user_id = auth()->user()->id;
        //Creer le post
        Post::create([
            'titre' => $request->titre,
            'slug' => $slug,
            'contenu' => $request->contenu,
            'categorie' => $request->categorie,
            'imagePath' => $imagePath,
            'user_id' => $user_id
        ]);

        return to_route('index')->with('success', "L'article a bien été sauvegardé");
    }

    public function edit(Post $post)
    {
        $listeCategories = Categorie::all();

        return view('edit_post', compact('post', 'listeCategories'));

    }

    public function update(Request $request, Post $post)
    {// Valider les données de la requête
        Validator::make($request->all(), [
            'titre' => 'required|min:4',
            'categorie' => 'required',
            'contenu' => 'required',
            'image' => 'required',

        ])->validate();

        // Si une nouvelle image est uploadée, gérer le téléchargement
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image && !$image->getError()) {
                // Supprimer l'ancienne image si elle existe
                if ($post->imagePath) {
                    Storage::disk('public')->delete($post->imagePath);
                }

                // Télécharger la nouvelle image et mettre à jour le chemin
                $imagePath = $image->store('imagePost', 'public');
                $validatedData['imagePath'] = $imagePath;
            }
        }

        // Mettre à jour le post avec les données validées
        $post->update([
            'titre' => $request->titre,
            'categorie'=> $request->categorie,
            'contenu' => $request->contenu,
            'imagePath' => $imagePath,
        ]);

        return redirect()->route('list.my.post',auth()->user())->with('success', "L'article a bien été modifié");
    }

    public function delete(Post $post)
    {
        $post->delete();

        return to_route('index')->with('success', "L'article a bien été supprimé");

    }


    //USER
    public function listUser()
    {
        $listUsers = User::withCount('posts')->paginate(10);
        $listeCategories = Categorie::all();

        return view('list_user', compact('listUsers', 'listeCategories'));

    }

    public function changeState(User $user)
    {
        $change = !$user->etat;

        $user->update([
            'etat' => $change,
        ]);
        return to_route('list.user');
    }

    //CATEGORIES

    //FONCTIONS DE LISTING
    public function afficherParCategorie(Request $request, string $slug)
    {
        $listeCategories = Categorie::all();

        $categorie = Categorie::where('slug', 'LIKE', '%' . $slug . '%')->first();

        $listePostes = Post::withCount('comments')->with('user')->where('categorie', 'LIKE', '%' . $categorie->nom . '%')->paginate(6);

        return view('index', compact('listePostes', 'listeCategories'));
    }

    public function createCategorie()
    {
        $listeCategories = Categorie::all();
        return view('create_categorie', compact('listeCategories'));
    }

    public function saveCategorie(Request $request)
    {
        Validator::make($request->all(), [
            'nom' => 'required|max:25',
        ])->validate();

        $slug = Str::slug($request['nom']);

        Categorie::create([
            'nom' => $request->nom,
            'slug' => $slug,
        ]);
        return redirect()->back()->with('success',"La catégorie a été créée avec succès.");
    }


    //COMMENTAIRE
    public function commentStore(Request $request, $post_id)
    {
        $slug = Post::where('id', $post_id)->value('slug'); // Récupère directement la valeur du slug
        if (Auth::check()) {
            Validator::make($request->all(), [
                'message' => 'required'
            ])->validate();

            $user = Auth::user();

            Comment::create([
                'auteur' => $user->nom,
                'message' => $request->message,
                'user_id' => $user->id,
                'post_id' => $post_id
            ]);

            return redirect()->route('show.post', ['slug' => $slug, 'id' => $post_id]);
        } else {
            /*
            Validator::make($request->all(), [
                'nom' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'message' => 'required'
            ])->validate();

            $user = User::create([
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            $comment = Comment::create([
                'auteur' => $user->nom,
                'message' => $request->message,
                'user_id' => $user->_id,
                'post_id' => $post_id
            ]);*/
            return redirect()->back();
        }
    }
}
