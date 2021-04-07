
<?php

class PostsNew {

    public function indexMode()
    {
        echo 'PostsNew::index';
    }

    public function testMode()
    {
        echo 'PostsNew::test';
    }

    public function testPageMode()
    {
        echo 'PostsNew::testPage';
    }

    public function before()
    {
        echo 'PostsNew::before';
    }
}
