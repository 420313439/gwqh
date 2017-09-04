var enjoyhint_script_preset_steps={
	"noviceGuide":{
		"noviceGuide_allfunc":[
			  {
	            selector:'.right' ,
	            description: '欢迎使用邦客智能管家，请务必按照新手引导熟悉本系统。',
	            showNext:true,
	            justIntro:true,
	          },
	          {
	            'click #store' : '第一步：添加门店',
	            'event_type':'stop'
	          },  
	          {
	            'click #course' : '第一步已经完成，第二步：添加课程',
	            'event_type':'stop'
	          },
	          {
	            'click #teacher' : '第二步已经完成，第三步：添加老师，老师课程结算方式',
	            'event_type':'stop'
	          },
	          {
	            'click #student' : '第三步已经完成，第四步：添加学员，购买课程',
	            'event_type':'stop'
	          },
	          {
	            'click #scheduling' : '第四步已经完成，第五步：班级排课',
	            'event_type':'stop'
	          },
	          {
	            selector:'#dataImport' ,
	            description: '恭喜完成新手教程，接下来将介绍高级功能,批量数据导入可以将您之前的数据快速导入系统',
	            showNext:true,
	            showSkip:true
	          },
	          {
	            selector:'.leftmenu' ,
	            description: '侧边栏是比较常用的功能，你可以在任何页面，点击此处的功能进行跳转操作,当按钮右上方有红色小点时，说明该功能模块下有待办事项',
	            showNext:true,
	            showSkip:true
	          },
	          {
	            selector:'.top_head' ,
	            description: '顶部展示了公司名称和账户用户名，以及邦客使用百科论坛，有任何问题或建议可以点击进入论坛留言',
	            showNext:true,
	            showSkip:true
	          },
	          {
	            selector:'.kfleft' ,
	            description: '点击此处，可以快速打开qq，联系客服',
	            showNext:true,
	            showSkip:true
	          },
	          {
	            selector:'.right' ,
	            description: '教程引导完毕，如果您有任何问题请与我们的客服联系。',
	            showNext:true,
	            justIntro:true,
	            showSkip:true,
	          }
		],
		"noviceGuide_store":[
		      {
		        'click #storeAdd' : '点击添加门店'
		      },
		      {
		        'click #allfunc' : '点击回到功能大全进行下一步'
		      }
	    ],
	    "noviceGuide_course":[
		      {
		        selector:'#group' ,
		        description: '点击选择新增分组'
		      },
		      {
		        selector:'#add_group_name' ,
		        description: '输入分组名称',
		        showNext:true
		      },
		      {
		        'click #btn_group' : '点击保存分组'
		      },
		      {
		        'click #addcourse' : '点击添加课程'
		      },
		      {
		        selector:'.basic_option' ,
		        description: '填写课程基本信息(必填)',
		        event_type:'custom',
		        showNext:true
		      },
		      {
		      	'click .more_option' : '这里可以填写其它选填信息',
		      	'event_type':'stop',
		      	showNext:true,
		        disablecontent:true
		      },
		      {
		      	selector:'.release_option' ,
		        description: '这里可以选填课程对外招生宣传资料',
		        showNext:true,
		        disablecontent:true
		      },
		      {
		      	'click #submit' : '点击保存课程信息'
		      },
		      {
		        'click #allfunc' : '点击回到功能大全进行下一步'
		      }
	    ],
	    "noviceGuide_teacher":[
		      {
		        'click #teacherAdd' : '点击添加老师'
		      },
		      {
		        'click #allfunc' : '点击回到功能大全添加学员'
		      }
	    ],
	    "noviceGuide_student":[
		      {
		        'click #studentAdd' : '点击添加学员'
		      },
		      {
		        'click #buycourse' : '点击购买课程'
		      },
		      {
		        'click #allfunc' : '点击回到功能大全进行排课'
		      }
	    ],
	    "noviceGuide_book_confirm":[
		      {
		        'click #storeArrangeClass' : '点击门店进行快速排课'
		      },
		      {
		        'click #allfunc' : '恭喜你！你已经成功完成新手引导，点击回到功能大全开始新的探索吧！可以批量导入以前的数据哦！'
		      }
	    ],
	    "noviceGuide_book_create":[
		      {
		        selector:'#br_teacher_id' ,
		        description: '请选择班主任',
		        showNext:true
		      },
		      {
		        selector:'#classname' ,
		        description: '请输入班级名称(必填)',
		        showNext:true
		      },
		      {
		        selector:'#f_date' ,
		        description: '请选择开课日期',
		        showNext:true
		      },
		      {
		        selector:'#timechoose' ,
		        description: '请选择上课时间和上课老师(必填)',
		        showNext:true,
		        bottom:40,
		        top:-50
		      },
		      {
		        selector:'#stuchoose' ,
		        description: '请选择上课学员',
		        showNext:true
		      },
		      {
		        selector:'#previewtimatable' ,
		        description: '点击预览排课表'
		      }
	    ],
	    "noviceGuide_book_preview":[
		      {
		        'click #createtimetable' : '点击生成班级排课表',
		      }
	    ]
	},	
	
};

function change_enjoyhint_data(defaults,changes){
	for(i in changes){
		$.extend(defaults[i],changes[i]);
	}
	return defaults;
}

//改变数据调用示例
function changedata(){
	var dedata=enjoyhint_script_preset_steps.noviceGuide.noviceGuide_book_create;
	var change=[
		{showSkip:true},{showNext:false},{onBeforeStart:function(){
            classname=$("#classname").val();
            if(classname==''){
                alertInfo("班级名称不能为空");
                return false;
            }
        }},{},{}
	];
	var chdata=change_enjoyhint_data(dedata,change);
	console.log(chdata);
}