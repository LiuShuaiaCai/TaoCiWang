<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加地址</title>
	<link href="/xiangmu/TaoCiWang/Public/Home/css/homestyle.css" rel="stylesheet">
</head>
<body>
	<!--添加编辑对话框-->
	<div class="layui-layer-wrap" id="AddressAddNew" style="width: 600px; height: 450px; display: block;">
	<form id="formAddressEdit">

	    <input name="Identifier" value="0" type="hidden">
	    <input value="0" name="AreaId" type="hidden"> <!--区的Id，自定义控件名字和Model不一致，需要手工接收下-->

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tbody><tr>
	    <td colspan="2" align="left" height="65"><font name="TitleLable" style=" padding-left:15px; font-size:14px; font-weight:bold; color:#8d0049; font-size:16px; ">新增收货地址</font>（电话号码、手机号码选填一项，其余均为必填项）</td>
	    </tr>
	  <tr>
	    <td align="right" height="50" width="150"><font class="j_green">* </font>收货人姓名：   </td>
	    <td class="j_tdfr">
	        <input class="j_inptext" id="reciveName" name="reciveName" type="text" value="<?php echo ($data["reciveName"]); ?>">
	    </td>
	  </tr>
	  <tr>
	    <td align="right" height="50"><font class="j_green">* </font>手机号码：  </td>
	    <td class="j_tdfr">
	        <input class="j_inptext" id="recivePhone" name="recivePhone" type="text" value="<?php echo ($data["recivePhone"]); ?>">
	    </td>
	  </tr>
	  <tr>
	    <td align="right" height="50"><font class="j_green">* </font>收货地址：  </td>
	    <td class="j_tdfr">
			<select name="province" id='province' onchange = "showcity()">
				<option value=""><?php echo ($data["province"]); ?></option>
			</select>
			<select name="city" id='city' onchange = "showdiqu()">
				<option value=""><?php echo ($data["city"]); ?></option>
			</select>
			<select name="county" id='diqu'>
				<option value=""><?php echo ($data["county"]); ?></option>
			</select>
	    </td>
	  </tr>
	   <tr>
	    <td align="right" height="50"><font class="j_green">* </font>详细地址：</td>
	    <td class="j_tdfr">
	        <input class="j_inptext" id="more" name="more" type="text" value="<?php echo ($data["more"]); ?>">
	    </td>
	  </tr> 
	 
	   <tr>
	    <td align="right" height="50"> </td>
	    <td class="j_tdfr">
            <?php if($data["status"] == 1): ?><input id="status" name="IsDefault" type="checkbox" checked> <!--1代表是默认地址-->
            <?php else: ?>
                <input id="status" name="IsDefault" type="checkbox"><?php endif; ?>
	        <label for="chbIsDefault" style="cursor:pointer">设置为默认收货地址</label>
	    </td>
	  </tr>
	  <tr>
	    <td align="right" height="50"> </td>
	    <td class="j_tdbc" align="left" height="55" valign="middle"><a href="javascript:void(0)" onclick="submit()">保存</a></td>
	    </tr>
        <input type="hidden" class="id" value='<?php echo ($data["id"]); ?>'>
	 </tbody>
	 </table>
	 </form>
	</div>
