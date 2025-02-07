<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Deal Ocean | eCommerce</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="{{asset('img/favicon.ico')}}" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('assets_front/css/bootstrap.min.cs')}}s"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/flaticon.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/slicknav.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/jquery-ui.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/owl.carousel.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/animate.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets_front/css/style.css')}}"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
    <!-- Start Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
    </div>
    <!-- End Page Preloder -->

    <div style="text-align: center">
        <x-alert/>
    </div>

    <!-- Start Header -->
    @include('partials_front._header')
    <!-- End Header -->




    <!-- Start Main Content -->
    @yield('content')
    <!-- End Main Content -->



    <!-- Start Footer -->
    @include('partials_front._footer')
    <!-- End Footer -->



	<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('assets_front/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets_front/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets_front/js/jquery.slicknav.min.js')}}"></script>
	<script src="{{asset('assets_front/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets_front/js/jquery.nicescroll.min.js')}}"></script>
	<script src="{{asset('assets_front/js/jquery.zoom.min.js')}}"></script>
	<script src="{{asset('assets_front/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets_front/js/main.js')}}"></script>



<!--==== Start For Dynamic Dependent Dropdown ====-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.RegionAjax',function(){
            var region_id=$(this).val();

            var div=$(this).parent();

            var op=" ";
            $.ajax({
                type:'get',
                url:"{{ route('countryListRoute') }}",
                data:{'id':region_id},
                success:function(data){
                    op+='<option value="0" selected disabled>Choose Country</option>';
                    for(var i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    }

                    div.find('.CountryAjax').html(" ");
                   div.find('.CountryAjax').append(op);
                },
                error:function(){
                }
            });
        });
    });
</script>
<!--==== End For Dynamic Dependent Dropdown ====-->


<!--==== Start Rating in Product ====-->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".p-rating a", function(e) {
            e.preventDefault();
            var el = $(this);
            var value = el.data("value");
            $.ajax({
                type: "get",
                url: "{{ route('ajaxReview.rating') }}",
                data: { id: value },
                success: function(data) {
                    console.log(data);
                    $(".userRATINGajax").text(data[0]);
                    $(".RATINGajax").text(data[2]);
                    $count = $(".COUNTajax").text();
                    $sum = parseInt($count[0]) + parseInt(data[1]);
                    console.log($sum);
                    $(".COUNTajax").html(" ");
                    $(".COUNTajax").text(" ");
                    $(".COUNTajax").text($sum+" users");
                },
                error: function() {}
            });
        });
    });
</script>
<!--==== End Rating in Product ====-->


<!---- ==== Start Dynamic Cart Item Count =======----->
<script type="text/javascript">
    $(document).ready(function(){
    let x;
    <?php

         $AJAXproducts = $products ?? [];

         $maxP = count($AJAXproducts);
         for($i = 0;$i<$maxP;$i++)
         { ?>

            $('#successMSG<?= $i; ?>').hide();   //

            $('#addCart<?= $i; ?>').click(function() {
                x = pro_id<?= $i;?> = $('#pro_id<?= $i;?>').val();
                var ID = x;
                $.ajax({
                    type:'get',
                    data:{'id':ID},
                    url:"{{ route('ajaxcart.add') }}",
                    success:function(data){
                        $('.itemCountAjax').text(data);
                        $('#addCart<?= $i; ?>').hide();
                        $('#successMSG<?= $i; ?>').show();
                        $('#successMSG<?= $i; ?>').append('Added to Cart!');
                    },
                    error:function(){
                    }
                });
            });
    <?php } ?>
    });
</script>
<!---- ==== End Dynamic Cart Item Count =======----->

</body>
</html>
