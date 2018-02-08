<div class="slidersection templete clear">
    <div id="slider">
        <?php
        $query = "SELECT * FROM tbl_slider ORDER BY id ASC limit 5";
        $slider = $db->select($query);
        if ($slider){
        while ($result = $slider->fetch_assoc()){

        ?>
            <a target="_blank" href="<?php echo $result['link'] ;?>"><img src="admin/<?php echo $result['image'] ;?>" alt="nature 1" title="<?php echo $result['title'] ;?>" /></a>

        <?php } } ?>
    </div>

</div>