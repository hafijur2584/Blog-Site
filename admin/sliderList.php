<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2><br>

        <div class="block">
            <table style="" width="100%" class="data display datatable" id="example">
                <thead>
                <tr>
                    <th width="15%">No</th>
                    <th width="30%">Slider Title</th>
                    <th width="20%">Image</th>
                    <th width="20%">Link</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                <!--    start                code for show data in this table-->

                <?php
                $query = "SELECT * FROM tbl_slider";
                $slider = $db->select($query);
                if ($slider){
                    $i =0;
                    while ($result = $slider->fetch_assoc()){
                        $i++;

                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['title']?></td>
                            <td><img src="<?php echo $result['image']; ?>" alt="" style="width: 80px;height: 30px;"></td>
                            <td><?php echo $result['link']?></td>

                            <td>

                                <?php
                                if (Session::get('userRole')=='1'){

                                    ?>
                                    <a  href="editSlider.php?editid=<?php echo $result['id']; ?>">Edit</a> ||
                                    <a onclick="return confirm('Are to sure to delete!!');" href="delslider.php?delid=<?php echo $result['id']; ?>">Delete</a>
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

