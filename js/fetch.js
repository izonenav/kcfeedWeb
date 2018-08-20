var noticeObj = {				
	noticeStartRow : 0 ,
	growthRow : ["산란계g","육계g","양돈g","축우g","최근정보g"] ,
	diseaseRow : ["가금d","양돈d","축우d","기타d","최근정보d"] ,

	fetchNoticeStyle : function(){
		document.querySelector("#previousFetch").style.display = "inline-block";
		document.querySelector("#nextFetch").style.display = "inline-block";
		document.querySelector(".notice-item").style.backgroundColor = "";
	} ,
	
	fetchNoticeDetailStyle : function(){
		document.querySelector("#previousFetch").style.display = "none";
		document.querySelector("#nextFetch").style.display = "none";
		document.querySelector(".notice-wrap").style.boxShadow = "";
		document.querySelector(".notice-item").style.backgroundColor = "#fff";
	} ,

	smothScroll : function(y){
        $('html, body').animate({
          scrollTop: y
        }, 1000, 'easeInOutExpo');
	} ,
	
	fetchNoticeSub : function (gubunDetail , thisObj){						
		if(typeof thisObj === "object")
		{
			this.fetchNoticeSubStyle(thisObj);
		}						
		var Selector = this.growthRow.indexOf(gubunDetail);
		fetch('ajax/noticeSub.php?gubunDetail='+ encodeURIComponent(gubunDetail)).then(function(response){
			return response.text();
		}).then(function(j){
				
				if(Selector >= 0)
				{
					document.getElementById('fetchGrowthDetail').innerHTML = j;
				}
				else
				{
					document.getElementById('fetchDiseaseDetail').innerHTML = j;
				}
			});
	} ,
	
	fetchNoticeSubStyle : function(Selector){
		var parentClassName = Selector.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.className;
		
		if(parentClassName.indexOf("growth") >= 0)
		{
			var currentActive = document.querySelector(".filter-growth a[class='nav-link active']");
			console.log(currentActive);
		}
		else if(parentClassName.indexOf("disease") >= 0)
		{
			var currentActive = document.querySelector(".filter-disease a[class='nav-link active']");
			console.log(currentActive);
		}
		else
		{
			console.log('알수없음');  
		}
		
		<!-- var currentActive = document.querySelector(".notice-item a[class='nav-link active']"); -->
		currentActive.setAttribute("class" ,"nav-link"); // remove 효과
		Selector.setAttribute("class", "nav-link active");	
	} ,
	
	NoticeDetailSelector : function(gubun , j){

		var growthSelector = this.growthRow.indexOf(gubun);
		var diseaseSelector = this.diseaseRow.indexOf(gubun);

		if(gubun === "notice")
		{
			document.getElementById('fetchNoticeDetail').innerHTML = j;							
		}
		else if(gubun === "growth")
		{
			document.getElementById('fetchGrowthDetail').innerHTML = j;	
		}
		else if(gubun === "disease")
		{
			document.getElementById('fetchDiseaseDetail').innerHTML = j; 
		}
		else if(growthSelector >= 0)
		{
			document.getElementById('fetchGrowthDetail').innerHTML = j;	
		}
		else if(diseaseSelector >= 0)
		{
			document.getElementById('fetchDiseaseDetail').innerHTML = j;	
		}
		
	}
};
				
function fetchNotice(direction , gubun)
{	
	if(direction == 'else')
	{
		x = $("#notice").offset().left;
		y = $("#notice").offset().top;
		noticeObj.smothScroll(y);
	}
	
	noticeObj.fetchNoticeStyle();
					
	fetch('ajax/notice.html?direction='+direction+'&noticeStartRow='+noticeObj.noticeStartRow+'&gubun='+ encodeURI(gubun,"UTF-8")).then(function(response){
		return response.json();
	}).then(function(j){
			noticeObj.noticeStartRow = j[0];
			noticeObj.NoticeDetailSelector(gubun , j[1]);
		});
}

function fetchNoticeDetail(seq , gubun)
{					
	noticeObj.fetchNoticeDetailStyle();
	
	fetch('ajax/noticeDetail.php?seq='+seq+'&gubun='+encodeURI(gubun,"UTF-8")).then(function(response){
		return response.text();
	}).then(function(j){	
			noticeObj.NoticeDetailSelector(gubun , j);
		});
}