<?php
require_once "../library/vendor/autoload.php";

$Category = new \Category();
$Posts = new \Posts();

$data = $Category->postsInCategory();

$posts_number = $Posts->countPosts();
foreach ($data as $row => $item)
{
    foreach ($item as $key => $value)
    {
        if ($key == "name")
        {
            $item[$key] = ucfirst($item[$key]);
        }
        if ($key == "posts_count")
        {
            $item[$key] = $item[$key]/$posts_number*100 ;
        }
    }

    $data[$row] = $item;

}

print json_encode($data);
