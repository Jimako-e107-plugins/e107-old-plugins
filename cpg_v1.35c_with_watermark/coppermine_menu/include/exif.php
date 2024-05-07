<?php
//================================================================================================
//================================================================================================
//================================================================================================
/*
	Exifer 1.2
	Released Mar 30, 2003 by Jake Olefsky
	http://www.offsky.com/software/exif/index.php
	jake@olefsky.com

	This software is free to use and modify for non-commercial purposes only.  For commercial use
	of this software please contact me.
	
	If you improve this script or test it with a camera not on my list, please email me a copy of
	the improvement so everyone can benefit from it.  Thanks! 
	
	SUMMARY:
				This script will correctly parse all of the EXIF data included in images taken
				with digital cameras.  It will read the IDF0, IDF1, SubIDF and InteroperabilityIFD
				fields as well as parsing some of the MakerNote fields that vary depending on
				camera make and model.  This script parses more tags than the internal PHP exif
				implementation and it will correctly identify and decode what all the values mean.
				
				This version will correctly parse the MakerNote field for Nikon, Olympus, and Canon 
				digital cameras.  Others will follow.
				
	TESTED WITH:
				Nikon CoolPix 700
				Nikon CoolPix 4500
				Nikon CoolPix 950
				Canon PowerShot S200
				Canon PowerShot S110
				Olympus C2040Z 
				Olympus C960
				Canon Ixus
				FujiFilm DX 10
				FujiFilm MX-1200
				FujiFilm FinePix2400
				FujiFilm FinePix2600
				FujiFilm FinePix S602
				FujiFilm FinePix40i
				Sony D700
				Sony Cybershot
				Kodak DC210
				Kodak DC240
				Ricoh RDC-5300 
				Sanyo VPC-G250
				Sanyo VPC-SX550
	
	VERSION HISTORY:
	
	1.0 	Sept 23, 2002 	
	
			First Public Release
	
	1.1		Jan 25, 2003
		
			+Gracefully handled the error case where you pass an empty string to this library
			+Fixed an inconsistency in the Olympus Camera parsing module
			+Added support for parsing the MakerNote of Canon images.
			+Modified how the imagefile is opened so it works for windows machines.
			+Correctly parses the FocalPlaneResolutionUnit and PhotometricInterpretation fields
			+Negative rational numbers are properly displayed
			+Strange old cameras that use Motorola endineness are now properly supported
			+Tested with several more cameras
			
			Potential Problem: Negative Shorts and Negative Longs may not be correctly displayed, but I
				have not yet found an example of negative shorts or longs being used.
	
	1.2		Mar 30, 2003
	
			+Fixed an error that was displayed if you edited your image with WinXP's image viewer
			+Fixed a bug that caused some images saved from 3rd party software to not parse correctly
			+Changed the ExposureTime tag to display in fractional seconds rather than decimal
			+Updated the ShutterSpeedValue tag to have the units of 'sec'
			+Added support for parsing the MakeNote of FujiFilm images
			+Added support for parsing the MakeNote of Sanyo images
			+Fixed a bug with parsing some Olympus MakerNote tags
			+Tested with several more cameras
			
*/
//================================================================================================
//================================================================================================
//================================================================================================


	include(e_PLUGIN."coppermine_menu/include/makers/nikon.php");
	include(e_PLUGIN."coppermine_menu/include/makers/olympus.php");
	include(e_PLUGIN."coppermine_menu/include/makers/canon.php");
	include(e_PLUGIN."coppermine_menu/include/makers/fujifilm.php");
	include(e_PLUGIN."coppermine_menu/include/makers/sanyo.php");


//================================================================================================
//================================================================================================
// Converts from Intel to Motorola endien.  Just reverses the bytes (assumes hex is passed in)
//================================================================================================
//================================================================================================
function intel2Moto($intel) {
	$len = strlen($intel);
	$moto="";
	for($i=0; $i<=$len; $i+=2) {
		$moto.=substr($intel,$len-$i,2);
	}
	return $moto;
}

