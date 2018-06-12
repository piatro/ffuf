<!DOCTYPE html>
<html>
<head>
	<?php $this->view('include/header'); ?>
</head>
<body>

    <?php
    	$this->view('include/navbar.php');
    ?>

    <!-- Begin page content -->
    <div class="container">
    	 

    	<div class='col-md-12'>

    		<div id='success'></div>
    		<div id='d_error'></div>

    		
    		<div class='panel panel-default'>
	    		<div class="panel-heading">
	    			<h4 style='display:inline-block;'>
	    				<strong style='color:#5d5d5dbd;'>
	    					<?php echo $title; ?>
	    				</strong>
	    			</h4>

	    			<button data-toggle='modal' data-target='#add_modal' style='display:inline-block;float:right;' class='btn btn-success'>Add Book</button>
	    		</div>

	    		<div class="panel-body">
			    	<table id='myTable' class='table table-striped'>
			    		<thead>

			    			<tr>
				    			<th width='25%'>Title</th>
				    			<th width='20%'>Author</th>
				    			<th width='15%'>Genre</th>
				    			<th width='20%'>Library Section</th>
				    			<th style='text-align:center;' width='20%'>Action</th>
			    			</tr>
			    		</thead>
			    		<tbody>
				    	<?php

				    		foreach($book_list as $bl) {
				    			echo "<tr>
				    				<td>".$bl->title."</td>
				    				<td>".$bl->author."</td>
				    				<td>".$bl->genre."</td>
				    				<td>".$bl->library_section."</td>
				    				<td>
				    				<button data-toggle='modal' data-target='#update_modal' id='edit' class='btn btn-sm btn-info' value='".$bl->id."'>Edit</button>
				    				<button data-toggle='modal' data-target='#delete_modal' class='btn btn-sm btn-danger' id='delete_with_modal' value='".$bl->id."'>Delete</button>
				    				

				    				<button data-toggle='modal' data-target='#return_modal' ".(($bl->status == 1 )?"":"disabled")." id='return_with_modal' class='btn btn-sm btn-warning' value='".$bl->id."'>Return</button>

				    				</td>
				    				</tr>";
				    		}

				    	?>
				    	</tbody>
				    	
			    	</table>
			    </div>
		    </div>
    	</div>
    </div>


    <!-- Modal -->
	<div class="modal fade" id="add_modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	    <div class="modal-content">


	      	<div class="modal-header">
	        	<button type="button" id='close' class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Add Book</h4>
	        </div>

	        <div id='error'></div>

	        <form id='add_form' method='post'>
		        <div class="modal-body">
		          
		        	<div class="form-group row">
			        	<label style='padding:5px;text-align:right;color:#555;' class="col-sm-3">Title</label>
			        	
			        	<div class="col-sm-9">
			        	
			        		<input id="title" type="text" class="form-control" name="title" required autofocus>
			        	</div>
			        </div>

			        <div class="form-group row">
			        	<label style='padding:5px;text-align:right;color:#555;' class="col-sm-3">Author</label>
			        	
			        	<div class="col-sm-9">
			        	
			        		<input id="author" type="text" class="form-control" name="author" required >
			        	</div>
			        </div>

			        <div class="form-group row">
			        	<label style='padding:5px;text-align:right;color:#555;' class="col-sm-3">Genre</label>
			        	
			        	<div class="col-sm-9">
			        	
			        		<select class='form-control' id='genre' name='genre' required>
			        			<option value=''>-- Select --</option>
			        			<?php
			        				foreach($genre as $g) {
			        					echo "<option value='".$g->id."'>".$g->genre."</option>";
			        				}
			        			?>
			        		</select>
			        	</div>
			        </div>

			        <div class="form-group row">
			        	<label style='padding:5px;text-align:right;color:#555;' class="col-sm-3">Library Section</label>
			        	
			        	<div class="col-sm-9">
			        		<select class='form-control' id='library_section' name='library_section' required>
			        			<option value=''>-- Select --</option>
			        			<?php
			        				foreach($library_section as $ls) {
			        					echo "<option value='".$ls->id."'>".$ls->library_section."</option>";
			        				}
			        			?>
			        		</select>
			        	</div>
			        </div>

		        </div>
		        <div class="modal-footer">
		        	<button type="button" id='submit' class='btn btn-primary'>Submit</button>
		        	<!--
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		       		 -->
		        </div>
		    </form>
	    </div>
	      
	    </div>
	</div>

	<div class="modal fade" id="update_modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
		    <div class="modal-content">


		      	<div class="modal-header">
		        	<button type="button" id='close_update_modal' class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Update Book</h4>
		        </div>



		        <form id='update_form' method='post'>
			        <div class="modal-body">
			          	
			          	<input type='hidden' id='id' name='id'>

			        	<div class="form-group row">
				        	<label style='padding:5px;text-align:right;color:#555;' class="col-sm-3">Title</label>
				        	
				        	<div class="col-sm-9">
				        	
				        		<input id="edit_title" type="text" class="form-control" name="edit_title" required autofocus>
				        	</div>
				        </div>

				        <div class="form-group row">
				        	<label style='padding:5px;text-align:right;color:#555;' class="col-sm-3">Author</label>
				        	
				        	<div class="col-sm-9">
				        	
				        		<input id="edit_author" type="text" class="form-control" name="edit_author" required>
				        	</div>
				        </div>

				        <div class="form-group row">
				        	<label style='padding:5px;text-align:right;color:#555;' class="col-sm-3">Genre</label>
				        	
				        	<div class="col-sm-9">
				        	
				        		<select class='form-control' id='edit_genre' name='edit_genre' required>
				        			<option value=''>-- Select --</option>
				        			<?php
				        				foreach($genre as $g) {
				        					echo "<option value='".$g->id."'>".$g->genre."</option>";
				        				}
				        			?>
				        		</select>
				        	</div>
				        </div>

				        <div class="form-group row">
				        	<label style='padding:5px;text-align:right;color:#555;' class="col-sm-3">Library Section</label>
				        	
				        	<div class="col-sm-9">
				        		<select class='form-control' id='edit_library_section' name='edit_library_section' required>
				        			<option value=''>-- Select --</option>
				        			<?php
				        				foreach($library_section as $ls) {
				        					echo "<option value='".$ls->id."'>".$ls->library_section."</option>";
				        				}
				        			?>
				        		</select>
				        	</div>
				        </div>

			        </div>
			        <div class="modal-footer">
			        	<button type="button" id='update_book' class='btn btn-primary'>Update</button>
			        </div>
			    </form>

		    </div>
		</div>
   	</div>

   	<div class="modal fade" id="delete_modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
		    <div class="modal-content">


		      	<div class="modal-header">
		        	<button type="button" id='close_delete_modal' class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Delete Book</h4>
		        </div>



		        <form id='' method='post'>
			        <div class="modal-body">
			          	
			          	<input type='hidden' id='delete_id' name='id'>
			          	<input type='hidden' id='delete_title'>
			        	<div id='warning-msge'></div>

			        </div>
			        <div class="modal-footer">
			        	<button type="button" id='delete' class='btn btn-danger'>Delete</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			    </form>

		    </div>
		</div>
   	</div>

   	<div class="modal fade" id="return_modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
		    <div class="modal-content">


		      	<div class="modal-header">
		        	<button type="button" id='close_return_modal' class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Return Book</h4>
		        </div>



		        <form id='' method='post'>
			        <div class="modal-body">
			          	
			          	<input type='hidden' id='book_id'>
			          	<input type='hidden' id='book_title'>
			        	<div id='return-warning-msge'></div>

			        </div>
			        <div class="modal-footer">
			        	<button type="button" id='return' class='btn btn-primary'>Return</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			    </form>

		    </div>
		</div>
   	</div>

   	<script src='<?php echo base_url(); ?>asset/js/crud.js'></script>
	<?php $this->view('include/footer'); ?>

   

  </body>
</html>