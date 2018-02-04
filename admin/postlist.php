<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2><br>

                <div class="block">  
                    <table style="" width="100%" class="data display datatable" id="example">
					<thead>
						<tr>
                            <th width="5%">No</th>
							<th width="12%">Post Title</th>
							<th width="20%">Description</th>
							<th width="8%">Category</th>
							<th width="15%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
<!--    start                code for show data in this table-->

             <?php
                    $query = "SELECT tbl_post.*,tbl_category.name FROM tbl_post INNER JOIN tbl_category
                              ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.title DESC ";
                    $post = $db->select($query);
                    if ($post){
                        $i =0;
                        while ($result = $post->fetch_assoc()){
                            $i++;

             ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']?></td>
							<td><?php echo $fm->textShortlen($result['body'],50); ?></td>
                            <td><?php echo $result['name']?></td>
                            <td><img src="<?php echo $result['image']; ?>" alt="" style="width: 50px;height: 40px;"></td>
							<td><?php echo $result['author']?></td>
							<td><?php echo $result['tags']?></td>
							<td><?php echo $fm->formatDate($result['date']);  ?> </td>
                            
							<td>
							    <a href="viewPost.php?viewPost=<?php echo $result['id']; ?>">View</a>

             <?php
                if (Session::get('userId') == $result['userid'] ||Session::get('userRole')=='1'){

             ?>
                              ||  <a  href="editpost.php?editid=<?php echo $result['id']; ?>">Edit</a> ||
                                <a onclick="return confirm('Are to sure to delete!!');" href="delepost.php?delid=<?php echo $result['id']; ?>">Delete</a>
               <?php } ?>
                            </td>
						</tr>
                    <?php } } ?>


<!--    end                code for show data in this table-->

					</tbody>
				</table>
	
               </div>
            </div>
        </div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>

