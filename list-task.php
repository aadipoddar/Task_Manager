<?php

    include('config/constants.php');

    //get the list id from url
    $list_id_url = $_GET['list_id'];

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

            <div class="all_tasks">

                <a class="btn-primary" href="<?php echo SITEURL;?>add-task.php">Add Task</a>

                <table class="tbl-full">

                    <tr>

                        <th>S.N.</th>
                        <th>Task Name</th>
                        <th>Priority</th>
                        <th>Deadline</th>
                        <th>Actions</th>

                    </tr>

                    <?php

                        $conn = mysqli_connect(LOCALHOST , DB_USERNAME , DB_PASSWORD)or die(mysqli_error());

                        $db_select = mysqli_select_db($conn ,DB_NAME) or die(mysqli_error());

                        //sql qerry to display task by list selected
                        $sql = "SELECT * FROM tbl_tasks WHERE list_id = $list_id_url";

                        //execute query
                        $res = mysqli_query($conn , $sql);

                        if ($res == true) 
                        {

                            //display task based on list
                            //count the rows    
                            $count_rows = mysqli_num_rows($res);

                            if ($count_rows > 0)
                            {

                                //we have tasks on this list
                                while ($row = mysqli_fetch_assoc($res))
                                {

                                    $task_id = $row['task_id'];
                                    $task_name = $row['task_name'];
                                    $priority = $row['priority'];
                                    $deadline = $row['deadline'];

                                    ?>

                                        <tr>
                                            
                                            <td> 1.</td>
                                            <td><?php echo $task_name; ?></td>
                                            <td><?php echo $priority; ?></td>
                                            <td><?php echo $deadline; ?></td>
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

                                //no tasks on this list
                                ?>

                                    <tr>

                                        <td colspan = "5"> No Tasks added on this list.</td>

                                    </tr>
                                <?php
                            }

                        }

                    ?>

                </table>

            </div>   

        </div>         

    </body>

</html>        