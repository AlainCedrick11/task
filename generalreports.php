<?php include 'db_connect.php' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <b>Projects and Progress</b>
            <div class="card-tools">
             
            </div>
          </div>
    <div id="layoutSidenav_content">
                <main>
      <div class="card-body">
                                <table id="datatablesSimple" class="table table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                    <th>Project</th>
                                    <th>Task</th>
                                    <th>Activity Summary</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Staffs</th>
                                    <th>Date Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
function getprojectname($conn,$projectid){
$sql=mysqli_query($conn,"select * from project_list WHERE id ='$projectid'");
while($row=mysqli_fetch_array($sql)){
    $name=$row['name'];
}
return $name;
} 
//gettaskname
function gettaskname($conn,$taskid){
$sql=mysqli_query($conn,"select * from task_list WHERE id ='$taskid'");
while($row=mysqli_fetch_array($sql)){
    $task=$row['task'];
}
return $task;
}
//get users name
 function getusername($conn,$userid){
$sql=mysqli_query($conn,"select * from users WHERE id ='$userid'");
while($row=mysqli_fetch_array($sql)){
    $firstname=$row['firstname'];
}
return $firstname;
}

$sql=mysqli_query($conn,"SELECT * from user_productivity ORDER BY (id  ) DESC");
while($row=mysqli_fetch_array($sql))
{

 echo "<tr>
    <td>".getprojectname($conn,$row['project_id'])."</td>
    <td>".gettaskname($conn,$row['task_id'])."</td>
    <td>".$row['comment']."</td>
     <td>".$row['subject']."</td>
    <td>".$row['date']."</td>
    <td>".$row['start_time']."</td>
    <td>".$row['end_time']."</td>
    <td>".getusername($conn,$row['user_id'])."</td>
    <td>".$row['date_created']."</td>
    </tr>";
  
}
?>
</tbody>
</table>
</div>
</div>
</div>
</main>
</div>
</div>
</div>
<script>
  $('#print').click(function(){
    start_load()
    var _h = $('head').clone()
    var _p = $('#printable').clone()
    var _d = "<p class='text-center'><b>Project Progress Report as of (<?php echo date("F d, Y") ?>)</b></p>"
    _p.prepend(_d)
    _p.prepend(_h)
    var nw = window.open("","","width=900,height=600")
    nw.document.write(_p.html())
    nw.document.close()
    nw.print()
    setTimeout(function(){
      nw.close()
      end_load()
    },750)
  })
</script>

<script type="">
  $(document).ready(function() {
    $('#datatablesSimple').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
  
</script>



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
</body>
</html>