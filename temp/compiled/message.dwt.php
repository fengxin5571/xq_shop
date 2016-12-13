<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<?php if ($this->_var['auto_redirect']): ?>
<meta http-equiv="refresh" content="3;URL=<?php echo $this->_var['message']['back_url']; ?>" />
<?php endif; ?>

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>

</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="main">
    <div class="mg-cate w1160px clearfix">
    <?php echo $this->fetch('library/category_tree.lbi'); ?>
    </div>
    <div class="w1160px clearfix">
        <div class="cart mt40">
            <h2><div class="cube"></div><strong><i><?php echo $this->_var['lang']['system_info']; ?></i></strong></h2>
            <div style="margin:20px auto;text-align:center">
                <p style="font-size: 14px; font-weight:bold; color: red;"><?php echo $this->_var['message']['content']; ?></p>
                <div class="blank"></div>
                <?php if ($this->_var['message']['url_info']): ?>
                  <?php $_from = $this->_var['message']['url_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('info', 'url');if (count($_from)):
    foreach ($_from AS $this->_var['info'] => $this->_var['url']):
?>
                  <p class="mt7"><a href="<?php echo $this->_var['url']; ?>"><?php echo $this->_var['info']; ?></a></p>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <?php endif; ?>
            </div>
      </div>
    </div>
</div>

<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
