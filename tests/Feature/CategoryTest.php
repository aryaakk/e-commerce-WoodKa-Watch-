<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_see_all_category()
    {
        $cate = Category::factory()->count(6)->create();
        $cates = $cate->first();
        // dd($cate);
        $response = $this->actingAs($this->user)->get(route('category.index'));

        $response->assertStatus(200);
    }

    public function test_can_see_add_category()
    {
        $response = $this->actingAs($this->user)->get(route('category.create'));

        $response->assertStatus(200);
    }

    public function test_can_add_category()
    {
        $input = Category::factory()->make();

        $response = $this->actingAs($this->user)->post(route('category.store'), $input->toArray());
        $response->assertRedirectToRoute('category.index');

        $this->assertDatabaseHas('tbl_categories', [
            'name' => $input['name'],
        ]);
    }

    public function test_can_not_add_category()
    {
        $input = Category::factory()->make()->only('name');
        $input['name'] = "";

        $response = $this->actingAs($this->user)->post(route('category.store'), $input);

        $response->assertStatus(302)
            ->assertSessionHasErrors('name', 'The name field is required.')
            ->assertSessionHasErrors('description', 'The description field is required.');
    }

    public function test_can_see_edit_category()
    {
        $cate = Category::factory()->create();
        $response = $this->actingAs($this->user)->get(route('category.edit', $cate->id));
        $response->assertStatus(200);
    }

    public function test_can_edit_category()
    {
        $update = Category::factory()->create();
        $update->name = 'New Name';
        $response = $this->actingAs($this->user)->put(route('category.update', $update->id), $update->toArray());

        $response->assertStatus(302)
            ->assertRedirectToRoute('category.index');
    }

    public function test_can_not_edit_category()
    {
        $update = Category::factory()->create();
        $update->name = '';
        $response = $this->actingAs($this->user)->put(route('category.update', $update->id), $update->toArray());
        // dd($response->status());

        $response->assertStatus(302)
            ->assertSessionHasErrors('name', 'The name field is required.');
    }

    public function test_can_delete_category()
    {
        $cate = Category::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('category.destroy', $cate->id));

        $response->assertStatus(302)
            ->assertRedirectToRoute('category.index');
    }
}
