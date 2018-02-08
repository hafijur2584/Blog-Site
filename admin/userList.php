<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <!--                php code for delete category-->
        <?php
        if (isset($_GET['delUser'])){
            $delId = $_GET['delUser'];
            $delQuery = "DELETE FROM tbl_user WHERE id = '$delId' ";
            $delUser = $db->delete($delQuery);

            if ($delUser){
                echo "<span class='success' >User Deleted Successfully..!!</span>";
            }else{
                echo "<span class='error' >User Not Deleted..!!</span>";
            }
        }
        ?>
        <!--                php code for delete category-->
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Name</th>
                    <th>userName</th>
                    <th>Email</th>
                    <th>Details</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM tbl_user ORDER BY id ASC ";
                $category = $db->select($query);
                if ($category){
                    $i =0;
                    while ($result = $category->fetch_assoc()){
                        $i++;

                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['name']?></td>
                            <td><?php echo $result['username']?></td>
                            <td><?php echo $result['email']?></td>
                            <td><?php echo $fm->textShortlen($result['details'],30); ?></td>
                            <td>
                                <?php
                                    if ($result['role']==1){
                                        echo "Admin";
                                    }elseif($result['role']==2){
                                        echo "Author";
                                    }elseif($result['role']==3){
                                        echo "Editor";
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="viewProfile.php?viewid=<?php echo $result['id']; ?>">View</a>
                                <?php
                                if (Session::get('userRole')==1){ ?>
                                   || <a onclick="return confirm('Are to sure to delete!!');" href="?delUser=<?php echo
                                    $result['id']; ?>">Delete</a>
                                <?php   }
                                ?>



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
