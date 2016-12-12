<?php if ($this->_var['index_ad'] == 'sys'): ?>
    <div class="focus fl">
        <div class="comiis_wrapad" id="slideContainer">
          <div id="frameHlicAe" class="frame cl">
            <div class="temp"></div>
            <div class="block">
              <div class="cl">
                <ul class="slideshow" id="slidesImgs">
                  <?php $_from = $this->_var['playerdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad');$this->_foreach['playerdb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['playerdb']['total'] > 0):
    foreach ($_from AS $this->_var['ad']):
        $this->_foreach['playerdb']['iteration']++;
?>
                  <li><a href="<?php echo $this->_var['ad']['url']; ?>" title="<?php echo $this->_var['ad']['text']; ?>" target="_blank"><img src="<?php echo $this->_var['ad']['src']; ?>" width="685" height="397" alt="<?php echo $this->_var['ad']['text']; ?>" /></a></li>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  
                </ul>
              </div>
              <div class="slidebar" id="slideBar">
                <ul>
                  <?php $_from = $this->_var['playerdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad');$this->_foreach['playerdb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['playerdb']['total'] > 0):
    foreach ($_from AS $this->_var['ad']):
        $this->_foreach['playerdb']['iteration']++;
?>
                  <li <?php if (($this->_foreach['playerdb']['iteration'] <= 1)): ?>class="on"<?php endif; ?>><?php echo $this->_foreach['playerdb']['iteration']; ?></li>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <script>
            SlideShow(5000);
        </script>
      </div>
<?php elseif ($this->_var['index_ad'] == 'cus'): ?>
  <?php if ($this->_var['ad']['ad_type'] == 0): ?>
    <a href="<?php echo $this->_var['ad']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['ad']['content']; ?>" width="484" height="200" border="0"></a>
  <?php elseif ($this->_var['ad']['ad_type'] == 1): ?>
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="484" height="200">
      <param name="movie" value="<?php echo $this->_var['ad']['content']; ?>" />
      <param name="quality" value="high" />
      <embed src="<?php echo $this->_var['ad']['content']; ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="484" height="200"></embed>
    </object>
  <?php elseif ($this->_var['ad']['ad_type'] == 2): ?>
    <?php echo $this->_var['ad']['content']; ?>
  <?php elseif ($this->_var['ad']['ad_type'] == 3): ?>
    <a href="<?php echo $this->_var['ad']['url']; ?>" target="_blank"><?php echo $this->_var['ad']['content']; ?></a>
  <?php endif; ?>
<?php else: ?>
<?php endif; ?>