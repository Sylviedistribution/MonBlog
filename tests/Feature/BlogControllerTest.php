<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Categorie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    // Test pour la méthode index
    public function test_index_displays_all_posts_and_categories()
    {
        // Création d'un utilisateur
        $user = User::factory()->create();

        // Création de catégories
        $categories = Categorie::factory()->count(3)->create();

        // Création de posts associés à un utilisateur et une catégorie existante
        $posts = Post::factory()->count(5)->create([
            'user_id' => $user->id,
            'categorie' => $categories->first()->id,
        ]);

        // Appel de la route index
        $response = $this->get(route('index'));

        // Vérification que la vue contient les posts et les catégories
        $response->assertStatus(200);
        $response->assertViewHas('listePostes');
        $response->assertViewHas('listeCategories');
    }

    // Test pour la méthode show


    // Test pour la méthode create
    public function test_create_displays_create_post_form()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('create.post'));

        $response->assertStatus(200);
        $response->assertViewIs('create_post');
        $response->assertViewHas('listeCategories');
    }

    // Test pour la méthode store
    public function test_store_saves_new_post()
    {
        $user = User::factory()->create();
        $category = Categorie::factory()->create();

        $postData = [
            'titre' => 'New Post',
            'contenu' => 'Post content',
            'categorie' => $category->nom,
            'image' => UploadedFile::fake()->image('post.jpg')
        ];

        $response = $this->actingAs($user)->post(route('store.post'), $postData);

        $response->assertRedirect(route('index'));
        $this->assertDatabaseHas('posts', ['titre' => 'New Post']);
    }
}
