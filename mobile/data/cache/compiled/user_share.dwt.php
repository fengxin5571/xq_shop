<?php echo $this->fetch('library/user_header.lbi'); ?>
<?php if ($this->_var['share']['on'] == 1): ?> 
<?php if (! $this->_var['goodsid'] || $this->_var['goodsid'] == 0): ?>
<?php if ($this->_var['share']['config']['separate_by'] == 0): ?>
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class="u-table">
    <tr align="center" class="first-tr">
      <td><?php echo $this->_var['lang']['affiliate_lever']; ?></td>
      <td><?php echo $this->_var['lang']['affiliate_num']; ?></td>
      <td><?php echo $this->_var['lang']['level_point']; ?></td>
      <td><?php echo $this->_var['lang']['level_money']; ?></td>
    </tr>
    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('level', 'val');$this->_foreach['affdb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['affdb']['total'] > 0):
    foreach ($_from AS $this->_var['level'] => $this->_var['val']):
        $this->_foreach['affdb']['iteration']++;
?>
    <tr align="center">
      <td><?php echo $this->_var['level']; ?></td>
      <td><?php echo $this->_var['val']['num']; ?></td>
      <td><?php echo $this->_var['val']['point']; ?></td>
      <td><?php echo $this->_var['val']['money']; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
  <?php endif; ?>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class="u-table">
    <tr align="center" class="first-tr">
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_money']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_point']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_mode']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_status']; ?></td>
    </tr>
    <?php $_from = $this->_var['logdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');$this->_foreach['logdb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['logdb']['total'] > 0):
    foreach ($_from AS $this->_var['val']):
        $this->_foreach['logdb']['iteration']++;
?>
    <tr align="center">
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['order_sn']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['money']; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['val']['point']; ?></td>
      <td bgcolor="#ffffff"><?php if ($this->_var['val']['separate_type'] == 1 || $this->_var['val']['separate_type'] === 0): ?><?php echo $this->_var['lang']['affiliate_type'][$this->_var['val']['separate_type']]; ?><?php else: ?><?php echo $this->_var['lang']['affiliate_type'][$this->_var['affiliate_type']]; ?><?php endif; ?></td>
      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_stats'][$this->_var['val']['is_separate']]; ?></td>
    </tr>
    <?php endforeach; else: ?>
	<tr><td colspan="5" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
    <?php if ($this->_var['logdb']): ?>
    <tr>
    <td colspan="5" align="right">
        <?php if ($this->_var['page']): ?>
        <a href="<?php echo $this->_var['page']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a><a href="<?php echo $this->_var['page']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a>
        <?php endif; ?>
    </td>
    </tr>
    <?php endif; ?>
  </table>
  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class="u-table">
    <tr>
      <td style="text-align:center;"><?php echo $this->_var['shopurl']; ?><br><img src="<?php echo $this->_var['domain']; ?><?php echo url('user/create_qrcode', array('value'=>$this->_var['shopurl']));?>"></td>
    </tr>
    <tr>
        <td >
        	<div class="bdsharebuttonbox" data-tag="share_1" style="width:12em;margin:0 auto;">
				<a class="bds_qzone" data-cmd="qzone" href="#"></a>
				<a class="bds_tsina" data-cmd="tsina"></a>
				<a class="bds_bdhome" data-cmd="bdhome"></a>
				<a class="bds_renren" data-cmd="renren"></a>
			</div>
        </td>
    </tr>
  </table>
</div>
<?php endif; ?> 
<?php endif; ?>
<script>
	window._bd_share_config = {
		common : {
			bdText : '<?php echo $this->_var['shopdesc']; ?>',
			bdUrl : '<?php echo $this->_var['shopurl']; ?>',
			bdPic : "<?php echo $this->_var['domain']; ?><?php echo url('user/create_qrcode', array('value'=>$this->_var['shopurl']));?>"
		},
		share : [{
			"bdSize" : 32
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
<?php echo $this->fetch('library/search.lbi'); ?>
<?php echo $this->fetch('library/page_footer.lbi'); ?>