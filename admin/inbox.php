<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>


                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="10%">Serial No.</th>
                            <th width="20%">Name</th>
                            <th width="20%">Email</th>
							<th width="20%">Message</th>
							<th width="15%">Date</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
               <?php
                    $query = "SELECT * FROM tbl_contact WHERE status = '0' ORDER BY id DESC ";
                    $post = $db->select($query);
                    if ($post){
                    $i =0;
                    while ($result = $post->fetch_assoc()){
                    $i++;

               ?>
						<tr style="text-align: center;" class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShortlen($result['body'],20); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><a href="viewmsg.php?msgId=<?php echo $result['id']; ?>">View</a> ||
                                <a href="replymsg.php?msgId=<?php  echo $result['id']; ?>">Reply</a>
                            </td>
						</tr>
            <?php } } ?>

					</tbody>
				</table>
               </div>
            </div>

            <div class="box round first grid">
                <h2>Seen Message</h2>
           <?php
                if (isset($_GET['delId'])){
                    $delId = $_GET['delId'];

                    $query = "DELETE FROM tbl_contact WHERE id = '$delId'";
                    $delete = $db->delete($query);
                    if ($delete){
                        echo "<span class='success' >Mail Delete Successfully..!</span>";
                    }else{
                        echo "<span class='error' >Mail Not Deleted. Problem Occured!</span>";
                    }
                }
           ?>

                <div class="block">
                    <table class="data display datatable" id="example">
                        <thead>
                        <tr>
                            <th width="10%">Serial No.</th>
                            <th width="20%">Name</th>
                            <th width="20%">Email</th>
                            <th width="20%">Message</th>
                            <th width="15%">Date</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_contact WHERE status = '1' ORDER BY id DESC ";
                        $post = $db->select($query);
                        if ($post){
                            $i =0;
                            while ($result = $post->fetch_assoc()){
                                $i++;

                                ?>
                                <tr style="text-align: center;" class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
                                    <td><?php echo $result['email']; ?></td>
                                    <td><?php echo $fm->textShortlen($result['body'],20); ?></td>
                                    <td><?php echo $fm->formatDate($result['date']); ?></td>
                                    <td>
                                        <a href="viewmsg2.php?msgId=<?php echo $result['id']; ?>">View</a>||
                                        <a onclick="return confirm('Are to sure to delete!!');" href="?delId=<?php echo $result['id']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php } } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clear">
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

