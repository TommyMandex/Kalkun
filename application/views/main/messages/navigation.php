
<div class="jquerycssmenu">
<ul>
	<?php 
	if($this->uri->segment(2)=='conversation'):
		if($this->uri->segment(3)=='folder'): 

			// _tni_ added this for translation on the inbox, outbox etc.
			$theFolder = $this->uri->segment(4);
			$theFname = "inbox";
			if($theFolder == "inbox") {
			$theFname = lang('kalkun_inbox');
			} else if($theFolder == "outbox") {
			$theFname = lang('kalkun_outbox');
			} else if($theFolder == "sentitems") {
			$theFname = lang('kalkun_sentitems');
			} else {
				$theFname = $this->Kalkun_model->get_folders('name', $this->uri->segment(4))->row('name');
				// $theFname = $this->uri->segment(4);
			}
	?>
		<li><?php echo anchor('messages/folder/'.$this->uri->segment(4),'&lsaquo;&lsaquo; '.lang('tni_back_to').' '.$theFname, array('class' => 'button'));?></li>
		<?php else: ?>
		<li><?php echo anchor('messages/my_folder/'.$this->uri->segment(4).'/'.$this->uri->segment(6),'&lsaquo;&lsaquo; '.lang('tni_back_to').' '.humanize($this->Kalkun_model->get_folders('name', $this->uri->segment(6))->row('name')), array('class' => 'button'));?></li>
		<li>&nbsp;</li>
		<?php endif;?>
	<?php endif;?>
	<li><a href="#" class="select_all_button button"><?php echo lang('kalkun_select_all');?></a></li>
	<li><a href="#" class="clear_all_button button"><?php echo lang('kalkun_clear_all');?></a></li>
	<?php 
	if($this->uri->segment(2)=='folder' && $this->uri->segment(3)=='outbox'): 
	elseif($this->uri->segment(2)=='conversation' && $this->uri->segment(4)=='outbox'):
	else:?>
	<li>&nbsp;</li>
	<li><a class="move_to_button button" href="#"><?php echo lang('kalkun_move_to');?></a></li>	
	<?php endif; ?>
	<li><a class="global_delete button" href="#">
	<?php echo lang('kalkun_delete'); 
	if($this->uri->segment(4)=='5' or $this->uri->segment(6)=='5') echo " ".lang('kalkun_permanently');?></a></li>	
	<?php if($this->uri->segment(2)!='conversation'):?>
	<li>&nbsp;</li>
	<li><a href="#" class="refresh_button button"><?php echo lang('kalkun_refresh');?></a></li>	
    		
	<?php 
    if($this->uri->segment(2) != 'search'):
    if($this->pagination->create_links()!=''): ?>
	<li class="paging"><div id="paging"><?php  echo $this->pagination->create_links();?></div></li>
	<?php 
    endif;
    endif;
    ?>
	<?php endif;?>
</ul>
<?php if($place != 'bottom'): ?>
<div  id="window_title_right">
<?php
if($this->uri->segment(2)=='conversation')    $source =  $this->uri->segment(4);
else $source = $this->uri->segment(3);
if($this->uri->segment(2)=='my_folder')   $folder_id = $this->uri->segment(4);
else  $folder_id = '';
echo form_open("messages/search/results/$source", array('class' => 'search_form'));
echo form_hidden('source', $source);
echo form_hidden('folder_id', $folder_id);
?>
<input type="text" name="search_sms" size="20" class="search_sms" value="" />
<?php echo form_close(); ?>	
</div>
<?php endif; ?>
</div>	