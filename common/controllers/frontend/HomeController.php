<?php

class HomeController extends Controller
{
    public function index()
    {
        $viewData = array();

        $blogCollection = new BlogCollection();
        $lastBlogPosts = $blogCollection->getLast3Posts();

        $toursCollection = new ToursCollection();
        $randomTours = $toursCollection->getRandomTours();
        
        $viewData['lastBlogPosts'] = $lastBlogPosts;
        $viewData['randomTours']   = $randomTours;

        $this->loadFrontView('home.php', $viewData);
    }
}