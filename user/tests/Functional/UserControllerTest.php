<?php

class UserControllerTest extends TestCase
{
    private $users;

    public function setUp()
    {
        $this->users = ["1" => "User 1", "2" => "User 2", "3" => "User 3"];
        parent::setUp();
    }


    public function test_if_it_returns_all_users()
    {
        $this->get('/user');

        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertEquals(json_encode($this->users), $this->response->getContent());
    }

    public function test_if_it_returns_the_requested_user()
    {
        $userId = 1;
        $this->get('/user/' . $userId);

        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertEquals(json_encode($this->users[$userId]), $this->response->getContent());
    }

    public function test_if_it_returns_not_found_response_for_a_non_existed_user()
    {
        $userId = 4;
        $this->get('/user/' . $userId);

        $this->assertEquals(404, $this->response->getStatusCode());
    }
}
