<?php

$errors="";//hata mesajı degişkeni

$baglanti=new mysqli("localhost","root",/*sifre*/"","todo");


  
  if(isset($_POST['submit'])){
        $task=$_POST['task'];
if(empty($task)){
  $errors="görev boş geçme";
}
else{
 mysqli_query($baglanti,"INSERT INTO tasks(task) VALUES('$task')");
       header('location:ToDoList.php');
}


}
//silme 
   if(isset($_GET['del_task'])){
     $id=$_GET['del_task'];
     mysqli_query($baglanti,"DELETE FROM tasks WHERE id=$id");
     header('location:ToDoList.php');
   }
       
$tasks=mysqli_query($baglanti,"SELECT * FROM tasks");


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todolist</title>
    <link rel="stylesheet" href="ToDoList.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <header>ToDoList</header>
    <div class="container-fluid">
        <div class="row">
          <div id="fd" class="col-sm-3" style="background-color:yellow;">
            <div class="container-fluid">
                <form action="ToDoList.php" method="POST">
                    <?php if(isset($errors)){// boşluk kontrol ediyor?>
                        <p><?php echo $errors; ?></p>
                     <?php }  ?>
                <div class="col-xs-9">
                    <input type="text" name="task" class="form-control input-sm" id="inputSuccess ">
                </div>
                <div class="col-xs-3">
                    <button type="submit" name="submit" class="btn btn-success btn-sm">ekle</button>
                </div></form>
               
            </div>
          </div>    
          <div id="fd" class="col-sm-9" style="background-color:rgb(36, 194, 194);">
            <div  class="container-fluid" >
                <table class="table table-hover">
                    <thead>
                        <th>sirasi</th>    
                      <th>gorev</th> 
                      <th>aktif</th> 
                      </thead>
                      <tbody id="renk">
                      <?php $id=1; while($row=mysqli_fetch_array($tasks)) {?>
                       <tr>
                          <td><?php echo $id;?></td>
                          <td><?php echo $row['task'];?></td>
                          <td ><a href="ToDoList.php?del_task=<?php echo $row['id'];?>"class="btn btn-danger btn-sm">x</a></td>
                        </tr>
                      
                      <?php $id++; }?>
                       
                      </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
</body>

</html>