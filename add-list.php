<?php

    include('config/constants.php');

?>



<html>

    <head>

        <title>

            Task Manager with PHP and MySql

        </title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css"/> 

    </head>

    <body>

        <div class="wrapper">

            <h1>

                TASK MANAGER

            </h1>

            <a class="btn-secondary"href = "<?php echo SITEURL; ?>" >Home</a>
            <a class="btn-secondary" href = "manage-list.php" >Manage List</a>

            <h3>

                Add List Page

            </h3>


            <p>

                <?php

                    //check whether the session is created or not
                    if(isset($_SESSION['add_fail']))
                    {

                        //display session message
                        echo $_SESSION['add_fail'];

                        //remove the message after displaying once
                        unset($_SESSION['add_fail']);

                    }
                ?>

            </p>

            <!-- FORM TO ADD LIST PAGE BEGINS HERE-->   

            <form method = "POST" action =""> 

                <table class = "tbl-half">

                    <tr>

                        <td>List Name:</td>
                        <td><input type = "text" name = "list_name" placeholder ="Type List Name Here" required = "required"/></td>

                    </tr>

                    <tr>

                        <td> 

                            List Description:

                        </td>

                        <td>

                            <textarea name = "list description" placeholder ="Type Description Here"></textarea>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            <input class = "btn-primary btn-lg" type ="submit" name = "submit" value ="SAVE"/>

                        </td>

                    </tr>

                </table>

            </form>
            <!-- FORM TO ADD LIST PAGE ENDS HERE-->   

        </div>


    </body>

</html>




<?php

    //Check whether the form is submitted or not

    if(isset($_POST['submit']))
    {
        //echo "Form Submitted";


        //get the values from form and save it in variables

        $list_name = $_POST['list_name'];

        $list_description = $_POST['list_description'];

        //connect database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //check whether the database connected or not
        /*
        if($conn == true)
        {

            echo "Database Connected";

        }
        */

        //select database
        $db_select = mysqli_select_db($conn , DB_NAME);


        //check whether database is connected or not
        /*
        if($db_select == true)
        {
            echo "Database Selected";
        }
        */


        //sql querry to insert data into database
        
        $sql = "INSERT INTO tbl_lists SET
            list_name = '$list_name',
            list_description = '$list_description'       
        ";
        

        //execute querry and insert into database
        $res = mysqli_query($conn, $sql);


        //check whether the queery executed successfully or not 
        if($res == true)
        {

            //data inserted successfully
            //echo "Data inserted successfully";

            //create a session variable to display message 
            $_SESSION['add'] = "List Added Successfully";

            //redirect to manage list page
            header('location:' .SITEURL.'manage-list.php');

        }

        else
        {

            //failed to insert data
            //echo "failed to insert data";

            //create a session variable to display message 
            $_SESSION['add_fail'] = "Failed to add list";

            //redirect to same page
            header('location:' .SITEURL.'add-list.php');

        }

    }

?>