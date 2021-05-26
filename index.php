<?php

    include('config/constants.php');

?>




<html>

    <head>
        <title>Task Manager with php and mysql</title>
        <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css"/> 
    </head>

    <body>

        <div class="wrapper">
        
            <h1>TASK MANGER</h1>

            <!--MENU STARTS HERE-->

            <div class="menu">

                <a href="<?php echo SITEURL; ?>">Home</a>

                <?php

                    //displaying menu list from database in our menu
                    $conn2  = mysqli_connect(LOCALHOST , DB_USERNAME , DB_PASSWORD) or die(mysqli_error()); 

                    //select database
                    $db_select2 = mysqli_select_db($conn2 , DB_NAME) or die(mysqli_error());

                    //query to get list from database
                    $sql2 = "SELECT * FROM tbl_lists";

                    //execute query
                    $res2 = mysqli_query($conn2 ,$sql2);

                    //check whether the query execute or not
                    if($res2 == true)
                    {

                        //display the list in menu
                        while($row2 = mysqli_fetch_assoc($res2))
                        {

                            $list_id = $row2['list_id'];
                            $list_name = $row2['list_name'];
                            ?>  
                                
                                <a href="<?php echo SITEURL; ?>list-task.php?list_id = <?php echo $list_id; ?> "><?php echo $list_name; ?></a>

                            <?php

                        }

                    }

                ?>

                


                <a href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>

            </div>

            <!--MENU ENDS HERE-->


            <!--Tasks Starts HERE-->


            <p>

                <?php

                    //check whether the session is created or not
                    if(isset($_SESSION['add']))
                    {

                        //display session message
                        echo $_SESSION['add'];

                        //remove the message after displaying once
                        unset($_SESSION['add']);

                    }

                    if(isset($_SESSION['delete']))
                    {

                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);

                    }

                    if(isset($_SESSION['update']))
                    {

                        echo $_SESSION['update'];
                        unset($_SESSION['update']);

                    }

                    if(isset($_SESSION['delete_fail']))
                    {

                        echo $_SESSION['delete_fail'];
                        unset($_SESSION['delete_fail']);

                    }

                ?>

            </p>


            <div class="all_tasks">

                <a class = "btn-primary"href="<?php echo SITEURL;?>add-task.php">Add Task</a>




                <table class = "tbl-full">

                    <tr>

                        <th>S.N.</th>
                        <th>Task Name</th>
                        <th>Priority</th>
                        <th>Deadline</th>
                        <th>Actions</th>

                    </tr>

                    <?php

                        //connect data base
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                        //select database
                        $db_select = mysqli_select_db($conn , DB_NAME) or die(mysqli_error());

                        //get data from database
                        $sql = "SELECT * FROM tbl_tasks";

                        //execute querry
                        $res = mysqli_query($conn,$sql);

                        //check whether the query exerted or not
                        //check whether the queery executed successfully or not 
                        if($res == true)
                        {

                            //display the tasks from databse
                            //count the tasks on databse
                            $count_rows = mysqli_num_rows($res);

                            //create serial number variable 
                            $sn = 1;

                            //check whether their is task database or not
                            if($count_rows > 0)
                            {

                                //data in database
                                while($row = mysqli_fetch_array($res))
                                {

                                    $task_id = $row['task_id'];
                                    $task_name = $row['task_name'];
                                    $priority = $row['priority'];
                                    $deadline = $row['deadline'];

                                    ?>

                                        <tr>

                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $task_name; ?></td>
                                            <td><?php echo $priority; ?></td>
                                            <td><?php echo $deadline; ?><td>
                                            <td>
                                                <a href ="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a> 
                                                
                                                <a href ="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a> 
                                            </td>

                                        </tr>

                                    <?php

                                }


                            }

                            else
                            {

                                //no data in database
                                ?>

                                    <tr>

                                        <td colspan="5">

                                            No tasks added yet.

                                        </td>

                                    </tr>

                                <?php

                            }

                        }

                    ?>

                </table>

            </div>

            <!--TASKS ENDS HERE-->
        </div>

    </body>

</html>