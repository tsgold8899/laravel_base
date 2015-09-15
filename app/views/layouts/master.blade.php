<!doctype>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <title>XXXXXX</title>
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        
        <!-- CSS are place here -->
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/default.css') }}
        {{ HTML::style('css/validationEngine.jquery.css') }}
        
        <!-- Scrips are placed here -->
        {{ HTML::script('js/jquery-1.7.1.min.js') }} 
        <!-- {{ HTML::script('js/jquery-1.10.2.js') }} -->
        {{ HTML::script('js/jquery-ui-1.10.4.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/jquery.validationEngine.js') }}
        {{ HTML::script('js/jquery.validationEngine-en.js') }}
        
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-5145789-1', 'XXXXXX.com');
          ga('send', 'pageview');
        </script>
    </head>
    <body>
        <!-- Container -->
        <div class="container">
            <!-- Content -->
            @yield('content')
            
            <!-- Footer -->
            <div style="margin:50px 0px 0px 0px; line-height:50px; text-align:center;">
                 <span style="color:#666;">&copy; 2014 XXXXXX </span><a href="{{ url('terms') }}" target="_blank">Terms</a> | <a href="{{ url('privacy') }}" target="_blank">Privacy</a>
            </div>
        </div>
    </body>
</html>