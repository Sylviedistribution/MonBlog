<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    // Affiche le formulaire d'inscription
    public function register()
    {
        return view('auth/register');
    }

    // Traitement de la soumission du formulaire d'inscription

    /**
     * @throws ValidationException
     */
    public function registerSave(Request $request)
    {
        // Validation des données du formulaire
        Validator::make($request->all(), [
            'nom' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();


        // Création d'un nouvel utilisateur
        User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'etat' => true
        ]);

        // Redirection vers la page de connexion après l'inscription réussie
        return redirect()->route('login');
    }

    // Affiche le formulaire de connexion
    public function login()
    {
        return view('auth/login');
    }

    // Traitement de la soumission du formulaire de connexion

    /**
     * @throws ValidationException
     */
    public function loginAction(Request $request)
    {
        // Validation des données du formulaire
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();


        $user = User::where('email', $request->email)->first();

        // Authentification de l'utilisateur

        //La methode attempt prend en parametre un tableau de credential
        /*La methode
        Auth::login(User::find($id)) permet de connecter un utilisateur en local
        sans passer par le formulaire de connection
        Auth::loginUsingId()*/

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // En cas d'échec d'authentification, renvoie une erreur de validation
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        } else if ($user->etat == false) {
            return redirect()->back()->with('error', 'Votre compte a été suspendu');//with met des informations sur les sessions sous format cle valeur

        }


        //session c'est golbal

        // Régénération de la session
        //session()->regenerate() cette methode n'est pas recommandee car on evite d'utiliser les variable globales
        $request->session()->regenerate();


        return redirect()->intended(route('index'));
        /*Lorsque vous utilisez redirect()->intended(), Laravel vérifie s'il existe une session
         *enregistrant l'URL précédemment demandée par l'utilisateur.Si une URL précédente est trouvée
         *dans la session (généralement stockée lorsque l'utilisateur est redirigé vers la page de connexion ou
         *une autre page nécessitant une authentification), Laravel redirigera l'utilisateur vers cette URL.*/
    }

    // Déconnexion de l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidation de la session
        $request->session()->invalidate();

        // Redirection vers la page d'accueil après la déconnexion
        return redirect()->route('index');
    }

}
