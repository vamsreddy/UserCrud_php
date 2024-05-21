<!DOCTYPE html>
<html>
<head> 
	<!--<link type="image/x-icon" rel="icon" href="images/icon.ico">-->
	<meta charset="utf-8" />	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<script>
	document.createElement("header");	
	document.createElement("nav");
	document.createElement("footer");
	document.createElement("section")
</script>
<style>
*{ margin:0; padding:0}
html, body{width:100%; min-height:100%;}
a{ text-decoration:none;}
li{ list-style-type:none;}
img{border:0;}
@font-face {
	font-family: 'Conv_BPG DejaVu Sans ExtraLight 2012';
	src: url('fonts/BPG DejaVu Sans ExtraLight 2012.eot');
	src: local('☺'), url('fonts/BPG DejaVu Sans ExtraLight 2012.ttf') format('truetype'), url('../fonts/BPG DejaVu Sans ExtraLight 2012.svg') format('svg');
	font-weight: normal;
	font-style: normal;
}
@font-face {
	font-family: 'Conv_BPG DejaVu Sans ExtraLight Caps 2012';
	src: url('fonts/BPG DejaVu Sans ExtraLight Caps 2012.eot');
	src: local('☺'), url('fonts/BPG DejaVu Sans ExtraLight Caps 2012.ttf') format('truetype'), url('../fonts/BPG DejaVu Sans ExtraLight Caps 2012.svg') format('svg');
	font-weight: normal;
	font-style: normal;
}

/*main css*/
#wrapper{
	width:92%;
	max-width:600px;
	padding:29px 4% 10px 4%;
	background:#1c75d7 url(../images/corner.png) no-repeat right bottom;
	background-size:auto 100%;
	margin:50px auto;	
}
#maincContent{
	-webkit-box-shadow: 0px 0px 4px 2px rgba(0,0,0,0.24);
	-moz-box-shadow: 0px 0px 4px 2px rgba(0,0,0,0.24);
	box-shadow: 0px 0px 4px 2px rgba(0,0,0,0.24);
	background-color:#fff;
	margin-bottom:13px;
	position:relative;
	clear:both;
	overflow:hidden;
	border-bottom-right-radius:40px;
}
#head{
	width:92%;
	max-width:550px;
	margin:25px auto;
}
#head h1{
	width:94px;
	height:47px;
	margin:25px 5.45%; 

}
#head h1 a{
	display:block;
	text-indent:-9999px;
	width:100%;
	height:100%;
	background: url(../images/logo.png) no-repeat center center;	
}
#content{
	width:92%;
	max-width:550px;
	margin:25px auto;
}
#content h2{
	color:#5c5c5c;
	font-size:15px;	
	margin-bottom:20px;
	font-family: 'Conv_BPG DejaVu Sans ExtraLight 2012';
	margin:0px 5.45% 25px 5.45%; 
}
#content .parpagraph{
	color:#5c5c5c;
	font-size:15px;	
	margin-bottom:20px;
	font-family: 'Conv_BPG DejaVu Sans ExtraLight 2012';
	font-weight:600;
	margin:0px 5.45% 25px 5.45%;
}
#content .parpagraphGreen{
	color:#86b817;
	font-size:14px;	
	margin-bottom:20px;
	font-family: 'Conv_BPG DejaVu Sans ExtraLight Caps 2012';
	font-weight:600;
	margin:0px 5.45% 44px 5.45%;
}
#content img{
	display:block;
	margin:0px 5.45% 60px 5.45%;	
}
#maincContent::after {
    content: "";
  position: absolute;
  z-index:2;
  bottom: 0;
  right: 0%;
  width: 0px;
  height: 0px;
  border-top:35px solid #dbdbdb;
  border-right: 35px solid #dbdbdb;
#footer{
	width:92%;
	max-width:550px;
	margin:0 auto;
}
#footer ul{
	margin-left:7%;
	overflow:hidden;	
}
#footer ul li{
	display:inline-block;
	float:left;
	width:	31px;
	height:35px;
	margin-right:2%;
}
#footer ul li a{
	display:block;
	width:100%;
	height:100%;
	text-indent:-9999px;	
	margin-bottom:8px;
}
#footer ul li a.mail{
	background:url(../images/mail.png) no-repeat center center;
}
#footer ul li a.fb{
	background:url(../images/fb.png) no-repeat center center;
}
#footer ul li a.link{
	background:url(../images/link.png) no-repeat center center;
}
</style>
</head>
<body>
	<section id="wrapper"><!--id="wrapper"-->
    	<section id="maincContent"><!--id="maincContent"-->
        	<header id="head"><!--header-->
        		<h1><a href="index.html" target="_blank"> </a></h1>           
        	</header><!--End of header-->
        	<section id="content"><!--id="content"-->
                <h1>Welcome, {{ $user->name }}!</h1><br>
                <h2><p>Thank you for joining our website. We're excited to have you as a member of our community.</p>

                    <p>Here's the link to your details: <a href="{{ route('show') }}">Profile</a></p>
                    
                    <p>If you have any questions or need assistance, please feel free to reach out to our support team.</p>
                    
                    <p>Enjoy exploring our website and have a great day!</p></h2>
                <div class="parpagraph">
                    <p>Best regards,</p>
                    <p>Your Website Team  {{$user->email}} </p>     
        </footer><!--End of id="footer"-->
    </section><!--End of id="wrapper"-->
</body>
</html>
