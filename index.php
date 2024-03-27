<?php
    include "conn.php";
    $obj=new con();
    $s_d =0;
    if(isset($_POST["search"])){
       
        $res = $obj->search($_POST["s_tb"]);
        
        if($res->num_rows>0){
            $dt =$res->fetch_array();
            $s_d = 1;
        }else{
            echo "<script>
            alert('Title not Found,Create New');
            window.location = '';
        </script>";
        }
        

    }else{
        // echo "not search";
    }
    if(isset($_POST["create"])){
        if($_POST["c_n"]==''){
            echo "<script>
            alert('Title Do Not Blank.');
            window.location = '';
        </script>";
        }else{
        $res = $obj->search($_POST["c_n"]);
        if($res->num_rows>0){
            echo "<script>
            alert('Title Already Exist');
            window.location = '';
        </script>";
        }
         else{
                $s= htmlspecialchars($_POST["data_save"]);
                    $r_i=$obj->inst($_POST["c_n"],$s);
                    if($r_i>0){
                        echo "<script>
                        alert('Note Created');
                        window.location = '';
                    </script>";
                    } 
            }
        }
        
    }
    if(isset($_POST["del"])){
        $r_d=$obj ->del($_POST["s_tb"]);
        if($r_d>0){
            echo "<script>
            alert('Note Deleted');
            window.location = '';
        </script>";
        }
    }
    if(isset($_POST["save"])){
            $s_up= htmlspecialchars($_POST["data_save_up"]);
            $r_up=$obj->up($_POST["s_tb"],$s_up);
            if($r_up>0){
                echo "<script>
                alert('Note Saved');
                window.location = '';
            </script>";
            }
        
        

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>note</title>
</head>
<body>
    <nav class="navbar navbar-light bg-dark justify-content-between">
        <a class="navbar-brand" style="color: aliceblue;" href="">Note Saver</a>
        <form action="" class="form-inline" method="post">
        <?php 
        if($s_d){?>
        <input type="text" name="s_tb" placeholder="Search" value="<?=$dt[1];?>" class="form-control mr-sm-2">
            <?php } else{?>
        <input type="text" name="s_tb" placeholder="Search" class="form-control mr-sm-2">
        <?php }?>  
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="search">Search</button>
        <!-- </form> -->
    </nav>
    <br>
    <center>
                <!-- <form style="height: 50em;" method="post"><br> -->
            <div class="input-group" style="width: 80%;">
                <!-- <span class="input-group-text" id="basic-addon1">Title:</span> -->
                <input type="text" class="form-control" name="c_n" placeholder="Note Title" aria-describedby="basic-addon1">

                <?php if($s_d){?>   
                 <button type="submit" class="btn btn-danger" id="dele" name="del">Delete</button>
                 <?php }?>
                </div><br>
                
                <?php if(!$s_d){?>   
                <button class="btn btn-outline-primary my-2 my-sm-0" name="create" type="submit">Create</button>
            <?php }?>
            
            <?php
        if($s_d){
        ?>
    <button class="btn btn-outline-primary my-2 my-sm-0" name="save" type="submit">Update</button>
    <br>
    <div style="height: 50em;">
    <textarea name="data_save_up" style="height: 70%; width: 90%;margin-top: 2%; margin-left: 3%;"><?=$dt[2];?></textarea>
    <?php }else{
        ?>
        <br>
        <div style="height: 50em;">
        <textarea name="data_save" style="height: 70%; width: 90%;margin-top: 2%; margin-left: 3%;" placeholder="Paste Your Notes Here..."></textarea>
        <?php }?>
    </div>
        </form>
        


</center>
        </from>
</body>

</html>