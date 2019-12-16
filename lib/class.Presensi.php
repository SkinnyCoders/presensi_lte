<?php 
/**
 * @skinny_coders
 */

 /**
  * use example 
  * $presensi = new Presensi();
  * @ip 	$presensi->ip = 'your_ip_device';
  * @key  	$presensi->key = 'your_key_device';
  *
  */

class Presensi
{
	// public $ip = "192.168.1.201"; //ip device
	// public $key = 1; //key device
	
	public function getDataPresensi(){
		//koneksi ke port mesin fingerprint yang ada
		$Connect = @fsockopen($this->ip, "80", $errno, $errstr, 1);

		if(is_resource($Connect)) {
			//permintaan API
			$soap_request = "<GetAttLog>
			<ArgComKey xsi:type=\"xsd:integer\">".$this->key."</ArgComKey>
			<Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg>
			</GetAttLog>";

			//end of line
			$newLine = "\r\n";

			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			fputs($Connect, "Content-Type: text/xml".$newLine);
			fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			fputs($Connect, $soap_request.$newLine);
			$buffer = '';
			while ($Response = fgets($Connect, 1024)) {
				$buffer = $buffer.$Response;
            }
            
            $buffer = $this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
		    $buffer = explode("\r\n", $buffer);

		    for ($i=0; $i < count($buffer) ; $i++) { 
			    $data = $this->Parse_Data($buffer[$i], "<Row>","</Row>");

                $export[$i]['id'] = $this->Parse_Data($data, "<PIN>","</PIN>");
                $export[$i]['waktu'] = $this->Parse_Data($data, "<DateTime>", "</DateTime>");
                $export[$i]['status'] = $this->Parse_Data($data, "<Status>","</Status>");
		    }

            return $export;
        
		}else{
            $data['error'] = TRUE;
            $data['msg'] = $errstr;
			return $data;
		}
	}

	public function ClearData(){
		$Connect = @fsockopen($this->ip, "80", $errno, $errstr, 1);
		if(is_resource($Connect)){
			$soap_request="<ClearData><ArgComKey xsi:type=\"xsd:integer\">".$this->key."</ArgComKey><Arg><Value xsi:type=\"xsd:integer\">3</Value></Arg></ClearData>";
			$newLine="\r\n";
			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			fputs($Connect, "Content-Type: text/xml".$newLine);
			fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			fputs($Connect, $soap_request.$newLine);
			$buffer="";
			while($Response=fgets($Connect, 1024)){
				$buffer=$buffer.$Response;
			}
		}else{
			$data['error'] = TRUE;
            $data['msg'] = $errstr;
            return $data;
		}

		$buffer=$this->Parse_Data($buffer,"<Information>","</Information>");
		return $buffer;
	}

	public function DownloadSidikJari($id,$fn){
		$Connect = @fsockopen($this->ip, "80", $errno, $errstr, 1);
		if(is_resource($Connect)){
			$soap_request="<GetUserTemplate><ArgComKey xsi:type=\"xsd:integer\">".$this->key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">".$id."</PIN><FingerID xsi:type=\"xsd:integer\">".$fn."</FingerID></Arg></GetUserTemplate>";
			$newLine="\r\n";
			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			fputs($Connect, "Content-Type: text/xml".$newLine);
			fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			fputs($Connect, $soap_request.$newLine);
			$buffer="";
			while($Response=fgets($Connect, 1024)){
				$buffer=$buffer.$Response;
			}
		}else{
            $data['error'] = TRUE;
            $data['msg'] = $errstr;
            return $data;
        }
		
		$buffer=$this->Parse_Data($buffer,"<GetUserTemplateResponse>","</GetUserTemplateResponse>");
		$buffer=explode("\r\n",$buffer);
		
		for($a=0;$a<count($buffer);$a++){
				
			$data=$this->Parse_Data($buffer[$a],"<Row>","</Row>");
			
			$export[$a]['pin']=$this->Parse_Data($data,"<PIN>","</PIN>");
			$export[$a]['finger_id']=$this->Parse_Data($data,"<FingerID>","</FingerID>");
			$export[$a]['size']=$this->Parse_Data($data,"<Size>","</Size>");
			$export[$a]['valid']=$this->Parse_Data($data,"<Valid>","</Valid>");
			$export[$a]['template']=$this->Parse_Data($data,"<Template>","</Template>");
		}

		return $export;
    }
    
    public function UploadNama($id,$nama){
        $Connect = @fsockopen($this->ip, "80", $errno, $errstr, 1);
        if(is_resource($Connect)){
            $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$this->key."</ArgComKey><Arg><PIN>".$id."</PIN><Name>".$nama."</Name></Arg></SetUserInfo>";
            $newLine="\r\n";
            fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
            fputs($Connect, "Content-Type: text/xml".$newLine);
            fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
            fputs($Connect, $soap_request.$newLine);
            $buffer="";
            while($Response=fgets($Connect, 1024)){
                $buffer=$buffer.$Response;
            }
        }else{
            $data['error'] = TRUE;
            $data['msg'] = $errstr;
            return $data;
        }

        $buffer=$this->Parse_Data($buffer,"<Information>","</Information>");
        return $buffer;
	}
	
	public function getSiswa($id){
		$Connect = @fsockopen($this->ip, "80", $errno, $errstr, 1);

		if(is_resource($Connect)){
			$soap_request = "<GetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$this->key."</ArgComKey><Arg><PIN Xsi:type=\"xsd:integer\">".$id."</PIN></Arg></GetUserInfo>";

			$newLine="\r\n";
			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			fputs($Connect, "Content-Type: text/xml".$newLine);
			fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			fputs($Connect, $soap_request.$newLine);
			$buffer="";
			while($Response=fgets($Connect, 1024)){
				$buffer=$buffer.$Response;
			}
		}else{
            $data['error'] = TRUE;
            $data['msg'] = $errstr;
            return $data;
        }

		$buffer=$this->Parse_Data($buffer,"<GetUserInfoResponse>","</GetUserInfoResponse>");
		$buffer=explode("\r\n",$buffer);

		for($a=0;$a<count($buffer);$a++){
				
			$data=$this->Parse_Data($buffer[1],"<Row>","</Row>");
			
			$export['pin']=$this->Parse_Data($data,"<PIN>","</PIN>");
			$export['name']=$this->Parse_Data($data,"<Name>","</Name>");
		}

		return $export;

	}

	public function Parse_Data($data, $p1, $p2){
		$data = ' '.$data;
		$hasil = "";
		$awal = strpos($data, $p1);
		if ($awal != "") {
			$akhir = strpos(strstr($data, $p1), $p2);
			if ($akhir != "") {
				$hasil = substr($data, $awal+strlen($p1), $akhir-strlen($p1));
			}
		}
		return $hasil;
	}
}

 ?>