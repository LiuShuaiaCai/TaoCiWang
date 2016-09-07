<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>淘瓷网_首页</title>
	
	 <link rel="shortcut icon" type="image/x-icon" href="http://www.redroses1960.com../images/favicon.ico">
    <link href="/xiangmu/TaoCiWang/Public/Home/css/homestyle.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/xiangmu/TaoCiWang/Public/Home/css/page.css">
	
    <script src="/xiangmu/TaoCiWang/Public/Home/js/jquery-1.7.1.js"></script>
    <script src="/xiangmu/TaoCiWang/Public/Home/js/jquery.superslide.2.1.1.js"></script>
    <script src="/xiangmu/TaoCiWang/Public/Home/js/pptBox.js"></script>
    <script src="/xiangmu/TaoCiWang/Public/Home/js/layer.min.js"></script>
    <link rel="stylesheet" href="/xiangmu/TaoCiWang/Public/Home/css/layer.css" id="layui_layer_skinlayercss">


<!--QQ第三方登录-->
    
<!--QQ第三方登录 结束-->
<!--新浪微博 开始-->
<script src="/xiangmu/TaoCiWang/Public/Home/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script charset="UTF-8" src="/xiangmu/TaoCiWang/Public/Home/images/query"></script>
<!--新浪微博 结束-->

<script type="text/javascript">
    $(function ()
    {
        $('.z_weixin2').each(function () {
            var distance = 10;
            var time = 250;
            var hideDelay = 500;
            var hideDelayTimer = null;
            var beingShown = false;
            var shown = false;
            var trigger = $('.trigger2', this);
            var info = $('.z_ewm2', this).css('opacity', 0);
            $([trigger.get(0), info.get(0)]).mouseover(function () {
                if (hideDelayTimer) clearTimeout(hideDelayTimer);
                if (beingShown || shown) {
                    // don't trigger the animation again
                    return;
                } else {
                    // reset position of info box
                    beingShown = true;

                    info.css({
                        top: 39,
                        left: -25,
                        display: 'block'
                    }).animate({
                        top: '-=' + distance + 'px',
                        opacity: 1
                    }, time, 'swing', function () {
                        beingShown = false;
                        shown = true;
                    });
                }

                return false;
            }).mouseout(function () {
                if (hideDelayTimer) clearTimeout(hideDelayTimer);
                hideDelayTimer = setTimeout(function () {
                    hideDelayTimer = null;
                    info.animate({
                        top: '-=' + distance + 'px',
                        opacity: 0
                    }, time, 'swing', function () {
                        shown = false;
                        info.css('display', 'none');
                    });

                }, hideDelay);

                return false;
            });
        });
    });

    var _master = {
        Logout:function(){},  //退出登录
        //
        SearchBy:"",  
        SearchText:"",  //搜索文本
        masterSearText:$(),
        searchClick: function () { }
    };

    _master.Logout = function ()
    {
        /*
        if (QC.Login.check())
        {
            QC.Login.signOut();  //退出QQ登录
        }
        if (WB2.checkLogin())
        {
            WB2.logout();  //退出新浪微博
        }
        */
        window.location.href="/Home/Logout";
    };

    $(function ()
    {
        //登录信息
        _master.SearTextBox = $("#masterSearText");
        //如果是
        if (_master.SearchBy == "Master")
        {
            _master.SearTextBox.val(_master.SearchText);
            _master.SearTextBox.focus();
            _master.SearTextBox.select();
        }

        _master.SearTextBox.keydown(function ()
        {
            document.onkeydown = function mykeyDown(e)
            {
                e = e || event;
                if (e.keyCode == 13) { _master.searchClick(); }
                return;
            }
        });

    });
    _master.searchClick = function ()
    {
        var txt = $.trim(_master.SearTextBox.val());
        if (txt == "")
        {

            layer.tips("搜索关键字不能为空", _master.SearTextBox);
            _master.SearTextBox.focus();
        }
        else
        {
            window.location.href = "/Home/GoodsList?SearchBy=Master&keywords=" + txt;
        }
    };
</script>

<style>
	.banner{
		padding: 0;
		margin:0;
	}
	.banner img{
		width:973px;
		height:358px;
	}
</style>

