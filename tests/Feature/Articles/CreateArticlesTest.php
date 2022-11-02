<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_create_articles()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Nuevo articulo',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del articulo'
                ]
            ]
        ]);

        $response->assertCreated();

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

        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'as',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del articulo'
                ]
            ]
        ])->dump();

        $response->assertJsonStructure([
            "errors" => [
                ['title', 'detail', 'source' => ['pointer']]
            ]
        ])->assertJsonFragment([
            'source' => ['pointer' => '/data/attributes/title']
        ])->assertHeader(
            'content-type', 'application/vnd.api+json'
        )->assertStatus(422);

//        $response->assertJsonValidationErrors('data.attributes.title');

    }

    public function test_title_must_be_at_least_4_characters()
    {
        // $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'nue',
                    'slug' => 'nuevo-articulo',
                    'content' => 'Contenido del articulo'
                ]
            ]
        ])->dump();

        $response->assertJsonValidationErrors('data.attributes.title');

    }

    public function test_slug_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Articulo Title',
                    'content' => 'Contenido del articulo'
                ]
            ]
        ]);

        $response->assertJsonValidationErrors('data.attributes.slug');

    }

    public function test_content_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.create'), [
            'data' => [
                'type' => 'articles',
                'attributes' => [
                    'title' => 'Articulo Title',
                    'slug' => 'nuevo-articulo'
                ]
            ]
        ]);

        $response->assertJsonValidationErrors('data.attributes.content');

    }
}
