 <nav class="navbar navbar-default navbar-static-top m-b-0">
 
            <div class="navbar-header ">
                <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                <div class="top-left-part">
                    <a class="logo" href="#">
                        <b>
                      
                     </b>
                        <span class="hidden-xs">
							<a href="/portal_isd/dashboard" class="site_title"><i class="fa fa-asterisk"></i>&nbsp; &nbsp;<span>I S D</span></a>
                     </span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                   
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">Your Last Notification</div>
                            </li>
                            <li>
							
								
								<?php print_r ($this->login_m->getnotification())?> 
                                <div class="message-center">
                                    <a href="#">
                                        <div class="user-img"> 
											<img src="" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> 
										</div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="in">
                        <form role="search" class="app-search hidden-xs m-r-10">
                            <input placeholder="Search..." class="form-control" type="text"> <a href="" class="active"><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
       