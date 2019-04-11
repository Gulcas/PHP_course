<!DOCTYPE>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <meta name="GuestBook" content="Form"/>
        <title>Guest Book</title>
        <style>
            divH1 {
                text-align: center
            }
        </style>
    </head>
    <body>
    <divh1><h1>Guest Book</h1></divh1>
        <form  method="POST" action="guestbook.php">
            <table border="0" width="100%">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="Title"/></td>
                </tr>
                <tr>
                    <td>Author</td>
                    <td><input type="text" name="Author"/></td>
                </tr>
                <tr>
                    <td>Your post</td>
                    <td><textarea name="YourPost" rows="10" cols="60"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Add"/></td>
                </tr>
            </table>
        </form>
    <?php
    require ('./guestbook_data.php');
   
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(addPost($_POST['Title'], $_POST['Author'], $_POST['YourPost'])){
            echo "<h1>Your post has been added successfuly!</h1>";
        } 
        else 
            {
            echo "<h1>Fill all the fields in form.</h1>";
        } 
        echo '<p><a href="guestbook.php">Back to the Guest Book</a></p>';
    } 
    else {
        $allPosts = getPosts();
        foreach($allPosts as $post){
            echo '<hr/><p><b>Title: <i>'.$post['Title'].'</i>;
                            Author: '.$post['Author'].'; Date: '.$post['Date'];
                    echo '</b></p>';
                    echo '<p>'.$post['YourPost'].'</p>';
        }
    }
    ?>
    </body>
</html>