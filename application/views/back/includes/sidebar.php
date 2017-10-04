 <!-- BEGIN CONTAINER -->
            <div class="page-container">
               <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                  
                    <div class="page-sidebar navbar-collapse collapse">  
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>  
                            <li class="sidebar-search-wrapper">
                               
                                <form class="sidebar-search hidden" action="page_general_search_3.html" method="POST">
                                    <a href="javascript:;" class="remove">
                                        <i class="icon-close"></i>
                                    </a>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                                    </div>
                                </form>
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                            </li>
                            <li class="nav-item start dashboard">
                                <a href="<?php echo base_url('Admin/Dashboard');?>" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span> 
                                </a>
                                <!--ul class="sub-menu">
                                    <li class="nav-item start active open">
                                        <a href="index.html" class="nav-link ">
                                            <i class="icon-bar-chart"></i>
                                            <span class="title">Dashboard 1</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    
                                    
                                </ul-->
                            </li> 
							<?php if(base64_decode($this->session->userdata('token'))==1 && $this->session->userdata('logintype')==1){?> 
                            <li class="nav-item subadmin ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-user"></i>
                                    <span class="title">Subadmin</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu ">
                                    <li class="nav-item subad">
                                        <a href="<?php echo base_url('Admin/subadmincreate');?>" class="nav-link ">
										 <i class="fa fa-plus-circle"></i>
                                            <span class="title">Create subadmin</span>
                                        </a>
                                    </li>
									<li class="nav-item listsubadmin">
                                        <a href="<?php echo base_url('Admin/list_subadmin');?>" class="nav-link ">
										 <i class="fa fa-list"></i>
                                            <span class="title">All subadmin</span>
                                        </a>
                                    </li>
									<li class="nav-item allocateform">
                                        <a href="<?php echo base_url('Admin/allocateform_subadmin');?>" class="nav-link ">
										 <i class="fa fa-check-square"></i>
                                            <span class="title">Allocate Form to Subadmin</span>
                                        </a>
                                    </li>
									<li class="nav-item allocatelist">
                                        <a href="<?php echo base_url('Admin/listallocateform_subadmin');?>" class="nav-link ">
										 <i class="fa fa-list"></i>
                                            <span class="title">List of allocate form to subadmin</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </li>
							<li class="nav-item registereduser_list ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-users"></i>
                                    <span class="title">User</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu ">
                                    <li class="nav-item registereduser">
                                        <a href="<?php echo base_url('Admin/registereduser_list');?>" class="nav-link ">
										 <i class="fa fa-list"></i>
                                            <span class="title">Registered User</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </li> 
								<li class="nav-item form ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-list-alt"></i>
                                    <span class="title">Form</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu ">
                                    <li class="nav-item submitted">
                                        <a href="<?php echo base_url('Admin/submittedforms_list');?>" class="nav-link ">
										  <i class="fa fa-list"></i>
                                            <span class="title">View all submitted forms </span>
                                        </a>
                                    </li>
									 <!--li class="nav-item notsubmitted">
                                        <a href="<?php echo base_url('Admin/notsubmittedforms_list');?>" class="nav-link ">
										  <i class="fa fa-list"></i>
                                            <span class="title">Not submitted forms </span>
                                        </a>
                                    </li-->
                                </ul>
								 
                            </li>
							<?php }else{ }?>
							<?php if( $this->session->userdata('logintype')==2){?> 
							 <li class="nav-item allocate">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-list-alt"></i>
                                    <span class="title">Form</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu ">   
									<li class="nav-item allocateform">
                                        <a href="<?php echo base_url('Admin/view_allocateforms_subadmin');?>" class="nav-link ">
										 <i class="fa fa-list"></i>
                                            <span class="title">View allocate  forms  </span>
                                        </a>
                                    </li>
									<li class="nav-item anotherform">
                                        <a href="<?php echo base_url('Admin/allocateform_another_subadmin');?>" class="nav-link ">
										 <i class="fa fa-check-square"></i>
                                            <span class="title">Allocate form to another subadmin</span>
                                        </a>
                                    </li>
									<li class="nav-item listform">
                                        <a href="<?php echo base_url('Admin/listallocateform_anothersubadmin');?>" class="nav-link ">
										 <i class="fa fa-list"></i>
                                            <span class="title">List of allocate form to another subadmin</span>
                                        </a>
                                    </li>
									
                                </ul>
                            </li>
							<?php }else{ }?> 
							<li class="nav-item start setting hidden">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-wrench"></i>
                                    <span class="title">Settings</span>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                </a>
                                <ul class="sub-menu changepassword">
                                    <li class="nav-item start active open">
                                        <a href="<?php echo base_url('Admin/changepassword');?>" class="nav-link ">
                                            <i class="fa fa-key"></i>
                                            <span class="title">Change Password</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li> 
									<li class="nav-item start active open">
                                        <a href="<?php echo base_url('Admin/logout');?>" class="nav-link ">
                                            <i class="fa fa-power-off"></i>
                                            <span class="title">Logout</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->