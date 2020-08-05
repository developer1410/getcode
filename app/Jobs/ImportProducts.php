<?php

namespace App\Jobs;

use Goutte\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $resource = null;

    public $tries = 5;

    /**
     * Create a new job instance.
     * @param string $resource
     * @return void
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Handle page parse event
     */
    public function handle()
    {
        // Parse product from HTML
        $products = $this->parseUrl($this->resource);

        // Save to database
        $this->importToDatabase($products);
    }

    /**
     * Import data to database. Move to repositories
     * @param $products
     */
    public function importToDatabase($products) {
        foreach ($products as $product) {
            DB::table('products')->updateOrInsert([
                'id' => $product['id']
            ], [
                'name' => $product['name'],
                'url' => $product['url'],
                'brand' => $product['brand'],
                'category_id' => $product['category_id'],
                'images' => implode('|||', $product['images'])
            ]);
        }
    }

    /**
     * Move to services
     * @param $resource_url
     * @return array
     */
    private function parseUrl($resource_url) {
        // Parse products
        $client = new \Goutte\Client();
        $crawler = $client->request('GET', $resource_url);

        $products_urls = [];
        // Get all products urls
        $crawler->filter('.listing__body-wrap .card__body > .card__title')->each(function($node) use(&$products_urls) {
            $products_urls[] = [
                'url' => $node->attr('href')
            ];
        });

        $categories = [];
        $crawler->filter('.catalog__category .catalog__category-item')->each(function($category) use(&$categories) {
            if(!empty($category_id = $category->attr('data-category'))) {
                $categories[] = [
                    'id' => $category_id
                ];
            }
        });

        if(count($products_urls) == 0) {
            $products = [$this->parseProductPage($client, $resource_url)];
        } else {
            $products = [];
            foreach ($products_urls as &$product) { // Get data from product page
                $products[] = $this->parseProductPage($client, $product['url']);
            }
        }
        return $products;
    }

    /**
     * Move to services
     * @param $client Client
     * @param $url
     * @return array
     */
    private function parseProductPage($client, $url) {
        $crawler_product = $client->request('GET', $url);
        $product = ['url' => $url];
        $crawler_product->filter('.product-img__list img')->each(function($img) use(&$product) {
            $product['images'][] = $img->attr('data-src');
        });
        $crawler_product->filter('.product-box__content')->each(function ($content) use(&$product){
            $product = array_merge($product, [
                'id' => $content->attr('data-gid'),
                'name' => $content->attr('data-title'),
                'brand' => $content->attr('data-brand'),
                'category_id' => $content->attr('data-product-category-id')
            ]);
        });
        return $product;
    }
}
