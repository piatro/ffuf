<!DOCTYPE html>
<html>
<head>
	<?php $this->view('include/header'); ?>
	
</head>
<body>

    <?php
    	$this->view('include/navbar');
    ?>

    <!-- Begin page content -->
    <div class="container">

    	<div class='col-md-12'>
    		<div id='success'></div>
    		<div id='b_error'></div>

    		<div class='panel panel-default'>
	    		<div class="panel-heading">
	    			<h4>
	    				<strong style='color:#5d5d5dbd;'>
	    					<?php echo $title; ?>
	    				</strong>
	    			</h4>
	    		</div>

	    		<div class="panel-body">
			    	<table id='myTable' class='table table-striped'>
			    		<thead>
			    			<th>Title</th>
			    			<th>Author</th>
			    			<th>Genre</th>
			    			<th>Library Section</th>
			    			<th>Action</th>
			    		</thead>
			    		<tbody>
				    	<?php

				    		foreach($book_list as $bl) {
				    			echo "<tr>
				    				<td>".$bl->title."</td>
				    				<td>".$bl->author."</td>
				    				<td>".$bl->genre."</td>
				    				<td>".$bl->library_section."</td>
				    				<td><button data-toggle='modal' data-target='#borrow_modal' class='btn btn-sm btn-info' id='borrow_with_modal' value='".$bl->id."'>Borrow</button></td>
				    				</tr>";
				    		}

				    	?>
				    	</tbody>

				    	<tfoot>
				    		<th>
				    			<input class='form-control' type='text' placeholder="Title" id='search_title' />
				    		</th>
				    		<th>
				    			<input class='form-control' type='text' placeholder="Author" id='search_author' />
				    		</th>
				    		
				    		<th>
				    			<input class='form-control' type='text' placeholder="Genre" id='search_genre' />
				    		</th>

				    		<th>
				    			<input class='form-control' type='text' placeholder="Library Section" id='search_library_section' />
				    		</th>
				    		<th></th>

				    	</tfoot>

			    	</table>
			    </div>
		    </div>
    	</div>
    </div>

    <div class="modal fade" id="borrow_modal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
		    <div class="modal-content">


		      	<div class="modal-header">
		        	<button type="button" id='close_borrow_modal' class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Borrow Book</h4>
		        </div>



		        <form id='' method='post'>
			        <div class="modal-body">
			          	
			          	<input type='hidden' id='book_id'>
			          	<input type='hidden' id='book_title'>
			        	<div id='warning-msge'></div>

			        </div>
			        <div class="modal-footer">
			        	<button type="button" id='borrow' class='btn btn-primary'>Borrow</button>
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			    </form>

		    </div>
		</div>
   	</div>
    
    <script src='<?php echo base_url(); ?>asset/js/home.js'></script>

  	<?php $this->view('include/footer'); ?>

    
  </body>
</html>