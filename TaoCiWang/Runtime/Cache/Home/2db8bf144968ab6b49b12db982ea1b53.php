<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>陶瓷网支付-请选择支付方式</title>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <link rel="stylesheet" type="text/css" href="/xiangmu/TaoCiWang/Public/Home/css/main.css">
    <script type="text/javascript" src="/xiangmu/TaoCiWang/Public/Home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/xiangmu/TaoCiWang/Public/layer/layer.js"></script>
</head>
<body style="background:#ecedf2">
    <div class="shortcut">
        
		
      <div class="w">
		<div id="logo" style="float:left">
            <img src="/xiangmu/TaoCiWang/Public/Home/images/logoh.png" alt="陶瓷网 收银台" height="28" width="170">
        </div>
          <ul class="s-right" style="float:right">
              <li id="loginbar" class="s-item fore1"><a href="https://home.jd.com/" target="_blank" class="link-user"><?php echo ($data["uname"]); ?></a>&nbsp;&nbsp;<a href="" class="link-logout">退出</a></li>
              <li class="s-div">|</li>
              <li class="s-item fore2">
                  <a class="op-i-ext" href="javascript:history.go(-1)">我的订单</a>
              </li>
              <li class="s-div">|</li>
              <li class="s-item fore3">
                  <a class="op-i-ext" target="_blank" href="">支付帮助</a>
              </li>
              <li class="s-div">|</li>
              <li class="s-item fore4">
                  <a class="op-i-ext" target="_blank" href="">问题反馈</a>
              </li>
          </ul>
          <span class="clr"></span>
      </div>
    </div>    
    

    <div class="main" style="padding-top:50px"> 
    	<div class="w"> 
            <!-- payment 支付方式选择 -->
            <div class="payment" style="padding:50px 20px">
                <!--陶瓷网支付图标-->
                <div class="jp-logo-wrap">
                    <span class="jp-logo"></span>
                </div>
                <!--陶瓷网支付图标 end-->
                <!--收银台公告-->
                <div class="jp-notice" style="background:none;margin-left: 0">
                    <div class="jp-tips">以下支付方式由陶瓷网支付提供</div>

                </div>
                <!--收银台公告 end-->

                <!-- order 订单信息 -->
                <div class="order" style="margin-bottom: 50px">
                        <div class="o-left" style="width:568px">
                            <h3 class="o-title">订单提交成功，请您尽快付款！订单号：<?php echo ($data["code"]); ?></h3>
                            <p class="o-tips">请您在提交订单后<span class="font-red">24小时</span>内完成支付，否则订单会自动取消。</p>
                        </div>
                        <div class="o-right">
                            <div class="o-price">
                                <em>应付金额</em><strong class="total"><?php echo ($data["total"]); ?></strong><em>元</em>
                            </div>
                            <div class="o-detail" id="orderDetail"><a href="javascript:;" class="detail" data="<?php echo ($data["id"]); ?>">订单详情<i></i></a></div>
                        </div>
                        <div class="clr"></div>
                        <div class="o-qrcode">
                            <a class="oq-img">
                                <img alt="" src="/xiangmu/TaoCiWang/Public/Home/images/getImageV2.jpg">
                            </a>
                            <div class="op-arrow"></div>
                            <div class="op-phone"></div>
                        </div>
                                          
                        <div class="o-list j_orderList" id="listPayOrderInfo">
                        <!-- 单笔订单 -->
                            <div class="o-list-info">
                                <span class="mr10" id="shdz"></span>
                                <span class="mr10" id="shr"></span>
                                <span id="mobile"></span>
                            </div>
                            <div class="o-list-info">
                                <span id="spmc"></span>
                            </div>
                        <!-- 单笔订单 end -->
                        </div>        
                </div>
                <!-- order 订单信息 end -->
                <div class="pv-button" id="pv-button-submitPay">
                    <input value="立即支付" id="paySubmit" class="ui-button ui-button-XL disable" style="background:#FC962C;margin-left: 35px;color:#EEE" type="submit">
                </div>
            </div>
        </div>
        <input type="hidden" name="money" id='money' value='<?php echo ($money["money"]); ?>'>
        <input type="hidden" name="password" id='password' value='<?php echo ($money["password"]); ?>'>
		<input type="hidden" id='id' value='<?php echo ($data["id"]); ?>'>
<!-- 网银支付弹窗 成功 end -->
<!-- 填写支付密码 -->
        <div class="password" style="background-color:rgba(0,0,0,0.3);position:absolute;top:0;display:none">
            <div style="width:300px;height: 150px;margin:0 auto;background: #FFF" class="pay">
                <div style="background: #F8F8F8;height: 30px;width:290px;line-height:30px;padding-left:10px;font-weight: bold;">陶瓷网</div>
                <div style="width:230;height: 40px;padding: 30px 30px 10px">
                    支付密码：<input type="password" placeholder="输入支付密码" class="pwd">
                </div>
				<div style="margin:0 auto;width:200px;height: 30px">
                    <input type="button" value='确定' style="margin:0 40px" class="ok">            
                    <input type="button" value='取消' class="cancle">            
                </div>
            </div>
        </div>
</body>
</html>

<script>
    $('.detail').click(function(){
        var id=$(this).attr('data');
        $.get("<?php echo U('Order/recive');?>",{"id":id});
        layer.open({
          type: 2,
          title: '陶瓷网',
          shadeClose: true,
          shade: 0.3,
          area: ['1200px', '666px'],
          content: '<?php echo U("Order/detail");?>' //iframe的url
        });
    })
    var heights=$(window).height(); //浏览器当前窗口可视区域高度
    var width=$(window).width(); //浏览器当前窗口可视区域宽度
	var tops=((heights/2)-150)+'px';
    $('.pay').css('margin-top',tops);
    $('.password').css({'width':width,'height':heights});
    $('#paySubmit').click(function(){
        $('.password').css('display','block');
    })

    $('.cancle').click(function(){
        $('.password').css('display','none');
    })
	
	//确定密码
	$(".ok").click(function(){
		var pwd=$('.pwd').val();
		var password=$("#password").val();
		if(pwd==""){
			layer.open({
                type: 1,
                title:'淘瓷网',
                time:3000,
                area: ['300px', '150px'],
                shadeClose: true, //点击遮罩关闭
                content: '<div style="padding:20px;text-align:center;font-size:13px">请输入密码</div>'
            });
		}else if(pwd==password){
            var money=$('#money').val();
            var total=Number($('.total').html());
            var mon=money-total;
			var id=$('#id').val();
			$.ajax({
				type:"POST",
				url:"<?php echo U('Pay/update');?>",
				data:{"money":mon,"id":id},
				success:function(msg){
					if(msg=='ok'){
						layer.open({
							type: 1,
							title:'淘瓷网',
							time:3000,
							area: ['300px', '150px'],
							shadeClose: true, //点击遮罩关闭
							content: '<div style="padding:20px;text-align:center;font-size:13px">支付成功</div>'
						});
						window.location.href="<?php echo U('Order/order');?>";
						$('.password').css('display','none');
					}else{
						alert('支付失败');
					}
				}
			})
			
        }else{
			layer.open({
                type: 1,
                title:'淘瓷网',
                time:3000,
                area: ['300px', '150px'],
                shadeClose: true, //点击遮罩关闭
                content: '<div style="padding:20px;text-align:center;font-size:13px">密码错误</div>'
            });
		}
	})
</script>