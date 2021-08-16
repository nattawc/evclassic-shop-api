<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
		
		
  if(isset($_REQUEST['tkl'])) {
	  include("process/json-taobao.php");
	  $d = new dProduct($_REQUEST['tkl']);
	 
  } else {
	  die("");
  }

?>

<?php  if($d->data != null) { ?>
  <body data-plugin-page-transition> 
    <div class="body">
      <div role="main" class="main shop pt-4">
        <div class="container">
          <div class="row">
            <div class="col-md-5 mb-5 mb-md-0">
              <div class="thumb-gallery-wrapper">
                <div
                  class="
                    thumb-gallery-detail
                    owl-carousel owl-theme
                    manual
                    nav-inside nav-style-1 nav-dark
                    mb-3
                  "
                >
					<?php for($i = 0; $i < count($d->data['pImages']); $i++) { ?>
                  <div>
                    <img
                      alt=""
                      class="img-fluid"
                      src="<?php echo $d->data['pImages'][$i]; ?>"
                      data-zoom-image="<?php echo $d->data['pImages'][$i]; ?>"
                    />
                  </div>
				   <?php } ?>
                  
                </div>
                <div
                  class="
                    thumb-gallery-thumbs
                    owl-carousel owl-theme
                    manual
                    thumb-gallery-thumbs
                  "
                >
				<?php for($i = 0; $i < count($d->data['pImages']); $i++) { ?>
                  <div class="cur-pointer">
                    <img
                      alt=""
                      class="img-fluid"
                      src="<?php echo $d->data['pImages'][$i]; ?>"
                    />
                  </div>
			    <?php } ?>
                
                </div>
              </div>
            </div>

            <div class="col-md-7">
              <div class="summary entry-summary position-relative">
                <div class="position-absolute top-0 right-0"></div>

                <h1 class="mb-0 font-weight-bold text-7"><?php echo $d->data['pTitle']; ?></h1>

                <div class="pb-0 clearfix d-flex align-items-center"></div>

                <div class="divider divider-small">
                  <hr class="bg-color-grey-scale-4" />
                </div>

                <p class="price mb-3">
                  <span class="sale text-danger">¥<?php echo $d->data['pPrice']; ?></span>
                 
                </p>

               

              
                  <table
                    class="table table-borderless"
                    
                  >
                    <tbody>
				<?php for($x = 0; $x < count($d->data['pProps']); $x++) { ?>
					<?php $row = $d->data['pProps'][$x]; ?>
						<?php // print_r($row); ?>
                      <tr>
                        <td class="align-middle text-2 px-0 py-2" style="min-width: 80px"><?php echo $row['name']; ?>:</td>
                        <td class="px-0 py-2">
								<?php // print_r($row); ?>
							<?php for($i = 0; $i < count($row['values']); $i++) { ?>
								<?php if(isset($row['values'][$i]['image'])) { ?>
							 <img src="<?php echo $row['values'][$i]['image']; ?>" width="45" id="opt_<?php echo $x; ?>_<?php echo $row['pid']; ?>_<?php echo $row['values'][$i]['vid']; ?>" class="btn btn-default btn-xs mb-1" style="padding: 0" />
								<?php } else { ?>
								<button id="opt_<?php echo $x; ?>_<?php echo $row['pid']; ?>_<?php echo $row['values'][$i]['vid']; ?>" class="btn btn-default btn-xs mb-1" type="button"><?php echo $row['values'][$i]['name']; ?></button>
								<?php } ?>
							<?php } ?>
	
                         
                        </td>
                      </tr>
					
				<?php } ?>
                   
                    </tbody>
                  </table>
					<input id="opt_c" name="opt_c" type="hidden" value="<?php echo count($d->data['pProps']); ?>" />
					<input id="pItemId" name="pItemId" type="hidden" value="<?php echo $d->data['pItemId']; ?>" />
                  <hr />
                  <div class="quantity quantity-lg">
                    <input
                      type="button"
                      class="
                        minus
                        text-color-hover-light
                        bg-color-hover-primary
                        border-color-hover-primary
                      "
                      value="-"
                    />
                    <input
                      type="text"
                      class="input-text qty text"
                      title="Qty"
                      value="1"
                      name="quantity"
                      min="1"
                      step="1"
						  id="cart-qty"
                    />
                    <input
                      type="button"
                      class="
                        plus
                        text-color-hover-light
                        bg-color-hover-primary
                        border-color-hover-primary
                      "
                      value="+"
                    />
                  </div>
                  <button
                    type="submit"
                    class="
                      btn btn-dark btn-modern
					  text-3
                      text-uppercase
                      bg-color-hover-primary
                      border-color-hover-primary
                    "
						  id="cart-add"
                  >
                    หยิบลงตระกร้า
                  </button>
                  <hr />
              </div>
            </div>
          </div>

          <hr class="my-5" />
        </div>
      </div>
    </div>
<?php } else { ?>
	  ไม่สามารถโหลดข้อมูลได้<br /><br />
<?php } ?>
