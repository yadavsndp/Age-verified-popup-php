<form action="" method="post" class="registration-form">
         <div class="position-relative form-group" id="other-description">
                  <label class="birth-msg" style="display: none;color: red; padding: 11px 0px 0px 70px;;font-size: 18px">Sorry, you must be legal age to enter</label>
                  <label><p style="text-align: center; font-weight: bold; color: black;margin: 0px 0px -21px 0px;">Date of Birth</p></label>
                  <label class="select-msg" style="display: none;color: red; padding: 11px 0px 0px 1px;;font-size: 17px">*Please Enter Valid Date And Select Province*</label>
            <div class="m-y-d-dropdowns"> 
               <div class="month-dropdown">
                    <?php
                    $month = array('01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
                    ?>
               <label class="age-gate-label" for="age-gate-m" style="font-weight: bold; color: black;">Month</label>
                   <select name="age_gate[m]" id="month" class="age-gate-select" required="">
                        <option value="">MM</option>
                        <?php foreach ($month as $key => $value) { ?>
                        	<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php } ?>
                   </select>
                </div>
                <div class="day-dropdown">
                   <label class="age-gate-label" for="age-gate-d" style="font-weight: bold; color: black;">Day</label>
                      <select name="day" id="day">
                         <?php
                           for($i=1;$i<=31;$i++) {?>
                              <option value="<?=$i?>"><?=$i?></option>
                          <?php } ?>
                     </select>
            </div>
            <div class="year-dropdown">
                  <label class="age-gate-label" for="age-gate-d" style="font-weight: bold; color: black;">Year</label>
                    <select name="years" class="all_states" id="year">
                        <?php 
                         for ($x=date("Y")-17; $x>1899; $x--)
                          {
                            echo'<option value="'.$x.'">'.$x.'</option>'; 
                          }
                        ?>
                    </select>
                    <select name="years" class="selected_states" style="display: none;">
                        <?php 
                         for ($x=date("Y")-18; $x>1899; $x--)
                          {
                            echo'<option value="'.$x.'">'.$x.'</option>'; 
                          }
                        ?>
                </select>
            </div>
          </div>
           <!--  <label class="birth-msg" style="display: none;color: red; padding: 11px 0px 0px 70px;;font-size: 18px">Sorry, you must be legal age to enter</label>
            <label><p style="text-align: center; font-weight: bold; color: black;">Date Of Birth</p></label>
          <input type="date" name="bday" id="bday" onchange="handler(event);"> -->
        
       <!--  <div class="position-relative form-group">
          <label for="last_name">Where are you from?</label>
          <div class="select-wrapper">
            <select id="province" name="country" class="interested_in">
              <option value="Alberta">Canada</option>
            </select>
          </div>
        </div> -->
         <div class="position-relative form-group province-selected">
          <label><p style="text-align: center; font-weight: bold; color: black;">Province</p></label>
           <label class="city-msg" style="display: none;color: red; padding: 0 0 0 3px;font-size: 13px">Please Select Province</label>
          <div class="select-wrapper">
            <select id="province" name="province" class="interested_in">
              <option value="">---Select Province---</option>
              <option value="Alberta">Alberta</option>
              <option value="British Columbia">British Columbia</option>
              <option value="Manitoba">Manitoba</option>
              <option value="New Brunswick">New Brunswick</option>
              <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
              <option value="Northwest Territories">Northwest Territories</option>
              <option value="Nova Scotia">Nova Scotia</option>
              <option value="Nunavut">Nunavut</option>
              <option value="Ontario">Ontario</option>
              <option value="Prince Edward Island">Prince Edward Island</option>
              <option value="Quebec">Quebec</option>
              <option value="Saskatchewan">Saskatchewan</option>
              <option value="Yukon Territory">Yukon Territory</option>
            </select>
          </div>
        </div>
        <div class="form-group">
        <label class="checkbox-remember" style="display: flex !important; width: 100% !important;">
            <input type="checkbox" name="remember" id="remember">
            <span style="margin: 8px 0 20px 6px;font-size: 14px;">Remember me on this device for 30 days.I confirm that this not a shared device.</span>
        </label>
        </div>
        <div class="position-relative form-group" id="other-description">
         <button type="submit" name="submit" id="send_submit_bnt" class="btn submit-bnt btn-secondary" style="margin-top: 0 !important;white-space: pre-line; height: auto; padding: 15px;" value="submit" onclick="closepopup();">Enter</button>
       </div>
     </div>
   </form>

<!-- open popup and set cookie -->
   <script type="text/javascript">
    jQuery(document).ready(function(){
    <?php if(!isset($_COOKIE['rememberme'])) { ?>

        jQuery.magnificPopup.open({
            items: {src: "#registration-popup"},
            type: "inline"
        }, 0);
    <?php } ?>
});
</script>

<!-- checked age verification with msg -->
<script type="text/javascript">
  function closepopup() {
   var min_age = 18; 
   var year =   parseInt($('#year').val());
   var month =  parseInt($('#month').val());
   var day =    parseInt($('#day').val());
   var theirDate = new Date((year + min_age), month, day);
   var today = new Date;

  $('.select-msg').hide(); 
  $('.birth-msg').hide();


    if($('#year').val() == '' || $('#month').val() == '' || $('#province').val() == ''){
      $('.select-msg').show();
      $('#province').css("border", "1px solid red");
       if ((today.getTime() - theirDate.getTime()) < 0) {
             $('.birth-msg').show();
       }
      return false;
    } else {
      $(this).css("border", "1px solid #666");
      $('.select-msg').hide(); 
    }

    // $("#send_submit_bnt").click(function() {
    if($("input[type=checkbox]").is(":checked")) { 
        Cookies.set("rememberme", 1,{ expires : 30,path :'/'})
    }
    $.magnificPopup.close();
    // };
  }
</script>

<!-- checked age in deffrent state -->
<script type="text/javascript">
    $('.interested_in').change(function(){
    if($(this).val() == 'Alberta') {
      $(".selected_states").show();
      $(".all_states").hide();
    } else if($(this).val() == 'Quebec') {
      $(".selected_states").show();
      $(".all_states").hide();
    } else {
      $(".selected_states").hide();
      $(".all_states").show();
    }
  });
</script>
