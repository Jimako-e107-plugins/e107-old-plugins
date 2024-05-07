<?php

//=================
// Looks up the name of the tag for the MakerNote (Depends on Manufacturer)
//====================================================================
function lookup_Canon_tag($tag) {
	
	switch($tag) {
		case "0006": $tag = "ImageType";break;
		case "0007": $tag = "FirmwareVersion";break;
		case "0008": $tag = "ImageNumber";break;
		case "0009": $tag = "OwnerName";break;
		case "000c": $tag = "CameraSerialNumber";break;	
		case "000f": $tag = "CustomFunctions";break;	
		
		default: $tag = "unknown:".$tag;break;
	}
	
	return $tag;
}

//=================
// Formats Data for the data type
//====================================================================
function formatCanonData($type,$tag,$intel,$data,&$result) {
	$place = 0;
	
	
	if($type=="ASCII") {
		$result = $data;		
	} else if($type=="URATIONAL" || $type=="SRATIONAL") {
		$data = bin2hex($data);
		if($intel==1) $data = intel2Moto($data);
		$top = hexdec(substr($data,8,8));
		$bottom = hexdec(substr($data,0,8));
		if($bottom!=0) $data=$top/$bottom;
		else if($top==0) $data = 0;
		else $data=$top."/".$bottom;
	
		if($tag=="0204") { //DigitalZoom
			$data=$data."x";
		} 
		
	} else if($type=="USHORT" || $type=="SSHORT" || $type=="ULONG" || $type=="SLONG" || $type=="FLOAT" || $type=="DOUBLE") {
		
		$data = bin2hex($data);
		$result['RAWDATA'] = $data;
	
		if($tag=="0001") { //first chunk
			$result['Bytes']=hexdec(substr($data,$place,2));$place+=2;//0
			$result['Macro']=hexdec(substr($data,$place,2));$place+=2;//1
			$result['SelfTimer']=hexdec(substr($data,$place,2));$place+=2;//2
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//3
			$result['Flash']=hexdec(substr($data,$place,2));$place+=2;//4
			$result['ContinuousDriveMode']=hexdec(substr($data,$place,2));$place+=2;//5
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//6
			$result['FocusMode']=hexdec(substr($data,$place,2));$place+=2;//7
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//8
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//9
			$result['ImageSize']=hexdec(substr($data,$place,2));$place+=2;//10
			$result['EasyShooting']=hexdec(substr($data,$place,2));$place+=2;//11
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//12
			$result['Contrast']=hexdec(substr($data,$place,2));$place+=2;//13
			$result['Saturation']=hexdec(substr($data,$place,2));$place+=2;//14
			$result['Sharpness']=hexdec(substr($data,$place,2));$place+=2;//15
			$result['ISO']=hexdec(substr($data,$place,2));$place+=2;//16
			$result['MeteringMode']=hexdec(substr($data,$place,2));$place+=2;//17
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//18
			$result['AFPointSelected']=hexdec(substr($data,$place,2));$place+=2;//19
			$result['ExposureMode']=hexdec(substr($data,$place,2));$place+=2;//20
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//21
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//22
			$result['LongFocalLength']=hexdec(substr($data,$place,2));$place+=2;//23
			$result['ShortFocalLength']=hexdec(substr($data,$place,2));$place+=2;//24
			$result['FocalUnits']=hexdec(substr($data,$place,2));$place+=2;//25
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//26
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//27
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//28
			$result['FlashDetails']=hexdec(substr($data,$place,2));$place+=2;//29
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//30
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//31
			$result['FocusMode']=hexdec(substr($data,$place,2));$place+=2;//32
			
		} else if($tag=="0004") { //second chunk
			$result['Bytes']=hexdec(substr($data,$place,2));$place+=2;//0
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//1
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//2
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//3
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//4
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//5
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//6
			$result['WhiteBalance']=hexdec(substr($data,$place,2));$place+=2;//7
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//8
			$result['SequenceNumber']=hexdec(substr($data,$place,2));$place+=2;//9
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//10
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//11
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//12
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//13
			$result['AFPointUsed']=hexdec(substr($data,$place,2));$place+=2;//14
			$result['FlashBias']=hexdec(substr($data,$place,2));$place+=2;//15
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//16
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//17
			$result['Unknown']=hexdec(substr($data,$place,2));$place+=2;//18
			$result['SubjectDistance']=hexdec(substr($data,$place,2));$place+=2;//19
			
		} else if($tag=="0008") { //image number
			if($intel==1) $data = intel2Moto($data);
			$data=hexdec($data);
			$result = round($data/1000)."-".$data%1000;
		
		} else if($tag=="000c") { //camera serial number
			if($intel==1) $data = intel2Moto($data);
			$data=hexdec($data);
			$result = "#".bin2hex(substr($data,0,16)).substr($data,16,16);
		}
		
	} else if($type=="UNDEFINED") {
		
	
		
	} else {
		$data = bin2hex($data);
		if($intel==1) $data = intel2Moto($data);
	}
	
	return $data;
}



