<?php

namespace Tests\Feature;

/**
 * Trait Feature
 * @author rivald 
 */
trait LoginTrait
{
    public function do_login()
    {
        $_SERVER['HTTP_CLIENT_IP'] = '127.0.0.1';
        $this->post('/do_login', [
            "username" => "admin",
            "password" => "default"
        ]);
    }
}
