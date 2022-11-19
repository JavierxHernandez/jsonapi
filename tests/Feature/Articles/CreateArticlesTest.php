<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CreateArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_create_articles()
    {
//        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'Nuevo articulo',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del articulo'
        ])->assertCreated();

        $article = Article::first();

        $response->assertHeader(
            'Location',
            route('api.v1.articles.show', $article)
        );

        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => 'Nuevo articulo',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del articulo'
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article)
                ]
            ]
        ]);
    }

    public function test_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->postJson(route('api.v1.articles.store'), [

                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del articulo'
        ])->assertJsonApiValidationErrors('title');

    }

    public function test_title_must_be_at_least_4_characters()
    {
        // $this->withoutExceptionHandling();

        $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'nue',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del articulo'
        ])->assertJsonApiValidationErrors('title');

    }

    public function test_slug_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->postJson(route('api.v1.articles.store'), [

                    'title' => 'Articulo Title',
                    'content' => 'Contenido del articulo'
        ])->assertJsonApiValidationErrors('slug');

    }

    public function test_content_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->postJson(route('api.v1.articles.store'), [
                    'title' => 'Articulo Title',
                    'slug' => 'nuevo-articulo'
        ])->assertJsonApiValidationErrors('content');

    }
}