//================================================================================================
//================================================================================================
// Looks up the name of the tag
//================================================================================================
//================================================================================================
function lookup_tag($tag) {
	switch($tag) {
	
			//used by IFD0
		case "010e": $tag = "ImageDescription";break;
		case "010f": $tag = "Make";break;
		case "0110": $tag = "Model";break;
		case "0112": $tag = "Orientation";break;
		case "011a": $tag = "xResolution";break;
		case "011b": $tag = "yResolution";break;
		case "0128": $tag = "ResolutionUnit";break;
		case "0131": $tag = "Software";break;
		case "0132": $tag = "DateTime";break;
		case "013e": $tag = "WhitePoint";break;
		case "013f": $tag = "PrimaryChromaticities";break;
		case "0211": $tag = "YCbCrCoefficients";break;
		case "0213": $tag = "YCbCrPositioning";break;
		case "0214": $tag = "ReferenceBlackWhite";break;
		case "8298": $tag = "Copyright";break;
		case "8769": $tag = "ExifOffset";break;
		
			//used by Exif SubIFD
		case "829a": $tag = "ExposureTime";break;
		case "829d": $tag = "FNumber";break;
		case "8822": $tag = "ExposureProgram";break;
		case "8827": $tag = "ISOSpeedRatings";break;
		case "9000": $tag = "ExifVersion";break;
		case "9003": $tag = "DateTimeOriginal";break;
		case "9004": $tag = "DateTimedigitized";break;
		case "9101": $tag = "ComponentsConfiguration";break;
		case "9102": $tag = "CompressedBitsPerPixel";break;
		case "9201": $tag = "ShutterSpeedValue";break;
		case "9202": $tag = "ApertureValue";break;
		case "9203": $tag = "BrightnessValue";break;
		case "9204": $tag = "ExposureBiasValue";break;
		case "9205": $tag = "MaxApertureValue";break;
		case "9206": $tag = "SubjectDistance";break;
		case "9207": $tag = "MeteringMode";break;
		case "9208": $tag = "LightSource";break;
		case "9209": $tag = "Flash";break;
		case "920a": $tag = "FocalLength";break;
		case "927c": $tag = "MakerNote";break;
		case "9286": $tag = "UserComment";break;
		case "9290": $tag = "SubsecTime";break;
		case "9291": $tag = "SubsecTimeOriginal";break;
		case "9292": $tag = "SubsecTimeDigitized";break;
		case "a000": $tag = "FlashPixVersion";break;
		case "a001": $tag = "ColorSpace";break;
		case "a002": $tag = "ExifImageWidth";break;
		case "a003": $tag = "ExifImageHeight";break;
		case "a004": $tag = "RelatedSoundFile";break;
		case "a005": $tag = "ExifInteroperabilityOffset";break;
		case "a20e": $tag = "FocalPlaneXResolution";break;
		case "a20f": $tag = "FocalPlaneYResolution";break;
		case "a210": $tag = "FocalPlaneResolutionUnit";break;
		case "a215": $tag = "ExposureIndex";break;
		case "a217": $tag = "SensingMethod";break;
		case "a300": $tag = "FileSource";break;
		case "a301": $tag = "SceneType";break;
		case "a302": $tag = "CFAPattern";break;
		
			//used by Interoperability IFD
		case "0001": $tag = "InteroperabilityIndex";break;
		case "0002": $tag = "InteroperabilityVersion";break;
		case "1000": $tag = "RelatedImageFileFormat";break;
		case "1001": $tag = "RelatedImageWidth";break;
		case "1002": $tag = "RelatedImageLength";break;
		
			//used by IFD1
		case "0100": $tag = "ImageWidth";break;
		case "0101": $tag = "ImageLength";break;
		case "0102": $tag = "BitsPerSample";break;
		case "0103": $tag = "Compression";break;
		case "0106": $tag = "PhotometricInterpretation";break;
		case "0111": $tag = "StripOffsets";break;
		case "0115": $tag = "SamplesPerPixel";break;
		case "0116": $tag = "RowsPerStrip";break;
		case "0117": $tag = "StripByteCounts";break;
		case "011c": $tag = "PlanarConfiguration";break;
		case "0201": $tag = "JpegIFOffset";break;
		case "0202": $tag = "JpegIFByteCount";break;
		case "0212": $tag = "YCbCrSubSampling";break;
		
			//misc
		case "00fe": $tag = "NewSubfileType";break;
		case "00ff": $tag = "SubfileType";break;
		case "012d": $tag = "TransferFunction";break;
		case "013b": $tag = "Artist";break;
		case "013d": $tag = "Predictor";break;
		case "0142": $tag = "TileWidth";break;
		case "0143": $tag = "TileLength";break;
		case "0144": $tag = "TileOffsets";break;
		case "0145": $tag = "TileByteCounts";break;
		case "014a": $tag = "SubIFDs";break;
		case "015b": $tag = "JPEGTables";break;
		case "828d": $tag = "CFARepeatPatternDim";break;
		case "828e": $tag = "CFAPattern";break;
		case "828f": $tag = "BatteryLevel";break;
		case "83bb": $tag = "IPTC/NAA";break;
		case "8773": $tag = "InterColorProfile";break;
		case "8824": $tag = "SpectralSensitivity";break;
		case "8825": $tag = "GPSInfo";break;
		case "8828": $tag = "OECF";break;
		case "8829": $tag = "Interlace";break;
		case "882a": $tag = "TimeZoneOffset";break;
		case "882b": $tag = "SelfTimerMode";break;
		case "920b": $tag = "FlashEnergy";break;
		case "920c": $tag = "SpatialFrequencyResponse";break;
		case "920d": $tag = "Noise";break;
		case "9211": $tag = "ImageNumber";break;
		case "9212": $tag = "SecurityClassification";break;
		case "9213": $tag = "ImageHistory";break;
		case "9214": $tag = "SubjectLocation";break;
		case "9215": $tag = "ExposureIndex";break;
		case "9216": $tag = "TIFF/EPStandardID";break;
		case "a20b": $tag = "FlashEnergy";break;
		case "a20c": $tag = "SpatialFrequencyResponse";break;
		case "a214": $tag = "SubjectLocation";break;
		
		default: $tag = "unknown:".$tag;break;
	}
	return $tag;

}

