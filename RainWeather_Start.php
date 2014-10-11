<?

date_default_timezone_set('Asia/Seoul');

function weatherget($code,$array)
{


$url = "http://www.kma.go.kr/weather/forecast/mid-term-xml.jsp?stnId=$code";
$result = simplexml_load_file($url);
$list = array();
$location= iconv("UTF-8","euc-kr",$result->header->title); //예보지역
$results = $result->body->location;

foreach($results->data as $item)
{
$num = $item->numEf; //n 일후 예보
$wdate = $item->tmEf; // 날짜
$wformat =iconv("UTF-8","euc-kr",$item->wf); //날씨, (맑음,구름조금,구름많음,흐림,비,눈/비,눈
$tmin = $item->tmn; //최저온도
$tmax = $item->tmx; //최고온도
$rainrate =iconv("UTF-8","euc-kr",$item->reliability); //신뢰도
$tmparr = array($num, $wdate, $wformat, $tmin, $tmax, $rainrate);
array_push($list, $tmparr);
}
if (isset($list))
{
for($i = 0; $i < count($list); $i++)
{
$num = $list[$i][0];
$wdate = $list[$i][1];
$wformat = $list[$i][2];
$tmin = $list[$i][3];
$tmax = $list[$i][4];
$rainrate = $list[$i][5];
$strformat = iconv("EUC-KR", "UTF-8", $wformat);
return "기후상태 : $strformat , 최고/최저 : $tmin~$tmax C";


//array_push($mindata,"$tmin");
//array_push($maxdata,"$tmax");

}
}
}
function weatherget2($city){
        $url="http://weather.service.msn.com/data.aspx?weadegreetype=C&culture=ko-KR&weasearchstr=$city";
        $result = simplexml_load_file($url);
        $now = $result->weather[0]->current->attributes()->temperature;
        $skytext = $result->weather[0]->current->attributes()->skytext;
        $low = $result->weather[0]->forecast[0]->attributes()->low;
        $high = $result->weather[0]->forecast[0]->attributes()->high;
 
 
        return "기후상태 : $skytext , 최저/최고 : $low~$high C";
}
echo "WeatherBot Started\n";
$page_access_token = 'PAGE_TOKEN'
$page_id = 'PAGE_ID';

//$data['picture'] = "http://www.example.com/image.jpg";
//$data['link'] = "http://rainc.crplab.kr";
$aweatherget[0] = '109'; //  서울 경기도
$aweatherget[1] = '105'; // 강원도
$aweatherget[2] = '131'; //충청북도
$aweatherget[3] = '133'; //충청남도
$aweatherget[4] = '146'; //전라북도
$aweatherget[5] = '156'; //전라남도
$aweatherget[6] = '143'; //경상북도
$aweatherget[7] = '159'; //경상남도
//$strlist = iconv("EUC-KR", "UTF-8", $wformat);
echo "Getting Weather Information (1/2)";
$r1 = weatherget(109,"0");
$r2 = weatherget(105,"1");
$r3 = weatherget(131,"2");
$r4 = weatherget(133,"3");
$r5 = weatherget(146,"4");
$r6 = weatherget(156,"5");
$r7 = weatherget(143,"6");
$r8 = weatherget(159,"7");



//$arr = explode("C", $r1);

//for($i=0; $i<sizeof($arr); $i++){
//     echo "결과 : " . $arr[$i];
//}

$time=date("Y-m-d H:i:s",time());


//$maxnum = max($maxdata);
//$minnum = min($mindata);



//echo "값 : $minnum";
//$maxcity = array_search($maxnum, $maxdata);
//$mincity = array_search($minnum, $mindata);


//switch ($maxcity) {
//	case 0 : $strmaxcity = "서울/경기도";
//		break;
//	case 1 : $strmaxcity = "강원도";
//		break;
//	case 2 : $strmaxcity = "충청북도";
//		break;
//	case 3 : $strmaxcity = "충청남도";
//		break;
//	case 4 : $strmaxcity = "전라북도";
//		break;
//	case 5 : $strmaxcity = "경상북도";
//		break;
//	case 6 : $strmaxcity = "경상남도";
//		break;
//	case 7 : $strmaxcity = "경상남도";
//		break;
//	default	: $strmaxcity = "오류";
//		break;
//}

//switch ($mincity) {
//	case 0 : $strmincity = "서울/경기도";
 //               break;
  //      case 1 : $strmincity = "강원도";
   //             break;
//        case 2 : $strmincity = "충청북도";
 //               break;
  //      case 3 : $strmincity = "충청남도";
   //             break;
    //    case 4 : $strmincity = "전라북도";
     //           break;
      //  case 5 : $strmincity = "경상북도";
//                break;
 //       case 6 : $strmincity = "경상남도";
  //              break;
  //      case 7 : $strmincity = "경상남도";
   //             break;
    //    default : $strmincity = "오류";
     //           break;
//}





$week = array("일", "월", "화", "수", "목", "금", "토");
$aab = $week[date("w")];
$date = date("Ymd");
$thour = date("h");

$suwon = weatherget2("suwon");
$yangpyoung = weatherget2("천안");
$daegu = weatherget2("Daegu");
$ulsan = weatherget2("Ulsan");
$busan = weatherget2("busan");
$gwangju = weatherget2("광주");
$sejeong = weatherget2("세종특별자치시");
$jeju = weatherget2("제주");
$youngju = weatherget2("영주");
$gujedo = weatherget2("거제시");
$inchon = weatherget2("Inchon");

echo "\nGetting Weather Information (2/2)";
$data['message'] = "오늘의 날씨 입니다.\n".

                  $aab ."요일 날씨
                  서울/경기도 $r1
                  수원 $suwon 
                  천안 $yangpyoung
                  강원도 $r2
                  충청북도 $r3
                  세종시 $sejeong
                  충청남도 $r4 
                  전라북도 $r5 
                  전라남도 $r6 
                  경상북도 $r7 
                  대구 $daegu
                  영주 $youngju 
                  경상남도 $r8
                  거제시 $gujedo
                  울산 $ulsan 
                  부산 $busan
                  거제시 $gujedo
                  제주도 $jeju
                  마지막 업데이트 : $time 
                  링크는 기상청 사이트 입니다. #RainWeather_$date";
// \n 오늘 제일 더운 지역은 $strmaxcity 이고, \n 오늘 제일 춥거나 시원한 지역은 $strmincity 입니다.";
echo "\n GET http://www.kma.go.kr/repositary/image/sat/coms/coms_mi_le1b_ir1_k_" . $date .$thour."00.thn.png";
$data['picture'] = "http://www.kma.go.kr/repositary/image/sat/coms/coms_mi_le1b_ir1_k_" . $date .$thour."00.thn.png";

//$data['caption'] = "Weather Info";
//$data['description'] = "Description";
$data['link'] = "http://www.kma.go.kr/weather/main.jsp";
$data['access_token'] = $page_access_token;
$post_url = 'https://graph.facebook.com/'.$page_id.'/feed';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $post_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$return = curl_exec($ch);
echo "\nResult : $return\n";
curl_close($ch);



?>
