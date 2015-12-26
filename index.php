<!doctype html>
<html>
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Карта зони АТО по інформації РНБО України</title>
</head>
<body>
<!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter34162440 = new Ya.Metrika({ id:34162440, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/34162440" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
	<header class="header">
		<h1>Карта бойових дій в зоні АТО (Анти-терористичної операції)</h1>

		<div class="copyright">
			&copy;&nbsp;2015<?php $y=date('Y');$y!='2015'?'&mdash;'.$y:''?>, <a href="https://github.com/xainse/ato-map" target="_blank">@xainse</a>&nbsp;
			<a title="ІНФОРМАЦІЙНО-АНАЛІТИЧНИЙ ЦЕНТР - НАЦІОНАЛЬНОЇ БЕЗПЕКИ УКРАЇНИ" href="http://mediarnbo.org/" target="_blank">www.mediarnbo.org</a>
		</div>
	</header>
	<div class="header-placeholder"></div>
	<div class="conteiner" id="map-conteiner">

	</div>
<!-- Всі необхідні бібліотеки і скрипти -->
<!-- TODO Треба написати парсер, який буде кожен день стягувати нові картинки -->
	<link rel="stylesheet" type="text/css" href="/css/style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<script src="js/jquery-1.10.1.min.js"></script>
	<!-- <script src="js/jquery.mousewheel-3.0.6.pack.js"></script> -->
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.5"></script>
		
<script>
// Розширення класу "рядка", для використання як темплейту
String.prototype.supplant = function(o) {
    return this.replace(/{([^{}]*)}/g,
        function(a, b) {
            var r = o[b];
            return typeof r === 'string' || typeof r === 'number' ? r : a;
        }
    );
};

function prepareMap() {
	var options = {
		year: 'numeric',
		month: 'long',
		day: 'numeric',
		timezone: 'UTC'
	};

	var imgBaseUrl 	  =  window.location.href + 'img/photos/';
	var imgBigTplLink = '{base}big-{year}-{month}-{day}.jpg';
	var imgSmlTplLink = '{base}sml-{year}-{month}-{day}.jpg';
	var imgSmlTpl = '<a class="fancybox fancybox-button one-map" title="{description}" data-fancybox-group="gallery" href="{iBigLink}">'+
					'<img src="{imgLink}" width="{iW}" height="{iH}" alt="{description}" />'+
					'<span class="date-hint">{description}</span></a>';

	var startDay = new Date( 2014, 8, 12 ); // Дата коли можна знайти найпершу картинку із картою із зони АТО
//	var startDay = new Date( 2015, 12-1, 10 ); // Дата коли можна знайти найпершу картинку із картою із зони АТО

	var oneDay = 60*60*24*1000; // Кількість мілісекунд
	var toDay = new Date();
	var dayLeft = Math.round((toDay.getTime() - startDay.getTime())/oneDay); 

	var template = '';
	var img = [];
	var tmpUpload = [];
	
	for (var i=1; i<dayLeft; i++) {
//		var cklDate = new Date(startDay.getTime() + oneDay * i);
		var cklDate = new Date(toDay.getTime() - oneDay * i);
		var imgData = {
			'base' : imgBaseUrl, 
			'year' : cklDate.getFullYear(),
			'month': cklDate.getMonth()+1,
			'day'  : cklDate.getDate()
		};

		var d = imgData['month']+'/'+imgData['day']+'/'+imgData['year'];

		if (imgData['month'] != 0 && new Date(d) != 'Invalid Date') {
			imgData['day'] = imgData['day']<10?'0'+imgData['day']:imgData['day'];
			imgData['month'] = imgData['month']<10?'0'+imgData['month']:imgData['month'];

			var cklImgLinkBig = imgBigTplLink.supplant(imgData);
			var cklImgLinkSml = imgSmlTplLink.supplant(imgData);
			img[i]= imgSmlTpl.supplant({
				'iBigLink'	: cklImgLinkBig,
				'imgLink'	: cklImgLinkSml,
				'iW'		: 300,
				'iH'		: 249,
				'description' : cklDate.toLocaleString("uk", options)
			});

			var immg = new Image();
			immg.onload = function(){

			};
			immg.onerror = function(){
				img[i] = '';
			};
			immg.src = cklImgLinkSml;
			tmpUpload[i] = immg;
		}
	}
	img = img.join('');
	$("#map-conteiner").append(img);
}

$(function(){
	prepareMap();
	$(".fancybox-button").fancybox({
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: true,
		titleShow		: true,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});	
});
wln = function(vr) {
	vr = vr?vr:'ok';
	console.log(vr);
}
</script>

</body>
</html>
	