<!--Header-Upper-->
<style>
    .login-card-btn {
        margin-left: 15px;
    }
    .main-menu .navigation > li.login-card-btn > a {
        background: linear-gradient(135deg, #003366 0%, #00509E 100%) !important;
        color: #ffffff !important;
        padding: 8px 18px !important;
        border-radius: 20px !important;
        font-size: 13px !important;
        box-shadow: 0 3px 10px rgba(0, 51, 102, 0.2);
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        border: 2px solid transparent;
        line-height: 18px !important;
    }
    .main-menu .navigation > li.login-card-btn > a:hover {
        background: linear-gradient(135deg, #002244 0%, #003366 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 51, 102, 0.4);
        border-color: rgba(255, 255, 255, 0.1);
    }
    .main-menu .navigation > li.login-card-btn > a::before {
        display: none !important; /* Hide default underline effect */
    }
</style>
<hr style="border-bottom: 5px solid #fac800;margin-top: 0px;margin-bottom: 0px;border-top: 0px;">
    <div class="header-upper">
    	<div class="auto-container">
        	<div class="clearfix">
                <div class="upper-right clearfix">
                    <div class="nav-outer clearfix">
                        <nav class="main-menu">
                             <div class="logo pull-left">
                                <?php $getLogo = \App\Models\Logo::first(); ?>
                                <a href="{{ url('beranda') }}" class="img-responsive" title=""><img style="margin-top:5px;" src="{{ asset('upload/logo/'.$getLogo->gambar) }}"  alt="" title=""></a>
                            </div>
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix" style="float: right;">
                                    <li><a href="{{ url('beranda') }}">Beranda</a></li>
                                        <?php 
                                        $menutentang = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 1)->get();
                                        if ($menutentang->count() > 1): ?>
                                        <?php $header = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 1)->where('static',1)->first(); ?>
                                            <li class='dropdown'><a href="#">{{ $header->judul }}</a>
                                                <ul>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status_link = 'active' AND id_menu = 1 order by urut asc"); 
                                                        foreach($menutentangstatic as $key) { ?>
                                                        <?php if ($key->link != "static") { ?>
                                                            
                                                            <?php if($key->status == 0) { ?>
                                                                <li><a href="{{ url('Beranda/detaildata/'.$key->slug) }}">{{ $key->judul }}</a></li>
                                                            <?php } else { ?>
                                                                <li><a href="{{ url($key->link) }}">{{ $key->judul }}</a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status = 1 AND status_link = 'active' AND id_menu = 1 AND link != 'static'"); 
                                                        foreach($menutentangstatic as $key1) { ?>
                                                        <li><a href="{{ url($key1->link) }}">{{ $key1->judul }}</a></li>
                                                    <?php } ?>
                                        <?php endif ?>
                                        
                                        <?php 
                                        $menu2 = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 2)->get();
                                        if ($menu2->count() > 1): ?>
                                        <?php $header = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 2)->where('static',1)->first(); ?>
                                            <li class='dropdown'><a href="#">{{ $header->judul }}</a>
                                                <ul>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status_link = 'active' AND id_menu = 2 order by urut asc"); 
                                                        foreach($menutentangstatic as $key) { ?>
                                                        <?php if ($key->link != "static") { ?>
                                                            
                                                            <?php if($key->status == 0) { ?>
                                                                <li><a href="{{ url('Beranda/detaildata/'.$key->slug) }}">{{ $key->judul }}</a></li>
                                                            <?php } else { ?>
                                                                <li><a href="{{ url($key->link) }}">{{ $key->judul }}</a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status = 1 AND id_menu = 2 AND link != 'static'"); 
                                                foreach($menutentangstatic as $key1) { ?>
                                                <li><a href="{{ url($key1->link) }}">{{ $key1->judul }}</a></li>
                                            <?php } ?>
                                        <?php endif ?>
                                        
                                        <?php 
                                        $menu3 = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 3)->get();
                                        if ($menu3->count() > 1): ?>
                                        <?php $header = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 3)->where('static',1)->first(); ?>
                                            <li class='dropdown'><a href="#">{{ $header->judul }}</a>
                                                <ul>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status_link = 'active' AND id_menu = 3 order by urut asc"); 
                                                        foreach($menutentangstatic as $key) { ?>
                                                        <?php if ($key->link != "static") { ?>
                                                            
                                                            <?php if($key->status == 0) { ?>
                                                                <li><a href="{{ url('Beranda/detaildata/'.$key->slug) }}">{{ $key->judul }}</a></li>
                                                            <?php } else { ?>
                                                                <li><a href="{{ url($key->link) }}">{{ $key->judul }}</a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status = 1 AND status_link = 'active' AND id_menu = 3 AND link != 'static'"); 
                                                        foreach($menutentangstatic as $key1) { ?>
                                                        <li><a href="{{ url($key1->link) }}">{{ $key1->judul }}</a></li>
                                                    <?php } ?>
                                        <?php endif ?>
                                        
                                         <?php 
                                        $menu4 = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 4)->get();
                                        if ($menu4->count() > 1): ?>
                                        <?php $header = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 4)->where('static',1)->first(); ?>
                                            <li class='dropdown'><a href="#">{{ $header->judul }}</a>
                                                <ul>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status_link = 'active' AND id_menu = 4 order by urut asc"); 
                                                        foreach($menutentangstatic as $key) { ?>
                                                        <?php if ($key->link != "static") { ?>
                                                            
                                                            <?php if($key->status == 0) { ?>
                                                                <li><a href="{{ url('Beranda/detaildata/'.$key->slug) }}">{{ $key->judul }}</a></li>
                                                            <?php } else { ?>
                                                                <li><a href="{{ url($key->link) }}">{{ $key->judul }}</a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status = 1 AND status_link = 'active' AND id_menu = 4 AND link != 'static'"); 
                                                        foreach($menutentangstatic as $key1) { ?>
                                                        <li><a href="{{ url($key1->link) }}">{{ $key1->judul }}</a></li>
                                                    <?php } ?>
                                        <?php endif ?>
                                        
                                        <?php 
                                        $menu5 = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 5)->get();
                                        if ($menu5->count() > 1): ?>
                                        <?php $header = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 5)->where('static',1)->first(); ?>
                                            <li class='dropdown'><a href="#">{{ $header->judul }}</a>
                                                <ul>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status_link = 'active' AND id_menu = 5 order by urut asc"); 
                                                        foreach($menutentangstatic as $key) { ?>
                                                        <?php if ($key->link != "static") { ?>
                                                            
                                                            <?php if($key->status == 0) { ?>
                                                                <li><a href="{{ url('Beranda/detaildata/'.$key->slug) }}">{{ $key->judul }}</a></li>
                                                            <?php } else { ?>
                                                                <li><a href="{{ url($key->link) }}">{{ $key->judul }}</a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status = 1 AND status_link = 'active' AND id_menu = 5 AND link != 'static'"); 
                                                        foreach($menutentangstatic as $key1) { ?>
                                                        <li><a href="{{ url($key1->link) }}">{{ $key1->judul }}</a></li>
                                                    <?php } ?>
                                        <?php endif ?>
                                        
                                        <?php 
                                        if (!auth()->check()) {
                                        $menu6 = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 6)->get();
                                        if ($menu6->count() > 1): ?>
                                        <?php $header = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 6)->where('static',1)->first(); ?>
                                            <li class='dropdown'><a href="#">{{ $header->judul }}</a>
                                                <ul>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status_link = 'active' AND id_menu = 6 order by urut asc"); 
                                                        foreach($menutentangstatic as $key) { ?>
                                                        <?php if ($key->link != "static") { ?>
                                                            
                                                            <?php if($key->status == 0) { ?>
                                                                <li><a href="{{ url('Beranda/detaildata/'.$key->slug) }}">{{ $key->judul }}</a></li>
                                                            <?php } else { ?>
                                                                <li><a href="{{ url($key->link) }}">{{ $key->judul }}</a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status = 1 AND status_link = 'active' AND id_menu = 6 AND link != 'static'"); 
                                                        foreach($menutentangstatic as $key1) { ?>
                                                        <li class="login-card-btn"><a href="{{ url($key1->link) }}"><i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> {{ $key1->judul }}</a></li>
                                                    <?php } ?>
                                        <?php endif ?>
                                        <?php }else{ ?>
                                            <li class="login-card-btn"><a href="{{ url('permohonan') }}"><i class="fas fa-file-alt" style="margin-right: 8px;"></i> Permohonan</a></li>
                                            <li class="login-card-btn" style="margin-left: 5px;"><a href="{{ url('secure/logout') }}" style="background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%) !important; box-shadow: 0 4px 15px rgba(183, 28, 28, 0.25);"><i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> Logout</a></li>
                                        <?php } ?>
                                        
                                        <?php 
                                        $menu7 = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 7)->get();
                                        if ($menu7->count() > 1): ?>
                                        <?php $header = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 7)->where('static',1)->first(); ?>
                                            <li class='dropdown'><a href="#">{{ $header->judul }}</a>
                                                <ul>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status_link = 'active' AND id_menu = 7 order by urut asc"); 
                                                        foreach($menutentangstatic as $key) { ?>
                                                        <?php if ($key->link != "static") { ?>
                                                            
                                                            <?php if($key->status == 0) { ?>
                                                                <li><a href="{{ url('Beranda/detaildata/'.$key->slug) }}">{{ $key->judul }}</a></li>
                                                            <?php } else { ?>
                                                                <li><a href="{{ url($key->link) }}">{{ $key->judul }}</a></li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                                    <?php $menutentangstatic = \Illuminate\Support\Facades\DB::select("SELECT * FROM `menu` WHERE status = 1 AND status_link = 'active' AND id_menu = 7 AND link != 'static'"); 
                                                        foreach($menutentangstatic as $key1) { ?>
                                                        <li><a href="{{ url($key1->link) }}">{{ $key1->judul }}</a></li>
                                                    <?php } ?>
                                        <?php endif ?>
                                        
                                        <?php 
                                        $menu8 = \Illuminate\Support\Facades\DB::table('menu')->where('id_menu', 11)->where('status_link','active')->get();
                                        if ($menu8->count() > 0): ?>
                                                    <?php foreach($menu8 as $key1) { ?>
                                                        <li><a href="{{ url('Beranda/detaildata/'.$key1->slug) }}">{{ $key1->judul }}</a></li>
                                                    <?php } ?>
                                        <?php endif ?>
                                    </ul>
                                </div>
                               
                            </nav>
                            <!-- Main Menu End-->
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <!--End Header Upper-->
        





