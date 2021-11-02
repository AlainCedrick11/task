<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM task_list where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-task">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name="project_id" value="<?php echo isset($_GET['pid']) ? $_GET['pid'] : '' ?>">
		<div class="form-group">
	<label for="">Task Name</label>
	<input type="text" class="form-control form-control-sm" placeholder="Task Name" name="task" value="<?php echo isset($task) ? $task : '' ?>">
		</div>

		<!---<div class="form-group">
	<label for="">File Name</label>
	<input type="file" class="form-control form-control-sm" placeholder="File Name" name="filename" value="<?php echo isset($filename) ? $filename : '' ?>">
   </div>--->

		
		<div class="form-group">
			<label for="">Description</label>
			<textarea name="description" id="" cols="30" rows="10" class="summernote form-control" placeholder="Description" required="">
				<?php echo isset($description) ? $description : '' ?>
			</textarea>
		</div>
		 
		<div class="form-group">
			<label for="">Status</label>
			<select name="status" id="status" class="custom-select custom-select-sm" required="">
			<option value="">Please Select</option>
			<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Opened</option>
			<option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Progressing</option>
			<option value="4" <?php echo isset($status) && $status == 4 ? 'selected' : '' ?>>On-Hold</option>
			<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>Completed</option>
				
			</select>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
   $('.summernote').summernote({
        height: 200,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    })
     })
    
    $('#manage-task').submit(function(e){
    	e.preventDefault()
    	start_load()
    	$.ajax({
    		url:'ajax.php?action=save_task',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
    	})
    })
</script>