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

            <h3>

                Add Task Page

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

                        <td>

                            Task Name:

                        </td>

                        <td>

                            <input type = "text" name = "task_name" placeholder ="Type your Task Here" required = "required"/>

                        </td>

                    </tr>

                    <tr>

                        <td> 

                            Task Description:

                        </td>

                        <td>

                            <textarea name = "task description" placeholder ="Type Task Description Here"></textarea>

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Select List:
                            
                        </td>
                        

                        <td>

                            <select name = "list_id">

                            <?php

                                //connect database
                                $conn = mysqli_connect(LOCALHOST , DB_USERNAME , DB_PASSWORD) or die(mysqli_error());

                                //select database
                                $db_select = mysqli_select_db($conn , DB_NAME) or die (mysqli_error());

                                //sql query to get the list from table
                                $sql = "SELECT * FROM tbl_lists";

                                //execute query
                                $res = mysqli_query($conn , $sql);

                                //check whether sql qery executed successfully or not
                                if($res == true)
                                {

                                    //create variable to count rows
                                    $count_rows = mysqli_num_rows($res);

                                    //if there is data in database display them in drop down else display none as option
                                    if($count_rows > 0)
                                    {

                                        //display all lists on dopr down from database
                                        while($row = mysqli_fetch_assoc($res))
                                        {

                                            $list_id = $row['list_id'];

                                            $list_name = $row['list_name'];

                                            ?>


                                                <option 

                                                    value = "<?php echo $list_id ?>"><?php echo $list_name; ?>

                                                </option>


                                            <?php
                                        }

                                    }

                                    else
                                    {

                                        //display none as option

                                        ?>

                                            <option 

                                                value = "0">NONE

                                            </option>

                                        <?php 

                                    }

                                }
                            
                            ?>
                                
                                

                            </select>    

                        </td>

                    </tr>

                    <tr>

                        <td>

                            Priority:

                        </td>

                        <td>

                            <select name = "priority">
                                    
                                    <option 

                                        value = "High">High

                                    </option>

                                    <option 

                                        value = "Medium">Medium

                                    </option>

                                    <option 

                                        value = "Low">Low

                                    </option>

                            </select>

                        </td>

                    </tr>


                    <tr>

                        <td>

                            Deadline:

                        </td>

                        <td>

                            <input type = "date" name = "deadline"/>

                        </td>

                    </tr>


                    <tr>

                        <td>

                            <input class = "btn-primary btn-lg" type = "submit" name = "submit" value = "SAVE"/>

                        </td>

                    </tr>




                </table>

            </form>
            <!-- FORM TO ADD LIST PAGE ENDS HERE-->   

        </div>

    </body>

</html>    




<?php

    //Check whether the save button is clicked or not

    if(isset($_POST['submit']))
    {   

        //echo "Button Clicked";

        //get the values from form and save it in variables

        $task_name = $_POST['task_name'];

        $task_description = $_POST['task_description'];

        $list_id = $_POST['list_id'];

        $priority = $_POST['priority'];

        $deadline = $_POST['deadline'];


        //connect database
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());


        //select database
        $db_select2 = mysqli_select_db($conn2 , DB_NAME) or die(mysqli_error());


        //sql querry to insert data into database
        
        $sql2 = "INSERT INTO tbl_tasks SET
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline'       
        ";


        //execute querry and insert into database
        $res2 = mysqli_query($conn2, $sql2);


        //check whether the queery executed successfully or not 
        if($res2 == true)
        {

            //data inserted successfully
            //echo "Task inserted successfully";

            //create a session variable to display message 
            $_SESSION['add'] = "Task Added Successfully";

            //redirect to manage home page
            //header('location:' .SITEURL);

        }

        else
        {

            //failed to insert data
            //echo "failed to insert task";

            //failed to add task
            $_SESSION['add_fail'] = "Failed to add task";

            //redirect to same page
            header('location:' .SITEURL.'add-task.php');

        }


    }

?>
