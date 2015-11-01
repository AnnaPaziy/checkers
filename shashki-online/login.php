<?php
//ini_set("session.use_trans_sid",true); 
session_start(); //ñòàðòóåì ñåññèþ
require_once 'dbSettings.php';

// 1.íóæíî ïðîâåðèòü   ïðèøåäøåå èìÿ þçåðà è ïàðîëü
// 2. åñëè îíè âàëèäíû òîãäà  óêàçûâàåì isAutharized â ñåññèè ðàâíûì true è îòêðûâàåì ñòðàíèöó ñ èãðîé à òàêæå âïèñûâàåì GAMER_CODE â SESSION gamer_code
	//(åñëè íà ñòðàíèöå ñ èãðîé is Authorized íå óñòàíîâëåí ïðîñòî ïåðåêèäûâàåì íà index.html)
// 3. åñëè íåò òîãäà âûäàåì ñòðàíèöó ñ ïðåäóïðåæäåíèåì è âîçâðàùàåì ñíîâà íà ââîä íà ëîãèíà è ïàðîëÿ
//åñëè  ìû íàæàëè âîéòè
if ($_POST['enter'] == 'ENTER') {
	if (!$_POST['uname']  || !$_POST['passw']){ //åñëè íå ââåäåíî èìÿ èëè ïàðîëü òîãäà íè÷åãî íå äåëàåì à ñíîâà ñêèäûâàåì íà ñòðàíèöó ëîãèíà
		echo ' 
			<meta http-equiv="Refresh" content="0; URL=index.html">
		';
		exit();
	}else //åñëè âñå¸ ââåäåíî  ïðîâåðÿì åñòü ëè òàêîé þçâåðü â áàçå
	{
		//1. êîííåêòèìñÿ ê  áàçå
		//2.  èçâëåêàåì èç  Gamer   þçåðà ñ ïðèøåäøåìè ïàðàìåòðàìè
		//3. åñëè ÷òî òî èçâëåêëè çíà÷èò SESIONAutorized = true è Session gamercode =gamer.gamer_code
		//4. åñëè íè÷åãî íå èçâëåêëè ñîîáùàåì î íåâåðíîì ïðàîëå èëè ëîãèíå è îïÿòü êèäàâåì íà ñòðàíèöó ëîãèíà
		//1.../*Ñîåäèíÿåìñÿ  ñ ñåðâåðîì*/
		$link = mysql_connect($dbServer,$dbUser,$dbPass) or exit("Connection is fall");
		/*Âûáèðàåì áàçó äàííûõ */
		if (mysql_select_db("shashki")) {
		//2...
			$SQLrequest = "SELECT * from GAMER where GAMER_LOGIN='".mysql_escape_string($_POST['uname'])."' and GAMER_PASSWORD='".mysql_escape_string($_POST['passw'])."'";
		
			if ($result = mysql_query( $SQLrequest)) { // âûòàñêèâàåì èç  áàçû  çàïèñü  þçåðà
				$countusers = mysql_num_rows($result);
				if (!$countusers) 
				{ //òàêîãî  ëîãèíà íåò  ïîýòîìó  ñîîáùàåì þçåðó
					$_SESSION['Auth']['isAutharize']=false; //íå àâòîðèçîâàí
				require_once "login_result.php";				
				/*echo ' 
						<meta http-equiv="Refresh" content="0; URL=login_result.php">
						';
					exit();*/
				}
				else 
				{
					$_SESSION['Auth']['isAutharize']=true; //àâòîðèçîâàí
					$_SESSION['Auth']['GAMER_LOGIN']=mysql_result($result,0,'GAMER_LOGIN'); //èìÿ ïîëüçîâàòåëÿ
					$_SESSION['Auth']['GAMER_CODE']=mysql_result($result,0,'GAMER_CODE'); //êîä  ïîëüçîâàòåëÿ
					//require_once "login_result.php";
					echo ' 
						<meta http-equiv="Refresh" content="0; URL=game.php">
						';
					exit();
				}
			}
		}
	}
}
?>