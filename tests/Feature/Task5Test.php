<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class Task5Test extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    protected array $modelFields = [
        "text",
        "short_text",
        "author_name"
    ];
    protected string $modelClass = Article::class;
    protected string $modelPluralName = "articles";
    protected string $modelSingleName = "article";

    /* Checks model creating */
    public function testCreate()
    {
        $routeName = $this->modelPluralName . ".create";
        $response = $this->get(route($routeName));
        $response->assertViewIs($routeName);
        $response->assertSee($this->modelPluralName . " form");
    }

    /* Checks model saving */
    public function testStoreOk()
    {
        $data = $this->modelClass::factory()->make()->toArray();
        $routeName = $this->modelPluralName . ".store";
        $redirectRouteName = $this->modelPluralName . ".show";
        $response = $this->post(route($routeName), $data);
        $response->assertRedirect(route($redirectRouteName, [$this->modelSingleName => 1]));
    }

    /* Checks saving validation */
    public function testStoreError()
    {
        $routeName = $this->modelPluralName . ".store";
        $response = $this->post(route($routeName), []);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors($this->modelFields);
    }

    /* Checks json model showing */
    public function testShow()
    {
        $model = $this->modelClass::factory()->createOne();
        $routeName = $this->modelPluralName . ".show";
        $response = $this->getJson(route($routeName, [$this->modelSingleName => $model->id]));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data' => $this->modelFields]);
    }

    /* Checks json model showing error */
    public function testShowError()
    {
        $routeName = $this->modelPluralName . ".show";
        $response = $this->getJson(route($routeName, [$this->modelSingleName => 1]));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(['message' => "Not found"]);
    }
}
