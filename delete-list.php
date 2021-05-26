<?php

    //include constants.php
    include('config/constants.php');


    //echo "Delete List Page";

    //check whether the list_id is offline or not  

    if(isset($_GET['list_id']))
    {

        //Delete the list from the database


        //get the list_id value from the url or get method
        $list_id = $_GET['list_id'];

        //connect the data base
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //select database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        //write the querry to delete data from database
        $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the querry executed successfully or not
        if($res == true)
        {

            //query executed successfully which means list is deleted successfully
            $_SESSION['delete'] = "List Deleted Successfully";

            //redirect to manage List Page
            header('location:'.SITEURL.'manage-list.php');
            
        }

        else
        {

            //failed to delete the list
            $_SESSION['delete_fail'] = "Failed to Delete List";

            //redirect to manage List Page
            header('location:'.SITEURL.'manage-list.php');

        }

    }

    else
    {

        //redirect to manage list page
        header('location:'.SITEURL.'manage-list.php');
    }

?>