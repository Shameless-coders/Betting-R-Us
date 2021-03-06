<?php
namespace BettingRUs\Models;

class Blog{

    //Gets all blogs from db
    public function getAllBlogs($db) {
        $sql = "SELECT * FROM blogs";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();

        $blogs = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
        return $blogs;
    }

    // Finds a blog by an id
    public function getBlogWithId($id, $db){
        $sql = "SELECT * FROM blogs where id = :id";

        $pdostm = $db->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();

        $blogs = $pdostm->fetch(\PDO::FETCH_OBJ);
        return $blogs;
    }

    // Adds new blog into db
    public function addBlog($date, $author_fname, $author_lname, $post, $title, $imagefile, $db){
        $sql = "INSERT INTO blogs(date, author_fname, author_lname, post, title, imagefile) values (:date, :author_fname, :author_lname, :post, :title, :imagefile)";
        $pdostm = $db->prepare($sql);
        $pdostm->bindParam(':date', $date);
        $pdostm->bindParam(':author_fname', $author_fname);
        $pdostm->bindParam(':author_lname', $author_lname);
        $pdostm->bindParam(':post', $post);
        $pdostm->bindParam(':title', $title);
        $pdostm->bindParam(':imagefile', $imagefile);

        $count = $pdostm->execute();
        return $count;
    }

    //Updates already exiting blog
    public function updateBlog($id, $date, $author_fname, $author_lname, $post, $title, $imagefile, $db){
        $sql = "UPDATE blogs SET 
                date = :date,
                author_fname = :author_fname,
                author_lname = :author_lname,
                post = :post,
                title = :title,
                imagefile = :imagefile
                WHERE id = :id";

        $pdostm = $db->prepare($sql);
        $pdostm->bindParam(':date', $date);
        $pdostm->bindParam(':author_fname', $author_fname);
        $pdostm->bindParam(':author_lname', $author_lname);
        $pdostm->bindParam(':post', $post);
        $pdostm->bindParam(':title', $title);
        $pdostm->bindParam(':imagefile', $imagefile);
        $pdostm->bindParam(':id', $id);

        $count = $pdostm->execute();
        return $count;
    }

    //Delete a blog from the db
    public function deleteBlog($id, $db){
        $sql = "DELETE FROM blogs WHERE id= :id";

        $pdostm = $db->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $count = $pdostm->execute();
        return $count;
    }



}