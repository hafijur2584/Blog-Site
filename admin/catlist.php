<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
<!--                php code for delete category-->
                <?php
                    if (isset($_GET['delcat'])){
                        $delId = $_GET['delcat'];
                        $delQuery = "DELETE FROM tbl_category WHERE id = '$delId' ";
                        $delCat = $db->delete($delQuery);

                        if ($delCat){
                            echo "<span class='success' >Category Deleted Successfully..!!</span>";
                        }else{
                            echo "<span class='error' >Category Not Deleted..!!</span>";
                        }
                    }
                ?>
 <!--                php code for delete category-->
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                        $query = "SELECT * FROM tbl_category ORDER BY id ASC ";
                        $category = $db->select($query);
                        if ($category){
                            $i =0;
                            while ($result = $category->fetch_assoc()){
                                $i++;

                    ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']?></td>
							<td>
                                <?php
                                if (Session::get('userRole') == '1'){

                                    ?>
                                <a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a>
                                || <a onclick="return confirm('Are to sure to delete!!');" href="?delcat=<?php echo $result['id']; ?>">Delete</a>
                              <?php }elseif(Session::get('userRole') == '3'){ ?>
                                    <a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a>
                           <?php     } ?>
                            </td>
						</tr>
                    <?php } } ?>

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
