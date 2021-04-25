<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Travel & Tours - @yield('page_title', 'Default Title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

		<!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/jasny-bootstrap.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}"  type="text/css">

        <link rel="stylesheet" href="{{ asset('assets/css/material-kit.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/fonts/themify-icons.css') }}"  type="text/css">

        <link rel="stylesheet" href="{{ asset('assets/extras/animate.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/extras/owl.carousel.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/extras/owl.theme.css') }}"  type="text/css">

        <link rel="stylesheet" href="{{ asset('assets/extras/settings.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css') }}"  type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"  type="text/css">

        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/colors/yellow.css') }}"  media="screen" >
   </head>

   <body>
          <!-- Header Section Start -->
          <div class="header">    
            <div class="logo-menu">
              <nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
                <div class="container">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand logo" href="{{ route('careers.prev_index') }}"><img width="80px" src="{{ asset('skin11r.header-logo-regular.jpg') }}" alt=""></a>
                  </div>
                  <div class="collapse navbar-collapse" id="navbar">              
                     <!-- Start Navigation List -->
                    <ul class="nav navbar-nav">
                      <li>
                        <a href="{{ route('careers.prev_index') }}">
                        Home 
                        </a>
                      </li>
                      
                    </ul>
                  </div>
                </div>
                <!-- Mobile Menu Start -->
                <ul class="wpb-mobile-menu">
                  <li>
                    <a href="{{ route('careers.prev_index') }}">Home</a>
                  </li>
                 
                </ul>
                <!-- Mobile Menu End --> 
              </nav>
    
          </div>
             
          
          @yield('content')
    
          <!-- Footer Section Start -->
          <footer>
            <!-- Footer Area Start -->
            <section class="footer-Content">
              <div class="container">
                <div class="row">
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                      <h3 class="block-title"><img src="assets/img/logo.png" class="img-responsive" alt="Footer Logo"></h3>
                      <div class="textwidget">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque lobortis tincidunt est, et euismod purus suscipit quis. Etiam euismod ornare elementum. Sed ex est, consectetur eget facilisis sed, auctor ut purus.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                      <h3 class="block-title">Quick Links</h3>
                      <ul class="menu">
                        
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                      <h3 class="block-title">Lorem</h3>
                      <ul class="menu">
                        
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                      <h3 class="block-title">Follow Us</h3>
                      <div class="bottom-social-icons social-icon">  
                        <a class="twitter" href="#"><i class="ti-twitter-alt"></i></a>
                        <a class="facebook" href="#"><i class="ti-facebook"></i></a>                   
                        <a class="youtube" href="#"><i class="ti-youtube"></i></a>
                        <a class="dribble" href="#"><i class="ti-dribbble"></i></a>
                        <a class="linkedin" href="#"><i class="ti-linkedin"></i></a>
                      </div>   
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!-- Footer area End -->
            
            <!-- Copyright Start  -->
            <div id="copyright">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                   Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a> 
                  </div>
                </div>
              </div>
            </div>
            <!-- Copyright End -->
    
          </footer>
          <!-- Footer Section End -->  
          
          <!-- Go To Top Link -->
          <a href="#" class="back-to-top">
            <i class="ti-arrow-up"></i>
          </a>
            
          <div id="loading">
            <div id="loading-center">
              <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
                <div class="object" id="object_five"></div>
                <div class="object" id="object_six"></div>
                <div class="object" id="object_seven"></div>
                <div class="object" id="object_eight"></div>
              </div>
            </div>
          </div>
            
  
  
	
        <script type="text/javascript" src="{{ asset('assets/js/jquery-min.js') }}"></script>      
        <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>    
        <script type="text/javascript" src="{{ asset('assets/js/material.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/material-kit.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.parallax.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/waypoints.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jasny-bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/form-validator.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/contact-form-script.js') }}"></script>    
        <script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.tools.min.js') }}"></script>
          @yield('script')
    </body>
</html>