</head>
<body>
	<!-- 引入头部 -->
	<?php echo W('Public/header');?>;

	<!-- 主题部分 -->
	
   	<!--全部分类-->
		<div class="l_bannerz">
		    <div class="l_fle">
		        <div class="l_fl_z">
		        <!-- 第一层遍历 -->
		        <?php if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="l_fe_s">
		                <div class="l_fe_ss" style="background: url(/Images/l_mstb1.png) #f5f5f5 no-repeat left;">
		                <a href="<?php echo U('GoodsList/goodslist');?>?id=<?php echo ($vo["id"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a>
						</div>
		                <div class="l_fe_sx">
		                    <ul>
		                    <!-- 第二层遍历 -->
		                    <?php if(is_array($vo['subcat'])): $i = 0; $__LIST__ = $vo['subcat'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('GoodsList/goodslist');?>?pid=<?php echo ($vo1["id"]); ?>" class="sec"><?php echo ($vo1["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		                    </ul>
		                </div>
		            </div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
		    </div>

		    <div class="l_frbanner">
		        <div class="l_www51buycom_ms">
		            <ul class="l_51buypic_ms" style="position: relative; width: 973px; height: 362px;">
		            	<?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="position: absolute; width: 973px; left: 0px; top: 0px; display: list-item;">
		                	<a href="<?php echo U('Detail/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank" class="banner">
		                    	<!-- <img src="/xiangmu/TaoCiWang/Public/Home/images/Index_01.jpg" width="973" height="358"> -->
		                    	<?php echo ($vo["banner"]); ?>
		                 	</a>
		                 </li><?php endforeach; endif; else: echo "" ;endif; ?>
		            </ul>
		            <a class="prev" href="javascript:void(0)" style="opacity: 0; display: none;"></a>
		            <a class="next" href="javascript:void(0)" style="opacity: 0; display: none;"></a>
		            <div class="num">
		                <ul><li class="on">1</li><li class="">2</li></ul>
		            </div>
		        </div>
		        <script>
		            /*鼠标移过，左右按钮显示*/
		            $(".l_www51buycom_ms").hover(function () {
		                $(this).find(".prev,.next").fadeTo("show", 0);
		            }, function () {
		                $(this).find(".prev,.next").hide();
		            })
		            /*鼠标移过某个按钮 高亮显示*/
		            $(".prev,.next").hover(function () {
		                $(this).fadeTo("show", 0);
		            }, function () {
		                $(this).fadeTo("show", 0);
		            })
		            $(".l_www51buycom_ms").slide({ titCell: ".num ul", mainCell: ".l_51buypic_ms", effect: "fold", autoPlay: true, delayTime: 0, autoPage: true });
		        </script>
		    </div>
		</div>

		<!--新品首发-->
		<div class="l_xpsf">
		    <div class="l_xpsfl">
		        <div class="l_tl02">
		            <ul>
		                <li id="one1" onclick="setTab(&#39;one&#39;,1,3)" class="hover"><a>新品首发</a></li>
		                <li id="one2" onclick="setTab(&#39;one&#39;,2,3)"><a>热卖商品</a></li>
		                <li id="one3" onclick="setTab(&#39;one&#39;,3,3)"><a>特价商品</a></li>
		            </ul>
		        </div>
		        <div class="l_con02">
		            <!--新品首发-->

		            <div class="xp" id="con_one_1" style="display: block;">
		                <ul>
		                <?php if(is_array($new)): $i = 0; $__LIST__ = $new;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
		                        <a class="y_position_a" href="<?php echo U('Detail/detail');?>?id=<?php echo ($vo["id"]); ?>" target="_blank">
		                        <img src="/xiangmu/TaoCiWang<?php echo ($vo["photo"]); ?>" width="220" height="220" title="雅典神话22头">
		                        <!--提价商品标签-->
								</a>
		                        <p><a href="javascript:;" target="_blank" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></p>
		                        <p><span class="l_ys1">￥<?php echo ($vo["price"]); ?></span></p>
		                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
		                </ul>
		            </div>

		            <!--热卖商品-->
		            <div class="xp" id="con_one_2" style="display: none;">
		                <ul>
		                    <?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li>
		                        <a class="y_position_a" href="<?php echo U('Detail/detail');?>?id=<?php echo ($vo2["id"]); ?>" target="_blank">
		                        <img src="/xiangmu/TaoCiWang<?php echo ($vo2["photo"]); ?>" width="220" height="220" title="<?php echo ($vo["name"]); ?>">
		                        <!--提价商品标签-->
								</a>
		                        <p><a href="javascript:;" target="_blank" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo2["name"]); ?></a></p>
		                        <p><span class="l_ys1">￥<?php echo ($vo2["price"]); ?></span></p>
		                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
		                </ul>
		            </div>
		            <!--特价商品-->
		            <div class="xp" id="con_one_3" style="display: none;">
		                <ul>
		                    <?php if(is_array($special)): $i = 0; $__LIST__ = $special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($i % 2 );++$i;?><li>
		                        <a class="y_position_a" href="<?php echo U('Detail/detail');?>?id=<?php echo ($vo3["id"]); ?>" target="_blank">
		                        <img src="/xiangmu/TaoCiWang<?php echo ($vo3["photo"]); ?>" width="220" height="220" title="<?php echo ($vo3["name"]); ?>">
		                        <!--提价商品标签-->
								</a>
		                        <p><a href="javascript:;" target="_blank" title="<?php echo ($vo3["name"]); ?>"><?php echo ($vo3["name"]); ?></a></p>
		                        <p><span class="l_ys1">￥<?php echo ($vo3["price"]); ?></span></p>
		                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
		                </ul>
		            </div>
		        </div>
		        <script language="javascript" type="text/javascript">
		            function setTab(name, cursel, n) {
		                for (i = 1; i <= n; i++) {
		                    var menu = document.getElementById(name + i);
		                    var con = document.getElementById("con_" + name + "_" + i);
		                    menu.className = i == cursel ? "hover" : "";
		                    con.style.display = i == cursel ? "block" : "none";
		                }
		            }

		            function setTab2(name, cursel, n) {
		                for (i = 1; i <= n; i++) {
		                    var menu = document.getElementById(name + i);
		                    var con = document.getElementById("con_" + name + "_" + i);
		                    menu.className = i == cursel ? "hover" : "";
		                    con.style.display = i == cursel ? "block" : "none";
		                }
		            }
		        </script>
		    </div>

		    <div class="l_xpsfr">

		        <div id="outer">
		            <ul id="tab">
		                <li class="current">促销活动</li>
		                <li>公司新闻</li>
		            </ul>
		            <div id="content">
		                <!--促销活动-->
		                <ul name="static" style="display: block; margin-top: 10px;">
		                    <img src="/xiangmu/TaoCiWang/Public/Home/images/cq.jpg" width="230" height="108">
		                        <li><a href="http://www.redroses1960.com/Home/PromActiveContent?Identifier=3" target="_blank" title="新品特惠">新品特惠</a></li>
		                        <li><a href="http://www.redroses1960.com/Home/PromActiveContent?Identifier=1" target="_blank" title="三八节促销">三八节促销</a></li>

		                </ul>

		                <ul>
		                        <li><a href="http://www.redroses1960.com/Home/InfoContent?InfoColumn=CopmpanyNews&Identifier=8688" target="_blank" title="陶瓷网">陶瓷网</a></li>              
		                        <li><a href="http://www.redroses1960.com/Home/InfoContent?InfoColumn=CopmpanyNews&Identifier=8687" target="_blank" title="陶瓷网">陶瓷网</a></li>              
		                        <li><a href="http://www.redroses1960.com/Home/InfoContent?InfoColumn=CopmpanyNews&Identifier=6045" target="_blank" title="陶瓷知识">陶瓷知识</a></li>              

		                </ul>

		            </div>
		        </div>

		        <script>
		            $(function () {
		                window.onload = function () {
		                    var $li = $('#tab li');
		                    var $ul = $('#content ul');

		                    $li.mouseover(function () {
		                        var $this = $(this);
		                        var $t = $this.index();
		                        $li.removeClass();
		                        $this.addClass('current');
		                        $ul.css('display', 'none');
		                        $ul.eq($t).css('display', 'block');
		                    })
		                }
		            });
		        </script>
		    </div>
		</div>
		<!--新品首发-->

		<!--1F板块-->
		<!--1F板块-->
		<div class="l_xpsf">
		    <div class="l_dbdh">
		        <div class="l_dbdh_l"><span class="l_ys3">1F</span>餐具</div>
		        <div class="l_dbdh_r"><a href="http://www.redroses1960.com/Home/GoodsList?TypeId=1">更多 </a></div>
		    </div>
		    <div class="l_lxcp">
		        <div class="l_lxtp">
		            <div class="j_index_lc_lunxian">
		                <div id="xxx">
		                    <script>
		                        var box = new PPTBox();
		                        box.width = 222; //宽度
		                        box.height = 568; //高度
		                        box.autoplayer = 3; //自动播放间隔时间
		                        box.add({ "url": "/xiangmu/TaoCiWang/Public/Home/images/201508260101.jpg", "href": "http://www.redroses1960.com/Home/GoodsContent?Identifier=2240", "title": "淡雅如烟56头" })
		                        box.add({ "url": "/xiangmu/TaoCiWang/Public/Home/images/201508260102.jpg", "href": "http://www.redroses1960.com/Home/GoodsContent?Identifier=2237", "title": "银河28头" })

		                        box.show();
		                    </script>
		                    <div id="_ppt_box-0_mainbox" class="mainbox" style="width:222px;height:570px;">
		                    	<div id="_ppt_box-0_flashbox" class="flashbox" style="width: 449px; height: 570px; left: 0px;">
			                    	<img src="/xiangmu/TaoCiWang/Public/Home/images/201508260101.jpg" style="width:222px;height:568px;cursor:pointer" onclick="PPTBoxHelper.instance[&#39;_ppt_box-0&#39;].clickPic(0)">
			                    	<img src="/xiangmu/TaoCiWang/Public/Home/images/201508260102.jpg" style="width:222px;height:568px;cursor:pointer" onclick="PPTBoxHelper.instance[&#39;_ppt_box-0&#39;].clickPic(1)">
		                    	</div>
			                    <div id="_ppt_box-0_imagebox" class="imagebox" style="width:222px;height:12px;top:-22px;">
			                    	<div class="bitdiv defimg" title="银河28头" src="bit01.gif" onclick="PPTBoxHelper.instance[&#39;_ppt_box-0&#39;].clickPic(1)" onmouseover="PPTBoxHelper.instance[&#39;_ppt_box-0&#39;].mouseoverPic(1)">
			                    	</div>
			                    <div class="bitdiv curimg" title="淡雅如烟56头" src="bit01.gif" onclick="PPTBoxHelper.instance[&#39;_ppt_box-0&#39;].clickPic(0)" onmouseover="PPTBoxHelper.instance[&#39;_ppt_box-0&#39;].mouseoverPic(0)">
			                    </div>
			                </div>
		                </div>
		            </div>
		            <div id="_ppt_box-0_mainbox" class="mainbox">
		                <div id="_ppt_box-0_flashbox" class="flashbox"></div>
		                <div id="_ppt_box-0_imagebox" class="imagebox"></div>
		            </div>
		        </div>
		    </div>
			<!--1F数据-->
			<div class="l_lxtp_r">
			    <ul>
			        <li>
			                <a class="y_position_a" href="http://www.redroses1960.com/Home/GoodsContent?Identifier=2389" target="_blank">
				                <img src="/xiangmu/TaoCiWang/Public/Home/images/635757658756034110_849.jpg" width="220" height="220">
				                <div class="y_bq">
				                    <img src="/xiangmu/TaoCiWang/Public/Home/images/xp_03.png">
				                </div>
			                </a>
			                <p style="text-align: left; margin: 5px 0 5px 12px; _margin: 0px 0 0px 12px; *_margin: 0px 0 0px 12px;">
			                    <a href="http://www.redroses1960.com/Home/GoodsContent?Identifier=2389" target="_blank">雅典神话22头</a>
			                </p>
			                <p style="text-align: left; margin: 5px 0 5px 12px; _margin: 0px 0 0px 12px; *_margin: 0px 0 0px 12px;">
			                    <span class="l_ys1">￥1080</span>
			                </p>
			        </li>
			    </ul>
			</div>
		</div>
	

	
	<!-- 引入尾部 -->
	<?php echo W('Public/footer');?>;
</body>
</html>