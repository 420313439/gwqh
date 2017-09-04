function copyToExcel(tableid) {
	//控制按钮
	var btn = document.getElementById("copy");
	btn.setAttribute("disabled", "true");
	btn.setAttribute("value", "处理中...");
	
	var curTbl = document.getElementById(tableid);
	try {
	var oXL = new ActiveXObject("Excel.Application");
	}
	catch (e) {//IE安全级别未设置将出现错误 （ Automation 服务器不能创建对象 ）
	/*
	如果是Scripting.FileSystemObject (FSO 文本文件读写)被关闭了，开启FSO功能即可，在“运行”中执行regsvr32 scrrun.dll即可
	*/
	alert("无法启动Excel!\n\n如果您确信您的电脑中已经安装了Excel，" 
		+ "那么请调整IE浏览器(IE7以上版本)的安全级别。\n\n具体操作：\n\n" + 
		"工具 → Internet选项 → 安全 → 自定义级别 → 对没有标记为安全的ActiveX进行初始化和脚本运行 → 启用");
	return false;
	}
	var oWB = oXL.Workbooks.Add();
	var oSheet = oWB.ActiveSheet;
	var sel = document.body.createTextRange();
	sel.moveToElementText(curTbl);
	sel.select();
	sel.execCommand("Copy");
	oSheet.Paste();
	oXL.Visible = true;
	var fname = oXL.Application.GetSaveAsFilename("数据.xls", "Excel Spreadsheets (*.xls), *.xls");
	oWB.SaveAs(fname);
	oWB.Close();
	oXL.Quit();
	//控制按钮
	btn.removeAttribute("disabled");
	
	btn.setAttribute("value", "导出到Excel文件");
} 