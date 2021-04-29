<?php

require_once "../library/vendor/autoload.php";

$Comments = new \App\Model\Comments();

$commentsData = $Comments->commentsByDate();


foreach ($commentsData as $row => $item)
{
    foreach ($item as $key => $value)
    {
        if ($key == "created_at")
        {
            $item[$key] = date_format(date_create($value), 'F');
        }
    }
    $commentsData[$row] = $item;
}

print_r(json_encode($commentsData));
