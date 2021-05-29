	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
 @if(!empty($result['commonContent']['setting'][86]->value))
	<link rel="icon" type="image/png" href="{{asset('').$result['commonContent']['setting'][86]->value}}">
    @endif
	@section('header-meta')
    @if(!empty($result['commonContent']['setting'][72]->value))
    <title><?=stripslashes($result['commonContent']['setting'][72]->value)?></title>
    @else
    <title><?=stripslashes($result['commonContent']['setting'][18]->value)?></title>
    @endif

   
    <meta name="DC.title"  content="<?=stripslashes($result['commonContent']['setting'][73]->value)?>"/>
    <meta name="description" content="<?=stripslashes($result['commonContent']['setting'][75]->value)?>"/>
    <meta name="keywords" content="<?=stripslashes($result['commonContent']['setting'][74]->value)?>"/>
@show
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!-- Core CSS Files -->
	  <link rel="stylesheet" href="{{asset('web')}}/custom/assets/themes/fatafatsewa/vendor/owl-carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('web/css').'/'.$result['commonContent']['setting'][81]->value}}.css">

		<link rel="stylesheet" type="text/css" href="{{asset('web/css')}}/fatafat.css">
	<script src="{!! asset('web/js/app.js') !!}"></script>
	@if(Request::path() == 'checkout')
		<!--------- stripe js ------>
		<script src="https://js.stripe.com/v3/"></script>

		<link rel="stylesheet" type="text/css" href="{{asset('web/css/stripe.css') }}" data-rel-css="" />

		<!------- paypal ---------->
		<script src="https://www.paypalobjects.com/api/checkout.js"></script>
		<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

	@endif

	<!---- onesignal ------>
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	{{-- <script>
	var OneSignal = window.OneSignal || [];
	OneSignal.push(function() {
		OneSignal.init({
		appId: "{{$result['commonContent']['setting'][55]->value}}",
		notifyButton: {
			enable: true,
		},
		allowLocalhostAsSecureOrigin: true,
		});
	});

</script>	 --}}
<meta name="google-site-verification" content="d31M5BhL_YBCWhxpDfAYmT7BrHYFB6Bq0xv9HoUTXIQ" />
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-178008538-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-178008538-1');
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-129496918-7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-129496918-7');
</script>


<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KT5HXQH');</script>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KT5HXQH"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>



<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '3787784851260355');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=3787784851260355&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->

	

    @if(!empty($result['commonContent']['setting'][76]->value))
		<?=stripslashes($result['commonContent']['setting'][76]->value)?>
    @endif

	{{-- @if(request()->is('checkout'))
	@include('web.common.scripts.cellpay')

	@endif --}}