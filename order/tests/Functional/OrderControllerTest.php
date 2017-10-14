<?php

class OrderControllerTest extends TestCase
{
    private $orders;

    public function setUp()
    {
        $this->orders = [
            "1" => ["user" => "1", "products" => ["1", "2"]],
            "2" => ["user" => "1", "products" => ["3"] ],
            "3" => ["user" => "2", "products" => ["1", "3"]],
        ];
        parent::setUp();
    }


    public function test_if_it_returns_all_orders()
    {
        $this->get('/order');

        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertEquals(json_encode($this->orders), $this->response->getContent());
    }

    public function test_if_it_returns_the_requested_order()
    {
        $order = 1;
        $this->get('/order/' . $order);

        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertEquals(json_encode($this->orders[$order]), $this->response->getContent());
    }

    public function test_if_it_returns_not_found_response_for_a_non_existed_order()
    {
        $order = 4;
        $this->get('/order/' . $order);

        $this->assertEquals(404, $this->response->getStatusCode());
    }

    public function test_if_it_returns_the_orders_by_user()
    {
        $user = 1;
        $this->get('/order/user/' . $user);

        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertCount(2, json_decode($this->response->getContent(), true));
        $this->assertEquals($user, json_decode($this->response->getContent(), true)[1]['user']);
        $this->assertEquals($user, json_decode($this->response->getContent(), true)[2]['user']);
    }

    public function test_if_it_returns_not_found_response_for_a_user_that_has_no_orders()
    {
        $user = 3;
        $this->get('/order/user/' . $user);

        $this->assertEquals(404, $this->response->getStatusCode());
    }
}
