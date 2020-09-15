 <div class="navbar-default sidebar" role="navigation">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
				<div class="sidebar-nav navbar-collapse slimscrollsidebar" style="overflow: hidden; width: auto; height: 100%;">
					<div class="user-profile">
						<div class="dropdown user-pro-body">
							<div><a href="<?php echo base_url()?>profile" class="waves-effect"><img src="<?php echo base_url().($this->session->userdata('photo')!='' ? $this->session->userdata('photo') :  'assets/img/unknown.jpg' ) ?>" alt="user-img" class="img-circle"></a></div>
							<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo  $this->session->userdata('nama_user') ?> <span class="caret"></span></a>
							<ul class="dropdown-menu animated flipInY">
								<li><a href="<?php echo base_url()?>profile" class="waves-effect <?php echo ($this->uri->segment(3)=='profile' ? 'active' : '' );?>"><i class="fa fa-user"></i> My Profile</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#"><i class="fa fa-cogs"></i> Account Setting</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url()?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
							</ul>
						</div>
					</div>
					<ul class="nav in" id="side-menu">
							<li><a href="<?php echo base_url()?>dashboard" class="waves-effect <?php echo ($this->uri->segment(3)=='dashboard' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-dashboard"></i> <span class="hide-menu">Dashboard</span></a></li>
							<li class="nav-small-cap">--- Visitor Management</li>
							<li><a href="<?php echo base_url('visitor')?>" class="waves-effect <?php echo ($this->uri->segment(3)=='visitor' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-odnoklassniki-square"></i>  <span class="hide-menu">Visitor Menu<span class="fa arrow"></span></span></a>
								<ul class="nav nav-second-level collapse  <?php echo ($this->uri->segment(3)=='visitor' ? 'in' : '' );?>" aria-expanded="true" style="">
									<li><a href="<?php echo base_url("visitor/index")?>" class="waves-effect <?php echo ($this->uri->segment(4)=='index' ? 'active' : '' );?>"><span class="hide-menu">Visitor Management</span></a></li>
									<li><a href="<?php echo base_url("visitor/dc/reqscheduledc_list")?>"  class="waves-effect <?php echo ($this->uri->segment(4)=='reqscheduledc_list' ? 'active' : '' );?>">DC Request List</a></li>
									<li><a href="<?php echo base_url("visitor/dc/scheduledc_list")?>"  class="waves-effect <?php echo ($this->uri->segment(4)=='scheduledc_list' ? 'active' : '' );?>">Jadwal Masuk Data Center</a></li>
								</ul>
							</li>
							
							
							<li class="nav-small-cap">--- Management</li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-plug"></i> <span class="hide-menu">PMS Lan</span></a></li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-book"></i> <span class="hide-menu">Document</span></a></li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-briefcase"></i> <span class="hide-menu">Asset</span></a></li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-ambulance"></i> <span class="hide-menu">Insident/Trouble Report</span></a></li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-random"></i> <span class="hide-menu">Vendor Management</span></a></li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-calendar "></i> <span class="hide-menu">Daily Monitoring Form</span></a></li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-refresh "></i> <span class="hide-menu">Maintenance</span></a></li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-heartbeat "></i> <span class="hide-menu">Healt Check</span></a></li>
							<li><a href="<?php echo base_url()?>controll" class="waves-effect <?php echo ($this->uri->segment(3)=='controll' ? 'active' : '' );?>"><i class="linea-icon linea-basic fa-fw fa fa-cogs"></i> <span class="hide-menu">Controll Menu</span></a></li>
							
					  </ul>
				</div>
				<div class="slimScrollBar" style="background: rgb(220, 220, 220) none repeat scroll 0% 0%; width: 0px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 1946px;"></div>
				<div class="slimScrollRail" style="width: 0px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div>
			</div>
        </div>
        </div>
		
		<!-- page content-->
    <div id="page-wrapper" style="min-height: 598px;">