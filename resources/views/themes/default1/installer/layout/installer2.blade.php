<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Faveo HELPDESK</title>
        <link rel="shortcut icon" href="{{asset("lb-Faveo/media/images/favicon.ico")}}">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="{{asset("lb-Faveo/css/load-styles.css")}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset("lb-Faveo/css/css.css")}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset("lb-Faveo/css/admin.css")}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset("lb-Faveo/css/wc-setup.css")}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset("lb-Faveo/css/activation.css")}}" type="text/css" media="all">
        <link rel="stylesheet" href="{{asset("lb-Faveo/css/style.css")}}" type="text/css" media="all">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="{{asset("lb-Faveo/css/ggpopover.css")}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset("lb-Faveo/css/prism.css")}}">
        <link rel="stylesheet" href="{{asset("lb-Faveo/css/chosen.css")}}">
    </head>
    <body class="wc-setup wp-core-ui">
        <center><h1 id="wc-logo"><a href="http://www.Faveohelpdesk.com">
            <img src="{{asset("lb-Faveo/media/installer/Faveo.png")}}" alt="Faveo" width="
            250px"></a></h1></center>
   
    <div class="wc-setup-content">
        @yield('content')
    </div>
    
    
    <p style="text-align: center;"> Copyright &copy; 2015 - <?php echo date('Y')?> · Ladybird Web Solution Pvt Ltd. All Rights Reserved. Powered by <a target="_blank" href="http://www.Faveohelpdesk.com">Faveo </a></p>
    


    
    <script src="{{asset("lb-Faveo/js/ggpopover.js")}}"></script>
    <script type="text/javascript">
        $('[data-toggle="popover"]').ggpopover();
    </script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script> -->
    <script src="{{asset("lb-Faveo/js/chosen.jquery.js")}}" type="text/javascript"></script>
    <script src="{{asset("lb-Faveo/js/prism.js")}}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        var config = {
            '.chosen-select': {},
            '.chosen-select-deselect': {
                allow_single_deselect: true
            },
            '.chosen-select-no-single': {
                disable_search_threshold: 10
            },
            '.chosen-select-no-results': {
                no_results_text: 'Oops, nothing found!'
            },
            '.chosen-select-width': {
                width: "95%"
            }
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    </script>
    </body>
</html>