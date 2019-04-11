<?php

define('allPosts', './allposts.txt');

/**
 * Function that take user post and save it to a file
 */

function addPost($Title, $Author, $YourPost) {
    $Title = trim($Title);
    $Author = trim($Author);
    $YourPost = trim($YourPost);
    
    if(strlen($Title) < 3){
        return FALSE;
    }
    if(strlen($Author) < 3){
        return FALSE;
    }
    if(strlen($YourPost) < 5){
        return FALSE;
    }
    
    
    $openPosts = fopen(allPosts, 'a'); //wczytanie pliku w trybie dopisywania
    
    $data = array(0 => 
        base64_encode(htmlspecialchars($Title)),
        base64_encode(htmlspecialchars($Author)),
        time(),
        base64_encode(nl2br(htmlspecialchars($YourPost)))
        );
        fwrite($openPosts, implode('|', $data)."\r\n");
        fclose($openPosts);
        return TRUE;
}

/**
 * Function that opens a file with posts, and get newest post on the top
 */
function getPosts(){
    $posts = array_reverse(file(allPosts));
    $i = 1;
    $rezult = array();
    
    foreach ($posts as $post){
        $post = explode("|", trim($post));
        $rezult[] = array(
                'Id' => $i,
                'Title' => base64_decode($post[0]),
                'Author' => base64_decode($post[1]),
                'Date' => date('d.m.Y, H:i', $post[2]),
                'YourPost' => base64_decode($post[3])
            ); 
        $i++;
    } return $rezult;
} 