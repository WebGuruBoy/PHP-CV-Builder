<div class="">
	<div class="choose-tpl-header">
		Choose your CV Template
		<p class="dg-select-tpl">What do you want your CV to look like?</p>
	</div>
	<div class="list-container" >
		<?php for($i=0;$i<5;$i++): ?>
		<div class="tmp-list row justify-content-md-center">
			<?php for($j=0;$j<6;$j++): ?>
			<div class="gallery">
				<a href="<?php echo $this->baseurl,'cvedit/cvlogin/',$i*6+$j+1;?>">
					<?php if($i*6+$j+1 != 15 && $i*6+$j+1 != 16):?>
					<img src="<?php echo $this->baseurl,'assets/images/tpl/',($i*6+$j+1),'.svg';?>" alt="Cinque Terre" width="600" height="400">
					<?php else:?>
					<img src="<?php echo $this->baseurl,'assets/images/tpl/',($i*6+$j+1),'.jpg';?>" alt="Cinque Terre" width="600" height="400">
					<?php endif;?>
				</a>
			</div>
			<?php endfor;?>
		</div>
		<?php endfor;?>
	</div>
</div>