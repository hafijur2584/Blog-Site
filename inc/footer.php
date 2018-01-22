

</div>

<div class="footersection templete clear">
    <div class="footermenu clear">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Privacy</a></li>
        </ul>
    </div>
    <?php
    $query_copy = "SELECT * FROM tbl_footer WHERE id ='1'";
    $select_copy = $db->select($query_copy);
    if ($select){
    while ($result_copy = $select_copy->fetch_assoc()){

    ?>

    <p>&copy; <?php echo $result_copy['note']; ?> <?php echo date('Y'); ?></p>

    <?php } } ?>
</div>
<?php
$querySocial = "SELECT * FROM tbl_social WHERE id = '1'";
$socialSelect = $db->select($querySocial);
if ($socialSelect){
while ($socialResult = $socialSelect->fetch_assoc()){


?>
<div class="fixedicon clear">
    <a href="<?php echo $socialResult['fb']; ?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
    <a href="<?php echo $socialResult['tw']; ?>"><img src="images/tw.png" alt="Twitter"/></a>
    <a href="<?php echo $socialResult['ln']; ?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
    <a href="<?php echo $socialResult['gp']; ?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
</div>
<?php  } } ?>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>