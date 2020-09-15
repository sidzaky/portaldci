' ----------------created by : Ajutorius Pinem <==== ngeri bets dahh --------------------------
Dim fullweb
Dim getweb
Dim strWebsite
Dim starttime
Dim endtime 
Dim counttime
Dim downloadtime
Dim kbytes_of_data 
Dim linespeed 
Dim kbpscek
Dim text

kbpscek = PingSite( strWebsite , "")
REM WScript.Echo kbpscek

fullweb = ""

Function PingSite( myWebsite, firstbw )
	starttime = int(DateDiff("s", "01/01/1970 00:00:00", Now()))
	
	If myWebsite="" Then 
		getweb = "http://bwmeter.bri.co.id/bwmeter/initialmeter.php"
	Else 
		getweb = "http://bwmeter.bri.co.id/bwmeter/meter.php?kbps="&firstbw
	End If
	
    Dim intStatus, objHTTP
    Set objHTTP = CreateObject( "WinHttp.WinHttpRequest.5.1" )
    objHTTP.Open "GET", getweb, False
    objHTTP.SetRequestHeader "User-Agent", "Mozilla/4.0 (compatible; MyApp 1.0; Windows NT 5.1)"

    On Error Resume Next

    objHTTP.Send
	'Wait for the entire response.
    objHTTP.WaitForResponse
	
    intStatus = objHTTP.Status

    On Error Goto 0

    If intStatus = 200 Then
		
		endtime=int(DateDiff("s", "01/01/1970 00:00:00", Now()))
		If (starttime =  endtime) Then 
			downloadtime = 0.00001
		Else 
			downloadtime = round((endtime - starttime)/1000, 10)
		End if
			REM WScript.Echo downloadtime
		If firstbw="" Then 
			
			linespeed = int(64/downloadtime)
			kbpscek = int((((linespeed*8)*10*1.024))/10)
			REM WScript.Echo linespeed
			REM WScript.Echo kbpscek
			getweb = "meter.php?kbps="
			PingSite = PingSite ( getweb, kbpscek) 
			
		Else 
			kbytes_of_data = int(firstbw * 1.25)
			If (kbytes_of_data > 3000) Then 
				kbytes_of_data = 3000
			End If
			REM WScript.Echo kbytes_of_data
			linespeed = round(kbytes_of_data/downloadtime, 2)
			kbpscek = round((((linespeed*8)*10*1.024))/10, 2)
			REM WScript.Echo linespeed
			REM WScript.Echo kbpscek
			text = kbpscek & "bits"
			kbpscek = round (kbpscek/1024, 5)
			text = text & " || " & kbpscek & "Kbits"
			kbpscek = round (kbpscek/1024, 5)
			text = text & " || " & kbpscek & "Mbits"
			kbpscek = round (kbpscek/8, 5)
			text = text & " || " & kbpscek & "MByte"
			WScript.Echo text
		End If
    Else
		PingSite = "Error on Web" & myWebsite
    End If

    Set objHTTP = Nothing
End Function