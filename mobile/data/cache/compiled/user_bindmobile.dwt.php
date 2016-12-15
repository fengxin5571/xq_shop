<?php echo $this->fetch('library/user_header.lbi'); ?> 
<script type="text/javascript" src="__PUBLIC__/js/sms.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/user.js"></script> 
<form name="formEdit" action="<?php echo url('user/bindmobile');?>" method="post" onSubmit="return checkbindmobile()">
<input type="hidden" name="flag" id="flag" value="bingmobile" />
<section class="flow-consignee ect-bg-colorf">
<ul>
<li>
   <div class="input-text"><b class="pull-left"><?php echo $this->_var['lang']['mobile']; ?>：</b><span>
   <input name="mobile" type="text" placeholder="<?php echo $this->_var['lang']['no_mobile']; ?>"  value="" id="mobile_phone">
   </span></div>
</li>
<li>
   <div class="input-text code"><b><?php echo $this->_var['lang']['code']; ?>：</b><span>
   <input placeholder="<?php echo $this->_var['lang']['no_code']; ?>" name="mobile_code" id="mobile_code" type="text" >
   </span> <input class="pull-right ect-bg" id="zphone" name="sendsms" onClick="sendSms();" type="botton" value="<?php echo $this->_var['lang']['get_code']; ?>" style="width: 6em;border: none;text-align: center;"></div>
 </li>  

</ul>
</section>
<div class="two-btn ect-padding-tb ect-padding-lr ect-margin-tb text-center">
    <input type="hidden" name="sms_code" value="<?php echo $this->_var['sms_code']; ?>" id="sms_code" />
    
    <input name="submit" type="submit" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" class="btn btn-info" />
</div>
</form>
</div>
<?php echo $this->fetch('library/search.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?>
</body></html>