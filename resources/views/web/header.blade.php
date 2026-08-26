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
                                        // Ambil semua parent menu aktif (sub_menu = 0) kecuali ID 6 (Daftar/Login)
                                        $parents = \Illuminate\Support\Facades\DB::table('menu')
                                            ->where('sub_menu', 0)
                                            ->where('status_link', 'active')
                                            ->where('id', '!=', 6)
                                            ->orderBy('urut', 'asc')
                                            ->get();

                                        foreach($parents as $parent): 
                                            // Cek apakah parent ini memiliki children
                                            $children = \Illuminate\Support\Facades\DB::table('menu')
                                                ->where('id_menu', $parent->id)
                                                ->where('sub_menu', 1)
                                                ->where('status_link', 'active')
                                                ->orderBy('urut', 'asc')
                                                ->get();
                                                
                                            if($children->count() > 0): ?>
                                                <li class='dropdown'><a href="#">{{ $parent->judul }}</a>
                                                    <ul>
                                                        <?php foreach($children as $child): ?>
                                                            <?php if($child->link != 'static'): ?>
                                                                <li><a href="{{ url($child->link) }}">{{ $child->judul }}</a></li>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <?php if($parent->link != 'static'): ?>
                                                    <li><a href="{{ url($parent->link) }}">{{ $parent->judul }}</a></li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                        <?php 
                                        // Menu Auth Khusus
                                        if (!auth()->check()) {
                                            $loginMenu = \Illuminate\Support\Facades\DB::table('menu')->where('id', 6)->where('status_link', 'active')->first();
                                            if ($loginMenu) {
                                                // Cek jika Login punya dropdown (jarang, tapi ditangani agar aman)
                                                $loginChildren = \Illuminate\Support\Facades\DB::table('menu')
                                                    ->where('id_menu', 6)->where('sub_menu', 1)->where('status_link', 'active')->get();
                                                if ($loginChildren->count() > 0) { ?>
                                                    <li class='dropdown login-card-btn'><a href="#"><i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> {{ $loginMenu->judul }}</a>
                                                        <ul>
                                                            <?php foreach($loginChildren as $child): ?>
                                                                <?php if($child->link != 'static'): ?>
                                                                    <li><a href="{{ url($child->link) }}">{{ $child->judul }}</a></li>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="login-card-btn"><a href="{{ url($loginMenu->link) }}"><i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> {{ $loginMenu->judul }}</a></li>
                                                <?php }
                                            }
                                        } else { ?>
                                            <li class="login-card-btn"><a href="{{ url('permohonan') }}"><i class="fas fa-file-alt" style="margin-right: 8px;"></i> Permohonan</a></li>
                                            <li class="login-card-btn" style="margin-left: 5px;"><a href="{{ url('secure/logout') }}" style="background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%) !important; box-shadow: 0 4px 15px rgba(183, 28, 28, 0.25);"><i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> Logout</a></li>
                                        <?php } ?>
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
        





