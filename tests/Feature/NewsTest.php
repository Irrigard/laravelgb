<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_categories_status()
    {
        $response = $this->get('/categories/');
        $response->assertStatus(200);
    }

    public function test_categories_output()
    {
        $response = $this->get('/categories/');
        $response->assertViewHas('categoriesList');
    }

    public function test_categoryNews_output()
    {
        $catId = rand(1, 5);
        $response = $this->get('/category/' . $catId);
        $response->assertViewHas('newsList');
    }

    public function test_categoryNews_status()
    {
        $catId = rand(1, 5);
        $response = $this->get('/category/' . $catId);
        $response->assertStatus(200);
    }

    public function test_newsItem_output()
    {
        $id = rand(1, 5);
        $catId = rand(1, 5);
        $response = $this->get('/news/' . $catId . '/' . $id);
        $response->assertViewHas('newsItemText');
    }

    public function test_newsItem_status()
    {
        $id = rand(1, 5);
        $catId = rand(1, 5);
        $response = $this->get('/news/' . $catId . '/' . $id);
        $response->assertStatus(200);
    }

    public function test_admin_categories_index_view_is()
    {
        $response = $this->get('/admin/categories/');
        $response->assertViewIs('admin.categories.index');
    }

    public function test_admin_categories_create_view_is()
    {
        $response = $this->get('/admin/categories/create');
        $response->assertViewIs('admin.categories.create');
    }

    public function test_admin_news_index_view_is()
    {
        $response = $this->get('/admin/news/');
        $response->assertViewIs('admin.news.index');
    }

    public function test_admin_news_create_view_is()
    {
        $response = $this->get('/admin/news/create');
        $response->assertViewIs('admin.news.create');
    }
}