//================================================================================================
//================================================================================================
// Looks up the datatype
//================================================================================================
//================================================================================================
function lookup_type(&$type,&$size) {
	switch($type) {
		case "0001": $type = "UBYTE";$size=1;break;
		case "0002": $type = "ASCII";$size=1;break;
		case "0003": $type = "USHORT";$size=2;break;
		case "0004": $type = "ULONG";$size=4;break;
		case "0005": $type = "URATIONAL";$size=8;break;
		case "0006": $type = "SBYTE";$size=1;break;
		case "0007": $type = "UNDEFINED";$size=1;break;
		case "0008": $type = "SSHORT";$size=2;break;
		case "0009": $type = "SLONG";$size=4;break;
		case "000a": $type = "SRATIONAL";$size=8;break;
		case "000b": $type = "FLOAT";$size=4;break;
		case "000c": $type = "DOUBLE";$size=8;break;
		default: $type = "error:".$type;$size=0;break;
	}
	return $type;
}

//================================================================================================
//================================================================================================
// Formats Data for the data type
//================================================================================================
//================================================================================================
function formatData($type,$tag,$intel,$data) {

	if($type=="ASCII") {
		//do nothing
	} else if($type=="URATIONAL" || $type=="SRATIONAL") {
		$data = bin2hex($data);
		if($intel==1) $data = intel2Moto($data);
		
		if($intel==1) $top = hexdec(substr($data,8,8)); 	//intel stores them bottom-top
		else  $top = hexdec(substr($data,0,8));				//motorola stores them top-bottom
		
		if($intel==1) $bottom = hexdec(substr($data,0,8));	//intel stores them bottom-top
		else  $bottom = hexdec(substr($data,8,8));			//motorola stores them top-bottom
		
		if($type=="SRATIONAL" && $top>2147483648) $top = $top - 4294967296;		//this makes the number signed instead of unsigned
		if($bottom!=0) $data=$top/$bottom;
		else if($top==0) $data = 0;
		else $data=$top."/".$bottom;
		
		if(($tag=="011a" || $tag=="011b") && $bottom==1) { //XResolution YResolution
			$data=$top." dots per ResolutionUnit";
		} else if($tag=="829a") { //Exposure Time
			$data=$top."/".$bottom." sec";
		} else if($tag=="829d") { //FNumber
			$data="f ".$data;
		} else if($tag=="9204") { //ExposureBiasValue
			$data=$data." EV";
		} else if($tag=="9205" || $tag=="9202") { //AperatureValue and MaxAperatureValue
			$data="f ".$data; //pow(2,($data/2));  //somewhere I saw that this was the real equation.  is it?
		} else if($tag=="920a") { //FocalLength
			$data=$data." mm";
		} else if($tag=="9201") { //ShutterSpeedValue
			$data=$data." sec";//$data="1/".pow(2,$data)." sec";  //This may be more correct, I dont know
		} 
		
	} else if($type=="USHORT" || $type=="SSHORT" || $type=="ULONG" || $type=="SLONG" || $type=="FLOAT" || $type=="DOUBLE") {
		$data = bin2hex($data);
		if($intel==1) $data = intel2Moto($data);
		if($intel==0 && ($type=="USHORT" || $type=="SSHORT")) $data = substr($data,0,4);
		$data=hexdec($data);
		
		if($tag=="0112") { //Orientation
			if($data==1) $data = "Normal (O deg)";
			if($data==2) $data = "Mirrored";
			if($data==3) $data = "Upsidedown";
			if($data==4) $data = "Upsidedown Mirrored";
			if($data==5) $data = "90 deg CW Mirrored";
			if($data==6) $data = "90 deg CCW";
			if($data==7) $data = "90 deg CCW Mirrored";
			if($data==8) $data = "90 deg CW";
		} else if($tag=="0128" || $tag=="a210") {  //ResolutionUnit and FocalPlaneResolutionUnit
			if($data==1) $data = "No Unit";
			if($data==2) $data = "Inch";
			if($data==3) $data = "Centimeter";
		} else if($tag=="0213") { //YCbCrPositioning
			if($data==1) $data = "Center of Pixel Array";
			if($data==2) $data = "Datum Point";
		} else if($tag=="8822") { //ExposureProgram
			if($data==1) $data = "Manual";
			else if($data==2) $data = "Program";
			else if($data==3) $data = "Aperature Priority";
			else if($data==4) $data = "Shutter Priority";
			else if($data==5) $data = "Program Creative";
			else if($data==6) $data = "Program Action";
			else if($data==7) $data = "Portrat";
			else if($data==8) $data = "Landscape";
			else $data = "Unknown: ".$data;
		} else if($tag=="9207") { //MeteringMode
			if($data==0) $data = "Unknown";
			else if($data==1) $data = "Average";
			else if($data==2) $data = "Center Weighted Average";
			else if($data==3) $data = "Spot";
			else if($data==4) $data = "Multi-Spot";
			else if($data==5) $data = "Multi-Segment";
			else if($data==6) $data = "Partial";
			else if($data==255) $data = "Other";
			else $data = "Unknown: ".$data;
		} else if($tag=="9208") { //LightSource
			if($data==0) $data = "Unknown or Auto";
			else if($data==1) $data = "Daylight";
			else if($data==2) $data = "Flourescent";
			else if($data==3) $data = "Tungsten";
			else if($data==10) $data = "Flash";
			else if($data==17) $data = "Standard Light A";
			else if($data==18) $data = "Standard Light B";
			else if($data==19) $data = "Standard Light C";
			else if($data==20) $data = "D55";
			else if($data==21) $data = "D65";
			else if($data==22) $data = "D75";
			else if($data==255) $data = "Other";
			else $data = "Unknown: ".$data;
		} else if($tag=="9209") { //Flash
			if($data==0) $data = "No Flash";
			else if($data==1) $data = "Flash";
			else if($data==5) $data = "Flash but no strobe return light detected";
			else if($data==7) $data = "Flash and strob return light detected";
			else if($data==9) $data = "Flash";
			else if($data==16) $data = "No Flash";
			else if($data==89) $data = "Red Eye";
			else $data = "Unknown: ".$data;
		} else if($tag=="a001") { //ColorSpace
			if($data==1) $data = "sRGB";
			else $data = "Uncalibrated";
		} else if($tag=="a002" || $tag=="a003") { //ExifImageWidth/Height
			$data = $data. " pixels";
		} else if($tag=="0103") { //Compression
			if($data==1) $data = "No Compression";
			else if($data==6) $data = "Jpeg Compression";
			else $data = "Unknown: ".$data;
		} else if($tag=="a217") { //SensingMethod
			if($data==2) $data = "1 Chip Color Area Sensor";
			else $data = "Unknown: ".$data;
		} else if($tag=="0106") { //PhotometricInterpretation
			if($data==1) $data = "Monochrome";
			else if($data==2) $data = "RGB";
			else if($data==6) $data = "YCbCr";
			else $data = "Unknown: ".$data;
		}
	
	} else if($type=="UNDEFINED") {
		
		if($tag=="9000" || $tag=="a000" || $tag=="0002") { //ExifVersion,FlashPixVersion,InteroperabilityVersion
			$data="version ".$data/100;
		}
		if($tag=="a300") { //FileSource
			$data = bin2hex($data);
			$data	= str_replace("00","",$data);
			$data	= str_replace("03","Digital Still Camera",$data);
		}
		if($tag=="a301") { //SceneType
			$data = bin2hex($data);
			$data	= str_replace("00","",$data);
			$data	= str_replace("01","Directly Photographed",$data);
		}
		if($tag=="9101") {	//ComponentsConfiguration
			$data = bin2hex($data);
			$data	= str_replace("01","Y",$data);
			$data	= str_replace("02","Cb",$data);
			$data	= str_replace("03","Cr",$data);
			$data	= str_replace("04","R",$data);
			$data	= str_replace("05","G",$data);
			$data	= str_replace("06","B",$data);
			$data	= str_replace("00","",$data);
		}
	} else {
		$data = bin2hex($data);
		if($intel==1) $data = intel2Moto($data);
	}
	
	return $data;
}

