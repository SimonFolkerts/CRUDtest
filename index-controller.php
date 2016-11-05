<?php

final class Index {
    
    //constants
    const PAGE_DIRECTORY = 'page/';
    const LAYOUT_DIRECTORY = 'layout/';

    //start session
    public function init() {
        session_start();
    }

    //if there is a page key in the GET, set the $page variable to the key in the GET.
    private function getPage() {
        if (array_key_exists('page', $_GET)) {
            $page = $_GET['page'];
        }
        else {
            return 'home';
        }
    }

    private function assemblePage($page) {
        $view = $this->getView($page);
        require $this->getController($page);
        require self::LAYOUT_DIRECTORY . 'index-view.php';
    }
    
    public function run() {
        $this->assemblePage($this->getPage());
    }
    
    
    //MVC assemblers will return the correct page components.
    private function getView($page) {
        return self::PAGE_DIRECTORY . $page . '-view.php';
    }

    private function getController($page) {
        return self::PAGE_DIRECTORY . $page . '-controller.php';
    }
}
 $index = new Index();
 $index->init();
 $index->run();
?>