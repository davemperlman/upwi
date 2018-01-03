<?php 
    require_once '../autoload.php';
    $existingInfo = Classes\SQL::get('SELECT * FROM WorkOrders WHERE id = :id', array('id' => $_POST['id']), 1);
    $imgs = explode(',', $existingInfo['photoLink']);
     ?>
<form method="post" id="imgupload" action="parts/submit.php" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data">

    <h3>Complete Job</h3>

    <a class="close" href="#">Back</a>


    <fieldset id="imagefield">

        <input type="hidden" name="WOid" value="<?php echo $_POST['id']; ?>">

        <label class="imgUploadLabel">
            Choose Images
            <input type="file" name="images[]" class="imginput" multiple>
        </label>

        <div class="images_preview">
            
            <?php foreach ($imgs as $img): ?>
                
                <img src="<?php echo $img; ?>" class="thumbnail" alt="">

            <?php endforeach ?>

        </div>

    </fieldset>


    <fieldset>

        <label>
            Work Completed
            <textarea id="work" name="work" rows="5">
                <?php echo "$existingInfo[description]"; ?>
            </textarea>

        </label>

        <label>
            Inventory Used
            <input id="inventory" name="inventory" value="<?php echo $existingInfo['inventoryUsed']; ?>" type="text">
        </label>

        <label>
            Hours Worked
            <input type="number" name="hours" value="<?php echo $existingInfo['hoursWorked']; ?>" minlength="0" step='.25'>
        </label>

    </fieldset>


    <button type="submit" id="completeWorkOrder">Submit</button>

</form>

<script>      
    $('.close').on('click', function(e){
        e.preventDefault();
        $('.offscreen-window').removeClass('slide-in');
        $('.offscreen-window').empty();
    });

    $('.imginput').on('change', function(){
        $('.images_preview').empty();
        for (var i = 0; i < $(this).length; i++) {
            var fr = new FileReader();
            fr.onload = function(e) {
                $('.images_preview').append("<img class='thumbnail' src='" + e.target.result + "'>");
            }
            fr.readAsDataURL(this.files[i]);
        }
    })
</script>