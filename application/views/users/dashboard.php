<h2>Select your subscription plan</h2>
<div class="row">
	


    <div class="col-md-10">
        <!-- To Do Card List card start -->
        <div class="card">
        <form action="<?php echo base_url(); ?>/users/add_package_data" enctype="multipart/form-data" method="post" accept-charset="utf-8">
           
            <div class="requiredswitch">
                <?php $i=1; foreach($packDetails as $packDetailsres) {?>
                <input <?php if($i==1) { echo 'checked="checked"';} ?>  id="<?php echo $packDetailsres->id; ?>" name="packageid" type="radio" value="<?php echo $packDetailsres->id; ?>">
                <label for="<?php echo $packDetailsres->id; ?>"><?php echo $packDetailsres->name; ?> <?php echo $packDetailsres->price; ?></label>
                <?php $i++;  } ?>
              
            </div>

            <input type="submit" value="Submit" />
                </form>
            
        </div>
        <!-- To Do Card List card end -->
    </div>

</div>