//================================================================================================
//================================================================================================
// Reads one standard IFD entry
//================================================================================================
//================================================================================================
function read_entry(&$result,$in,$seek,$intel,$ifd_name,$globalOffset) {
	
	//2 byte tag
	$tag = bin2hex(fread( $in, 2 ));
	if($intel==1) $tag = intel2Moto($tag);
	$tag_name = lookup_tag($tag);
	
	//2 byte datatype
	$type = bin2hex(fread( $in, 2 ));
	if($intel==1) $type = intel2Moto($type);
	lookup_type($type,$size);
	
	//4 byte number of elements
	$count = bin2hex(fread( $in, 4 ));
	if($intel==1) $count = intel2Moto($count);
	$bytesofdata = $size*hexdec($count);
	
	//4 byte value or pointer to value if larger than 4 bytes
	$value = fread( $in, 4 );
	
	if($bytesofdata<=4) { 	//if datatype is 4 bytes or less, its the value
		$data = $value;
	} else {				//otherwise its a pointer to the value, so lets go get it
		$value = bin2hex($value);
		if($intel==1) $value = intel2Moto($value);
		$v = fseek($seek,$globalOffset+hexdec($value));  //offsets are from TIFF header which is 12 bytes from the start of the file
		if($v==0) {
			$data = fread($seek, $bytesofdata);
		} else if($v==-1) {
			$result['Errors'] = $result['Errors']++;
		}
	}
	if($tag_name=="MakerNote") { //if its a maker tag, we need to parse this specially
		$make = $result['IFD0']['Make'];
		
		if($result['VerboseOutput']==1) {
			$result[$ifd_name]['MakerNote']['RawData'] = $data;
		}
		if($make=="NIKON\0") {
			parseNikon($data,$result);
			$result[$ifd_name]['KnownMaker'] = 1;
		} else if(eregi("OLYMPUS",$make)) {
			parseOlympus($data,$result,$seek,$globalOffset);
			$result[$ifd_name]['KnownMaker'] = 1;
		} else if(eregi("Canon",$make)) {
			parseCanon($data,$result,$seek,$globalOffset);
			$result[$ifd_name]['KnownMaker'] = 1;
		} else if(eregi("FUJIFILM",$make)) {
			parseFujifilm($data,$result);
			$result[$ifd_name]['KnownMaker'] = 1;
		} else if(eregi("SANYO",$make)) {
			parseSanyo($data,$result,$seek,$globalOffset);
			$result[$ifd_name]['KnownMaker'] = 1;
		} else {
			$result[$ifd_name]['KnownMaker'] = 0;
		}
	} else {
		//Format the data depending on the type and tag
		$formated_data = formatData($type,$tag,$intel,$data);
		
		$result[$ifd_name][$tag_name] = $formated_data;
		
		if($result['VerboseOutput']==1) {
			if($type=="URATIONAL" || $type=="SRATIONAL" || $type=="USHORT" || $type=="SSHORT" || $type=="ULONG" || $type=="SLONG" || $type=="FLOAT" || $type=="DOUBLE") {
				$data = bin2hex($data);
				if($intel==1) $data = intel2Moto($data);
			}
			$result[$ifd_name][$tag_name."_Verbose"]['RawData'] = $data;
			$result[$ifd_name][$tag_name."_Verbose"]['Type'] = $type;
			$result[$ifd_name][$tag_name."_Verbose"]['Bytes'] = $bytesofdata;
		}
	}
}

