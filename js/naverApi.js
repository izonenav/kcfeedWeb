var map = new naver.maps.Map('map');
var myaddress = '금호로 320';// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
var _imsi;
map.setOptions("scrollWheel", false); //지도 유형 컨트롤의 표시 여부
map.setOptions("zoomControl", true); //지도 유형 컨트롤의 표시 여부
  
setCenterAndMakeMarker(myaddress,_imsi);
	
function setCenterAndMakeMarker(myaddress ,t)
{			
	if(typeof t == "object") 
	{ 
		document.querySelector("#contact-flters li[class=filter-active]").classList.remove("filter-active");
		t.classList.add("filter-active");
	}
	
	changeAddressAndPhone(myaddress , t);
	naver.maps.Service.geocode({address: myaddress}, function(status, response)   {  
	if (status !== naver.maps.Service.Status.OK) {
		return alert(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
	}
	  
	var result = response.result;
		// console.log(result);
	  // 검색 결과 갯수: result.total
	  // 첫번째 결과 결과 주소: result.items[0].address
	  // 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x

	if(result.userquery == "강남로 218") // 강남로 218 경기도에 하나더 있음
	{
		var myaddr = new naver.maps.Point(result.items[3].point.x, result.items[3].point.y);
	}
	else
	{
		var myaddr = new naver.maps.Point(result.items[0].point.x, result.items[0].point.y);
	}
	
	map.setCenter(myaddr); // 검색된 좌표로 지도 이동
	  
	  // 마커 표시
	var marker = new naver.maps.Marker({
		position: myaddr,
		map: map
	});
	  // 마커 클릭 이벤트 처리
	naver.maps.Event.addListener(marker, "click", function(e) {
		// if (infowindow.getMap()) {
			// infowindow.close();
		// } else {
			// infowindow.open(map, marker);
		// }
		
		if(result.userquery == "강남로 218") // 강남로 218 경기도에 하나더 있음
		{
			var url = 'http://map.naver.com/index.nhn?enc=utf8&level=2&lng='+ result.items[3].point.x +'&lat='+ result.items[3].point.y +'&pinTitle=케이씨피드&pinType=SITE';
		}
		else
		{
			var url = 'http://map.naver.com/index.nhn?enc=utf8&level=2&lng='+ result.items[0].point.x +'&lat='+ result.items[0].point.y +'&pinTitle=케이씨피드&pinType=SITE';			
		}
		
		window.open(url);
	  });
  });

}

function changeAddressAndPhone(myaddress , t)
{
	
	if(typeof t == "object") 
	{ 
		var locationGubun = t.getAttribute("data-gubun");
		console.log(locationGubun);
	}
	
	if(myaddress == '금호로 320')
	{
		$(".adress").text('경상북도 영천시 금호읍 금호로 320번지');
		$(".phone").text('054-332-6511');
		$(".fax").text('054-333-3457');
	}
	else if(myaddress == '황새울로 234')
	{
		$(".adress").text('경기도 성남시 분당구 황새울로 234 분당트라팰리스 326호');
		$(".phone").text('02-553-5648');
		$(".fax").text('02-553-5747');
	}
	else if(myaddress == '홍덕길 22')
	{
		$(".adress").text('경상남도 거창군 남상면 홍덕길 22번지');
		$(".phone").text('055-945-6511');
		$(".fax").text('055-945-6521');
	}
	else if(myaddress == '성서4차첨단로 110')
	{
		if(locationGubun == 'main')
		{
			$(".adress").text('대구광역시 달서구 성서4차첨단로 110');
			$(".phone").text('053-588-1239');
			$(".fax").text('053-587-0364');
		}
		else if(locationGubun == 'sub')
		{
			$(".adress").text('대구광역시 달서구 성서4차첨단로 110');
			$(".phone").text('053-586-6511');
			$(".fax").text('070-4015-2847');
		}
	}
	else if(myaddress == '강남로 218')
	{
		$(".adress").text('경상남도 거창군 거창읍 강남로 218');
		$(".phone").text('055-944-8186');
		$(".fax").text('055-942-9599');
	}
	else if(myaddress == '함안대로 772')
	{
		$(".adress").text('경상남도 함안군 가야읍 함안대로 772');
		$(".phone").text('055-743-4396~7');
		$(".fax").text('055)745-9296');
	}
	else if(myaddress == '송설로 24-11')
	{
		$(".adress").text('경상북도 김천시 송설로 21-11');
		$(".phone").text('054-432-3520');
		$(".fax").text('054-432-1115');
	}
}