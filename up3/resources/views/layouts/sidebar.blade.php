<aside class="main-sidebar" style="background-color: black">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" >

        

        <!-- search form (Optional) -->
        
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            
            <!-- Optionally, you can add icons to the links -->
            
            <li class=""><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            @if(Auth::user()->level == 'admin')

            <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> <span>Akun</span></a></li>
            <li class=""><a href="{{ route('distribusies.index') }}"><i class="fa fa-folder"></i> <span>Distribusi</span></a></li>
            <li class=""><a href="{{ route('rkapDist.index') }}"><i class="fa fa-industry"></i> <span>RKAP Distribusi</span></a></li>
            <li class=""><a href="{{ route('penetapanDist.index') }}"><i class="fa fa-industry"></i> <span>Penetapan Distribusi</span></a></li>
            <li class=""><a href="{{ route('spbDist.index') }}"><i class="fa fa-industry"></i> <span>SPB Distribusi</span></a></li>
            <li class=""><a href="{{ route('pabrikans.index') }}"><i class="fa fa-industry"></i> <span>Pabrikan</span></a></li>
            <li class=""><a href="{{ route('prks.index') }}"><i class="fa fa-industry"></i> <span>No. PRK</span></a></li>
            <li class=""><a href="{{ route('spbs.index') }}"><i class="fa fa-industry"></i> <span>No. SPB</span></a></li>
            <li class=""><a href="{{ route('niagas.index') }}"><i class="fa fa-folder-o"></i> <span>Niaga</span></a></li>
            <li class=""><a href="{{ route('rkapNiaga.index') }}"><i class="fa fa-industry"></i> <span>RKAP Niaga</span></a></li>
            @endif
        
            
         
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