//================================================================================================
//================================================================================================
// Pass in a file and this reads the EXIF data
//
// Usefull resources
// http://www.ba.wakwak.com/~tsuruzoh/Computer/Digicams/exif-e.html
// http://www.w3.org/Graphics/JPEG/jfif.txt
// http://exif.org/
//================================================================================================
//================================================================================================
function read_exif_data_raw($path,$verbose) {
	
	if($path=='' || $path=='none') return;
	
	$in = fopen($path, "rb"); //the b is for windows machines to open in binary mode
	$seek = fopen($path, "rb"); //There may be an elegant way to do this with one file handle.
	
	$globalOffset = 0;
	
	if(!isset($verbose)) $verbose=0;
	
	$result['VerboseOutput'] = $verbose;
	$result['Errors'] = 0;
	
	//First 2 bytes of JPEG are 0xFFD8 
	$data = bin2hex(fread( $in, 2 ));
	if($data=="ffd8") {
		$result['ValidJpeg'] = 1;
	} else {
		$result['ValidJpeg'] = 0;
		fclose($in);
		fclose($seek);
		return $result;
	}	
	
	
	//Next 2 bytes are MARKER tag (0xFFE#)
	$data = bin2hex(fread( $in, 2 ));
	if($data=="ffe0") {
		$result['ValidJFIFData'] = 1;
		$size = bin2hex(fread( $in, 2 ));
		$result['JFIF']['Size'] = hexdec($size);
		$ident = fread( $in, 5 );
		$result['JFIF']['Identifier'] = $ident;
		$code = fread( $in, 1 );
		$result['JFIF']['ExtensionCode'] =  bin2hex($code);
		
		$data = fread( $in, hexdec($size)-8 );
		$result['JFIF']['Data'] = $data;
		$globalOffset+=hexdec($size)+2;
		
		$data = bin2hex(fread( $in, 2 ));
	} else {
		$result['ValidJFIFData'] = 0;
	}
	
	if($data=="ffe1") {
		$result['ValidEXIFData'] = 1;
	} else {
		$result['ValidEXIFData'] = 0;
		fclose($in);
		fclose($seek);
		return $result;
	}
	
	//Size of APP1 
	$size = bin2hex(fread( $in, 2 ));
	$result['APP1Size'] = hexdec($size);
	
	//Start of APP1 block starts with "Exif" header (6 bytes)
	$header = fread( $in, 6 );
	
	//Then theres a TIFF header with 2 bytes of endieness (II or MM) 
	$header = fread( $in, 2 );
	if($header==="II") {
		$intel=1;
		$result['Endien'] = "Intel";
	} else if($header==="MM") {
		$intel=0;
		$result['Endien'] = "Motorola";
	}
	
	//2 bytes of 0x002a
	$tag = bin2hex(fread( $in, 2 ));
	
	//Then 4 bytes of offset to IFD0 (usually 8 which includes all 8 bytes of TIFF header)
	$offset = bin2hex(fread( $in, 4 ));
	if($intel==1) $offset = intel2Moto($offset);
	if(hexdec($offset)>8) $unknown = fread( $in, hexdec($offset)-8); //fixed this bug in 1.3
	
	//add 12 to the offset to account for TIFF header
	$globalOffset+=12;
	
	
	//===========================================================Start of IFD0
	$num = bin2hex(fread( $in, 2 ));
	if($intel==1) $num = intel2Moto($num);
	$result['IFD0NumTags'] = hexdec($num);
	
	for($i=0;$i<hexdec($num);$i++) {
		read_entry($result,$in,$seek,$intel,"IFD0",$globalOffset);
	}
	
	//store offset to IFD1
	$offset = bin2hex(fread( $in, 4 ));
	if($intel==1) $offset = intel2Moto($offset);
	$result['IFD1Offset'] = hexdec($offset);
	
	//Check for SubIFD
	if(!isset($result['IFD0']['ExifOffset']) || $result['IFD0']['ExifOffset']==0) {
		fclose($in);
		fclose($seek);
		return $result;
	}
	
	//seek to SubIFD (Value of ExifOffset tag) above.
	$ExitOffset = $result['IFD0']['ExifOffset'];
	$v = fseek($in,$globalOffset+$ExitOffset);
	if($v==-1) {
		$result['Errors'] = $result['Errors']++;
	}
	
	//===========================================================Start of SubIFD
	$num = bin2hex(fread( $in, 2 ));
	if($intel==1) $num = intel2Moto($num);
	$result['SubIFDNumTags'] = hexdec($num);
	
	for($i=0;$i<hexdec($num);$i++) {
		read_entry($result,$in,$seek,$intel,"SubIFD",$globalOffset);
	}
	
	//Check for IFD1
	if(!isset($result['IFD1Offset']) || $result['IFD1Offset']==0) {
		fclose($in);
		fclose($seek);
		return $result;
	}
	//seek to IFD1
	$v = fseek($in,$globalOffset+$result['IFD1Offset']);
	if($v==-1) {
		$result['Errors'] = $result['Errors']++;
	}
	
	//===========================================================Start of IFD1
	$num = bin2hex(fread( $in, 2 ));
	if($intel==1) $num = intel2Moto($num);
	$result['IFD1NumTags'] = hexdec($num);
	
	for($i=0;$i<hexdec($num);$i++) {
		read_entry($result,$in,$seek,$intel,"IFD1",$globalOffset);
	}
	
	//if verbose output is on, stick in the thumbnail raw data	
	if($result['VerboseOutput']==1 && $result['IFD1']['JpegIFOffset']>0 && $result['IFD1']['JpegIFByteCount']>0) {
			$v = fseek($seek,$globalOffset+$result['IFD1']['JpegIFOffset']);
			if($v==0) {
				$data = fread($seek, $result['IFD1']['JpegIFByteCount']);
			} else if($v==-1) {
				$result['Errors'] = $result['Errors']++;
			}
			$result['IFD1']["ThumbnailData"] = $data;
	} 
	
	
	//Check for Interoperability IFD
	if(!isset($result['SubIFD']['ExifInteroperabilityOffset']) || $result['SubIFD']['ExifInteroperabilityOffset']==0) {
		fclose($in);
		fclose($seek);
		return $result;
	}
	//seek to InteroperabilityIFD
	$v = fseek($in,$globalOffset+$result['SubIFD']['ExifInteroperabilityOffset']);
	if($v==-1) {
		$result['Errors'] = $result['Errors']++;
	}
	
	//===========================================================Start of InteroperabilityIFD
	$num = bin2hex(fread( $in, 2 ));
	if($intel==1) $num = intel2Moto($num);
	$result['InteroperabilityIFDNumTags'] = hexdec($num);
	
	
	for($i=0;$i<hexdec($num);$i++) {
		read_entry($result,$in,$seek,$intel,"InteroperabilityIFD",$globalOffset);
	}

	fclose($in);
	fclose($seek);
	return $result;
}	
?>