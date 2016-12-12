<div id="box">
		<ul>
			<li >
				<a class="num" href="<?php echo $this->_var['factory_url']; ?>" style="display:none">1F</a>
				<a class="word" href="<?php echo $this->_var['factory_url']; ?>" style="display:block">净水器</a>
			</li>
			<?php if ($this->_var['life_goods']): ?>
			<li>
				<a class="num" href="<?php echo $this->_var['life_url']; ?>">2F</a>
				<a class="word" href="<?php echo $this->_var['life_url']; ?>">净化器</a>
				</li>
			<?php endif; ?>
			 <?php if ($this->_var['parts_goods']): ?>
			<li class='last'>
				<a class="num" href="<?php echo $this->_var['parts_url']; ?>">3F</a>
				<a class="word" href="<?php echo $this->_var['parts_url']; ?>">防护具</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>