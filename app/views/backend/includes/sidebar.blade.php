            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{{ URL::to('/backend') }}"><i class="fa fa-fw fa-dashboard"></i> 系统统计</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/colleges') }}"><i class="fa fa-fw fa-edit"></i>学校管理</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/carticles') }}"><i class="fa fa-fw fa-edit"></i>学校资讯管理</a>
                    </li>
                     <li>
                        <a href="{{ URL::to('/backend/specialties ') }}"><i class="fa fa-fw fa-table"></i>专业管理</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/charts') }}"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/tables') }}"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/bootstrap-elements') }}"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/bootstrap-grid') }}"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ URL::to('/backend/blank-page') }}"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                </ul>
            </div>