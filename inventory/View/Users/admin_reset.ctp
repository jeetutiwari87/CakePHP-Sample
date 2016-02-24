<div class="inner_banner" >
  <div class="innerwrapper"> <?php echo $this->element('searchbox');?>
    <div class="breadcrumb_bg">
      <ul>
        <li style="padding-left:0px;"> <?php echo $this->Html->link(
					Configure::read('site.front_breadcrumbs_text'),
					array("controller"=>"properties","action"=>"home"),
					array( 'escape' => false)
				);
   ?> <span></span></li>
        <li class="bgnone"><?php echo __('Reset Password');?></li>
      </ul>
    </div>
    <div class="contentpart">
      <h1><?php echo __('Reset Password');?></h1>
      <div class="full login"> <?php echo $this->Form->create('User');?>
        <div class="left pad_login">
          <div class="full"><?php echo $this->Html->image('login_box_top.jpg', array('alt' =>"","width"=>"452","height"=>"13"));?></div>
          <div class="login_bg full ">
            <div class="pad_login02">
              <div class="login_passwordbg marB25"> <?php 
		   echo $this->Form->input("password", array("div" => false, "label" => false, "title" => "Password","class"=>"login_input")); ?> </div>
              <div class="login_passwordbg">
			     <?php echo $this->Form->input("confirm_password", array("class"=>"login_input","div" => false,"type"=>"password", "label" => false, "title" => "Confirm Password")); ?>
                
              </div>
             
              <p class="fleft padT1"> <span class="fleft"><?php echo $this->Html->image('blue_btLcr.png', array('alt' =>""));?></span> <span class="fleft font13"> <?php echo $this->Form->submit(__('Reset Password'),array("div"=>false,"class"=>"bluebutton")); ?> </span> <span class="fleft"><?php echo $this->Html->image('blue_btRcr.png', array('alt' =>""));?></span> </p>
            </div>
          </div>
          <div class="full"><?php echo $this->Html->image('login_box_bottom.jpg', array('alt' =>"","width"=>"452","height"=>"22"));?></div>
        </div>
        <?php echo $this->Form->end(); ?>
        <div class="right pad_login03">
          <h3 class="login_righthead"><?php echo (isset($reset_page_content_arr['Page']['title']) && $reset_page_content_arr['Page']['title']!='')?$reset_page_content_arr['Page']['title']:'';?></h3>
         <?php echo (isset($reset_page_content_arr['Page']['content']) && $reset_page_content_arr['Page']['content']!='')?$reset_page_content_arr['Page']['content']:'';?>
        </div>
      </div>
    </div>
    <span class="fleft"><?php echo $this->Html->image('sheet_bottom.png', array('alt' =>""));?></span> </div>
</div>
