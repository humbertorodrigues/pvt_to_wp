<?php
somente_logado();

get_header();

$user_id = get_current_user_id();
$user = wp_get_current_user();
?>
        <div class="content dashboard_v1">
            <div class="row">
              <div class="col-md-7 ">
                <div class="pvr-wrapper d-none">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                <div class="pvr-box-controls">
                                </div>
                            </h5>
                        </div>
                    </div>

                    <div class="pvr-wrapper">
                            <div class="pvr-box">
                                <h5 class="pvr-header">
                                    <div class="pvr-box-controls">
                                    </div>
                                </h5>
                            </div>
                     </div>
              </div>

              <div class="col-md-5">
                <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                            </h5>
                        </div>
                </div>
                <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                <div class="pvr-box-controls">
                                </div>
                            </h5>
                        </div>
                </div>
                <div class="pvr-wrapper d-none">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                <div class="pvr-box-controls">
                                </div>
                            </h5>
                        </div>
                    </div>
              </div>
            </div>
        </div>
   </div><!-- End Main Panel-->
 </div><!-- End Wrapper-->

  <script type="text/javascript">
      jQuery(document).ready(function(){


      })
  </script>
  <?php
  get_footer();
  ?>
