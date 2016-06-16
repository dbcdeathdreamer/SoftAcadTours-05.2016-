<?php

class HomeController extends Controller
{
    public function index()
    {
        $viewData = array();
        $this->loadFrontView('home.php', $viewData);
    }
}