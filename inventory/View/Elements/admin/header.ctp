 <header class="header">
        
			 <?php echo $this->Html->link('Inventory System', array('controller' => 'users', 'action' =>'dashboard',"admin"=>true),array("escape"=>false,'class'=>"logo")); ?>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
              <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                     
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $UsersDetails['username'];?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
								<?php //echo $this->Html->image('admin/avatar5.png',array("class"=>"img-circle")); ?>
                                
                                    <p>
                                        <?php echo $UsersDetails['username'];?>
                                        <small>Member since <?php echo date('F Y',strtotime($UsersDetails['created']));?> </small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                               
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
									  
									  <?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'profile',$UsersDetails['id'],"admin"=>true),array("escape"=>false,'class'=>'btn btn-default btn-flat')); ?>
									</div>
                                    <div class="pull-right">
									    <?php echo $this->Html->link('Sign out', array('controller' => 'users', 'action' => 'logout',"admin"=>true),array("escape"=>false,'class'=>'btn btn-default btn-flat')); ?>
										
                                       
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>