<?php
$db=mysql_connect("localhost", "root", "");

if ( $result = mysql_query ("drop database shashki")) {
			print("<br> Database dropped successfully\n");	
		} 
		else {
		printf ("<br>Could not drop database: %s\n", mysql_error ());	
		}		
mysql_query("CREATE DATABASE shashki");
if (mysql_select_db("shashki")) {
		print ("<br> Database selected successfully\n");	
	} else {
		printf ("<br> Could not select database: %s\n", mysql_error ());	
	}
$SQLrequest = "create table GAMER (
				GAMER_CODE int auto_increment not null,
				GAMER_LOGIN varchar(20),
				GAMER_PASSWORD varchar(15),
				GAMER_WINS int DEFAULT 0,
				GAMER_LOSE int DEFAULT 0,
				GAMER_PARITET int DEFAULT 0,
				primary key (GAMER_CODE) )";
		if ( $result = mysql_query( $SQLrequest)) {
			print("<br> Table created successfully\n");	
		} 
		else {
		printf ("<br>Could not create table: %s\n", mysql_error ());	
		}		
		//1 - белая, 2 - черная, 3 - белая дамка, 4 - черная дамка 5 Белая пустая клетка, 6  черная пустая клетка
		//OG_GAMER1_FIG = 1 - белые, = 0- ЧЕРНЫЕ
$SQLrequest = "create table ONLINE_GAME
(
   OG_CODE                        int auto_increment not null,
   OG_GAMER1                      int,
   OG_GAMER2                      int,
   OG_GAMER1_FIG				  int,
   OG_SID1                        varchar(100),
   OG_SID2                        varchar(100),
   OG_SCORE1					  int,
   OG_SCORE2  					  int,	
   OG_ISLOSE1					  bool DEFAULT false,
   OG_ISLOSE2					  bool DEFAULT false,
   OG_PARITET1				      int DEFAULT 1,
   OG_PARITET2                    int DEFAULT 1,		
   OG_WAIT                        bool,
   OG_GAMER_MOVE                  int,
   OG_LST_MOVE_TIME				  varchar(15),	
   OG_TIMEOUT_MIN    			  int DEFAULT 5,	
   OG_SEL_CELL1                  varchar(2),
   OG_SEL_CELL2					 varchar(2),
   OG_A_H                        varchar(65), 
   primary key (OG_CODE)
)";
		if ( $result = mysql_query( $SQLrequest)) {
			print("<br> Table created successfully\n");	
		} 
		else {
		printf ("<br>Could not create table: %s\n", mysql_error ());	
		}		
?>