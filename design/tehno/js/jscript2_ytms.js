(function($,undefined){
	var _TMS=window._TMS=$.fn._TMS=function(_){
		_=_||{}
		_.holder=this
		;(_=$.extend(clone(_TMS),_TMS.presets[_.preset],_)).init()
		_.holder.data({opt:_})
		return _.holder
	},timer
	
	$.extend(_TMS,{
		show:false,
		nameMask:false,
		preload:false,
		pagination:false,
		pagNums:false,
		nextBu:false,
		prevBu:false,
		playBu:false,
		slideShow:false,
		reverseWay:false,
		progressBar:false,
		banners:false,
		progCSS:{width:'100%',height:'4px',background:'#f00',position:'absolute',top:0,opacity:.7,zIndex:999},
		duration:5000,
		interval:100,
		easing:'',
		overflow:'hidden',
		pagCl:'pagination',
		pic:'pic',
		pagCurrCl:'current',
		pauseCl:'paused',
		bannerCl:'banner',
		pagEv:'click',
		prevNextEv:'click',
		bl:false,
		bannerMeth:'fade',
		bannerDurr:400,
		bannerEasing:'',
		way:'lines',
		anim:'fade',
		preset:'simpleFade',
		blocksX:1,
		blocksY:1,
		picCSS:{
			position:'relative',
			overflow:'hidden',
			zIndex:0							
		},
			maskCSS:{
			position:'absolute',
			zIndex:0,
			left:0,
			top:0,
			width:'100%',
			height:'100%'							
		},
		beforeAnimation:function(){},
		afterAnimation:function(){},
		bannersFu:function(){
			var _=this,
				banners=_.banners=[]
			$('li',_.holder).each(function(){
				banners.push($('.'+_.bannerCl,this))
			})
		},
		bannerShowFu:function(n){
			var _=this
			if(_.bannerMeth=='custom')
				_.banner=_.banners[n]
					.appendTo(_.holder)
			if(_.bannerMeth=='fade'&&_.banners.length)
				_.banners[n]
					.appendTo(_.holder)
					.hide()
					.fadeIn()
			if(_.bannerMeth=='slide'){
				var b=_.banners[n],
					to,from,tmp
				b.appendTo(_.holder)							
				to=((tmp=b.data('to'))?tmp:(b.data({to:(tmp={left:b.attr('offsetLeft'),top:b.attr('offsetTop')})})),tmp)
				b.addClass('from')
				from=((tmp=b.data('from'))?tmp:(b.data({from:(tmp={left:b.attr('offsetLeft'),top:b.attr('offsetTop')})})),tmp)
				b.removeClass('from')							
				b.css(from).stop().animate(to,{
										   duration:+_.bannerDurr,
										   easing:_.bannerEasing
									   		})
			}
		},
		afterShow:function(){
			var _=this
			if(_.playBlock)
				_.bl=false
			_.pic.css({backgroundImage:'url('+_.next+')'})
			_.maskC.hide()
			if(_.banners)
				_.bannerShowFu(_.current)
			_.afterAnimation(_.banner=($(_.banners).detach(),_.banners[_.current]))
		},
		progFu:function(fu){
			var _=this,
				w=fu?_.progressBar.width():'0px',
				wi=_.progressBar.data('w'),
				time=fu?(wi-w)/wi*_.slideShow:_.slideShow
 				_.progressBar
					.width(w)
					.stop()
					.animate({width:wi},time,'linear',function(){
						_.progressBar.width(0)
						if(fu)setTimeout(fu,1)
					})
		},
		preFu:function(){
			var _=this,
				img
			if(_.show!==false&&_.itms)
				img=($.browser.msie&&$.browser.version<9)?$('<img src="'+_.itms[_.show]+'" />').appendTo(_.pic):$('<img>').attr('src',_.itms[_.show]).appendTo(_.pic),
				_.pags.eq(_.show).addClass(_.pagCurrCl),
				_.banners?_.bannerShowFu(_.show):void(0)
			_.holder.css({overflow:_.overflow})
			img.load(function(){							
				if(_.holder.css('position')=='static')
					_.holder.css({position:'relative',zIndex:1})
							  
					if(_.progressBar===true)
						_.progressBar=$('<div>').css(_.progCSS).appendTo(_.holder)
					else
						_.progressBar=$(_.progressBar)
			_.progressBar.data({w:_.progressBar.width()})
			if(_.slideShow)
				_.progFu(),
				timer=setInterval(function(){
					_.nextFu()
				},_.slideShow)
						
				_.pic.css(_.picCSS)
				_.pic.css({
					width:img.width(),
					height:img.height(),
					background:'url('+img.attr('src')+') 0 0 no-repeat'
				})
			
				img.remove()
				_.current=_.buff=_.show
				_.mask
					.css(_.maskCSS)
					.appendTo(_.pic)
			})
		},
		nextFu:function(){
			var _=this
			if(++_.current<_.itms.length)
				_.changeFu(_.current)
			else
				_.buff=-1,
				_.changeFu(0)
		},
		prevFu:function(){
			var _=this
			if(--_.current>=0)
				_.changeFu(_.current)
			else
				_.buff=_.itms.length,
				_.changeFu(_.itms.length-1)
		},
		sliceFu:function(w,h){
			var _=this,
				eW=parseInt(_.pic.width()/w),
				eH=parseInt(_.pic.height()/h),
				etal=$('<div>'),
				fW=_.pic.width()-eW*w,
				fH=_.pic.height()-eH*h,
				x,y,
				matrix=_.matrix=[]
			_.mask.empty()
			for(y=0;y<h;y++)
				for(x=0;x<w;x++)
					matrix[y]=matrix[y]?matrix[y]:[],
					matrix[y][x]=etal.clone()
						.appendTo(_.mask)
						.css({
							 left:x*eW,
							 top:y*eH,
							 position:'absolute',
							 width:x==w-1?eW+fW:eW,
							 height:y==h-1?eH+fH:eH,
							 backgroundPosition:'-'+x*eW+'px -'+y*eH+'px',
							 display:'none'
						 })
			_.maskC=_.mask.find('>div')
		},
		showFu:function(){
			var _=this,
				way,
				tmp,
				fu=			
			function(){			
			way=_.ways[_.way].call(_)
			if(_.reverseWay)
				way.reverse()
			if(_.int)
				clearInterval(_.int)
			_.int=setInterval(function(){
				if(way.length)
					_.anims[_.anim].apply(_,[way.shift(),!way.length])
				else
					clearInterval(_.int)
			},_.interval)
			}
			if(_.bannerMeth!='custom')
				$(_.banners).each(function(){$(this).detach()})
			_.beforeAnimation(_.banner)
			if(_.banner.length)
				tmp=_.banner.css('opacity'),
				_.banner.animate({opacity:tmp},1,fu)
			else
				fu()
		},
		changeFu:function(n){
			var _=this
			if(_.preset_!=_.preset)
				$.extend(_,_TMS.presets[_.preset]),
				_.preset_=_.preset
			if(_.maskC)
				_.pic.css({backgroundImage:'url('+_.next+')'}),
				_.maskC.stop()
			_.next=_.itms[n]
			_.direction=n-_.buff
			_.current=_.buff=n
			_.pagChangeFu(n)
			_.sliceFu(_.blocksX,_.blocksY)
			_.maskC.css({backgroundImage:'url('+_.next+')'})
			if(_.playBlock)
				_.bl=true
			_.showFu()
			clearInterval(timer)
			if(_.slideShow&&!_.paused)
				_.progFu(),
				timer=setInterval(function(){
					_.nextFu()
				},_.slideShow)
		},
		pagChangeFu:function(n){
			var _=this
			_.pags.removeClass(_.pagCurrCl)
			_.pags.eq(n).addClass(_.pagCurrCl)
		},
		pagFu:function(){
			var _=this,
				pags=_.pags=
					(_.pagination===true)
						?(function(){
							var ret=$('<ul>').addClass(_.pagCl)
							$(_.itms).each(function(i){
								ret.append('<li><a href="#">'+(_.pagNums?i+1:'')+'</a></li>')
							})
							ret.appendTo(_.holder)
							return $('>li',ret)
						})()
						:$(_.pagination)
			pags
				.each(function(i){
					$(this).data({num:i})
				})
				.parent()
					.delegate('li>a',_.pagEv,function(){
						var th=$(this),
							n=th.parent().data('num')
						if(n==_.current||_.bl)
							return false
						//pags.removeClass(_.pagCurrCl)
						//pags.eq(n).addClass(_.pagCurrCl)
						_.changeFu(n)
						return false
					})
		},
		preloadFu:function(){
			var _=this
			$(_.itms).each(function(){
				var i=new Image()
				i.src=this
			})			
		},
		nameMaskFu:function(){
			var _=this,
				tmp,i,ret=[]
			if(_.nameMask.indexOf(','))
				tmp=_.nameMask.split(',')
			if(tmp[1].indexOf('-'))
				tmp[2]=tmp[1].split('-'),
				tmp[1]=tmp[2].shift()
			for(i=tmp[1];i<=tmp[2];i++)
				ret.push(tmp[0].replace('*',i))
			_.itms=ret
			$(_.items,_.holder).hide()
		},
		parseImgFu:function(){
			var _=this,
				items=$(_.items+' img',_.holder),
				itms=_.itms=[]
			$(_.items,_.holder).hide()
			items.each(function(){
				itms.push($(this).attr('src'))
			})
		},
		init:function(){
			var _=this,
				pic=_.pic=$('<div>').addClass(_.pic).appendTo(_.holder),
				mask=_.mask=$('<div>')
			
			if(_.nameMask)
				_.nameMaskFu()
			else
				_.parseImgFu()
				
			if(_.preload)
				_.preloadFu()
				
			if(_.pagination)
				_.pagFu()
			
			if(_.banners)
				_.bannersFu()
				
			_.preFu()
			
			if(_.prevBu)
				$(_.prevBu).bind(_.prevNextEv,function(){
					if(_.bl)
						return false
					else
						_.prevFu()
					return false
				})
			if(_.nextBu)
				$(_.nextBu).bind(_.prevNextEv,function(){
					if(_.bl)
						return false
					else
						_.nextFu()
					return false
				})
			if(_.playBu)
				$(_.playBu).bind('click',function(){
					_.paused=_.paused?false:true
					if(!_.paused)						
						$(this).removeClass(_.pauseCl),
						_.progFu(function(){
											_.nextFu()
									})
					else
						$(this).addClass(_.pauseCl),						
						clearInterval(timer),
						_.progressBar.stop()
					return false
				})
			if(_.playBlock)
				_.bl=false
				
			_.preset_=_.preset
		}
	})
})(jQuery)
	
function clone(obj){
	if(!obj||typeof obj!=typeof {})
		return obj
	if(obj instanceof Array)
		return [].concat(obj)
	var tmp=new obj.constructor(),
		i
	for(i in obj)
		if(obj.hasOwnProperty(i))
			tmp[i]=clone(obj[i])
	return tmp
}