//=================
// Cannon Special data section
//====================================================================
function parseCanon($block,&$result,$seek, $globalOffset) {	
	$place = 0; //current place
		
	if($result['Endien']=="Intel") $intel=1;
	else $intel=0;
	
	$model = $result['IFD0']['Model'];
	
		//Get number of tags (2 bytes)
	$num = bin2hex(substr($block,$place,2));$place+=2;
	if($intel==1) $num = intel2Moto($num);
	$result['SubIFD']['MakerNote']['MakerNoteNumTags'] = hexdec($num);
	
	//loop thru all tags  Each field is 12 bytes
	for($i=0;$i<hexdec($num);$i++) {
		
			//2 byte tag
		$tag = bin2hex(substr($block,$place,2));$place+=2;
		if($intel==1) $tag = intel2Moto($tag);
		$tag_name = lookup_Canon_tag($tag);
		
			//2 byte type
		$type = bin2hex(substr($block,$place,2));$place+=2;
		if($intel==1) $type = intel2Moto($type);
		lookup_type($type,$size);
		
			//4 byte count of number of data units
		$count = bin2hex(substr($block,$place,4));$place+=4;
		if($intel==1) $count = intel2Moto($count);
		$bytesofdata = $size*hexdec($count);
		
			//4 byte value of data or pointer to data
		$value = substr($block,$place,4);$place+=4;
		
		if($bytesofdata<=4) {
			$data = $value;
		} else {
			$value = bin2hex($value);
			if($intel==1) $value = intel2Moto($value);
			$v = fseek($seek,$globalOffset+hexdec($value));  //offsets are from TIFF header which is 12 bytes from the start of the file
			if($v==0) {
				$data = fread($seek, $bytesofdata);
			} else if($v==-1) {
				$result['Errors'] = $result['Errors']++;
			}
		}
		$formated_data = formatCanonData($type,$tag,$intel,$data,$result['SubIFD']['MakerNote'][$tag_name]);
		
		if($result['VerboseOutput']==1) {
			//$result['SubIFD']['MakerNote'][$tag_name] = $formated_data;
			if($type=="URATIONAL" || $type=="SRATIONAL" || $type=="USHORT" || $type=="SSHORT" || $type=="ULONG" || $type=="SLONG" || $type=="FLOAT" || $type=="DOUBLE") {
				$data = bin2hex($data);
				if($intel==1) $data = intel2Moto($data);
			}
			$result['SubIFD']['MakerNote'][$tag_name."_Verbose"]['RawData'] = $data;
			$result['SubIFD']['MakerNote'][$tag_name."_Verbose"]['Type'] = $type;
			$result['SubIFD']['MakerNote'][$tag_name."_Verbose"]['Bytes'] = $bytesofdata;
		} else {
			//$result['SubIFD']['MakerNote'][$tag_name] = $formated_data;
		}
	}
}


?>