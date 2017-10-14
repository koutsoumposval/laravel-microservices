<?php

class ProductControllerTest extends TestCase
{
    private $products;

    public function setUp()
    {
        $this->products = ["1" => "Product 1", "2" => "Product 2", "3" => "Product 3"];
        parent::setUp();
    }


    public function test_if_it_returns_all_products()
    {
        $this->get('/product');

        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertEquals(json_encode($this->products), $this->response->getContent());
    }

    public function test_if_it_returns_the_requested_product()
    {
        $product = 1;
        $this->get('/product/' . $product);

        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertEquals(json_encode($this->products[$product]), $this->response->getContent());
    }

    public function test_if_it_returns_not_found_response_for_a_non_existed_product()
    {
        $product = 4;
        $this->get('/product/' . $product);

        $this->assertEquals(404, $this->response->getStatusCode());
    }
}