</body>
</html>
		<script src="/xiangmu/TaoCiWang/Public/Home/js/jquery.min.js"></script>
        <script type="text/javascript">
        var xmldom = null; //声明一个全局变量，用于存储第一次请求回来的xml信息
        //获取并显示省份
        function showprovince(){
            //① ajax去服务器端获得xml文件里边的省份信息
            $.ajax({
                url:'/xiangmu/TaoCiWang/Public/ChinaArea.xml',
                //data:,
                dataType:'xml',  //调用responseXML
                type:'get',
                success:function(msg){
                    xmldom = msg; //把请求回来的xml信息赋予给xmldom一份

                    //alert(msg);//object XMLDocument
                    var pros = $(msg).find('province');//在msg里边获得province元素节点对象
                    //遍历省份信息出来 pros是jquery对象
                    pros.each(function(k,v){
                        //k 是dom对象下标，  v (this)是dom对象
                        var nm = $(this).attr('province'); //省份名称
                        $('#province').append("<option value='"+nm+"'>"+nm+"</option>");
                    });
                }
            });
            //② jquery解析xml并显示
        }
        $(function(){
            //页面加载完毕就显示省份
            showprovince();
        });

        function showcity(){
            //根据选中的省份显示对应的城市
            //① 获得被选中的省份的value属性值
            var pid = $('#province option:selected').val();
            //② 在xml文档中获得province节点(xml的province节点)，其属性provinceID="pid"
            //   (xml文档内容"不发生变化"，其不适合做频繁的请求，带宽、服务器资源、用户等待时间有损耗)
            var xml_province = $(xmldom).find('province[province='+pid+']');
            
            //③ 在xml_province（jquery对象）里边获得子节点City
            var citys = xml_province.find('City');
            //④ 遍历citys，并在页面上显示
            $('#city').empty(); //先清除已经显示的节点
            $('#city').append('<option value="0">-请选择-</option>');
            citys.each(function(){
                var nm = $(this).attr('City');
                $('#city').append("<option value='"+nm+"'>"+nm+"</option>");
            });
        }
        function showdiqu(){
            //根据选中的省份显示对应的城市
            //① 获得被选中的省份的value属性值
            var pid = $('#city option:selected').val();
            //② 在xml文档中获得province节点(xml的province节点)，其属性provinceID="pid"
            //   (xml文档内容"不发生变化"，其不适合做频繁的请求，带宽、服务器资源、用户等待时间有损耗)
            var xml_province = $(xmldom).find('City[City='+pid+']');
            
            //③ 在xml_province（jquery对象）里边获得子节点City
            var diqus = xml_province.find('Piecearea');
            //④ 遍历citys，并在页面上显示
            $('#diqu').empty(); //先清除已经显示的节点
            $('#diqu').append('<option value="0">-请选择-</option>');
            diqus.each(function(){
                var nm = $(this).attr('Piecearea');
                $('#diqu').append("<option value='"+nm+"'>"+nm+"</option>");
            });
        }

        function submit(){
        	var reciveName=$('#reciveName').val();
        	var recivePhone=$('#recivePhone').val();
        	var province=$('#province').val();
        	var city=$('#city').val();
        	var county=$('#diqu').val();
        	var more=$('#more').val();
            var id=$('.id').val();
        	//设置默认地址
        	var status=0;
        	var checked=$('#status').is(':checked');
        	if(checked){
        		$.ajax({
        			type:'POST',
        			url:"<?php echo U('Adress/update');?>",
        			success:function(msg){
        				status='1';
        				demo();
        			}
        		})
        	}else{
        		status=0;
        		demo();
        	}
        	function demo(){
	        	$.ajax({
	        		type:'POST',
	        		url:"<?php echo U('Adress/update');?>",
	        		data:{"reciveName":reciveName,"recivePhone":recivePhone,"province":province,"city":city,"county":county,"more":more,"status":status,"id":id},
	        		success:function(msg){
	        			if(msg=='ok'){
	        				//当你在iframe页面关闭自身时
							var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
							parent.layer.close(index); //再执行关闭
							window.location.href="<?php echo U('CheckInfo/checkinfo');?>";
	        			}else{
	        				layer.open({
					            type: 1,
					            title:'淘瓷网',
					            time:3000,
	                            area: ['300px', '150px'],
					            shadeClose: true, //点击遮罩关闭
					            content: '<div style="padding:20px;text-align:center;font-size:13px">添加失败</div>'
					        });
	        			}
	        		}
	        	})
	        	window.close();
	        }
        }
        </script>