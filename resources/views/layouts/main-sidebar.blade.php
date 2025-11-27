<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- Dashboard menu item-->
                    <li>
                        <a href="{{route('dashboard')}}">
                            <div class="pull-left " style="font-size: 18px; "><i class="ti-home" style="font-size: 18px; font-weight: bold;"></i><span class="right-nav-text">الرئيسية</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <!-- Elements menu item-->
                    <!-- <li>
                        <a href="#">
                            <div class="pull-left" style="font-size: 18px;"> <i class="ti-palette" style="font-size: 18px; font-weight: bold;"></i><span
                                    class="right-nav-text">الموظفين</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li> -->
                    <!-- <li>
                        <a href="#">
                            <div class="pull-left" style="font-size: 18px;"> <i class="fa fa-car" style="font-size: 18px; font-weight: bold;"></i><span
                                    class="right-nav-text">السيارات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li> -->
                     <li>
                        <a href="{{route('getSiteData')}}">
                            <div class="pull-left" style="font-size: 18px;"><i class="fa fa-list-ul" style="font-size: 18px; font-weight: bold;"></i><span class="right-nav-text"> اعدادات الموقع </span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li> 
                <li>
                    <a href="{{route('getCategory')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-archive" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الفنادق</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('getReservation')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-cogs" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الحجوزات</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>


                    <!-- calendar menu item-->
                    <!-- <li>
                    <a href="{{route('getSubCategory')}}"  >
                            <div class="pull-left"><i class="fa fa-sitemap"></i><span
                                    class="right-nav-text">SubCategory</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>  -->
                    <!-- <li>
                    <a href="{{route('getVendor')}}">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">Vendor</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>  -->
                    <li>
                        <a href="{{route('admin.users.index')}}">
                            <div class="pull-left " style="font-size: 18px; "><i class="fa fa-user " style="font-size: 18px; font-weight: bold;"></i><span class="right-nav-text ">المستخدمين</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->