<?php
class SS {
	var $app_secret;
	var $app_id;
	var $api_url = 'http://api.socialsender.ru/v1/';
	public function SS($app_id, $app_secret) {
		$this->app_id=$app_id;
		$this->app_secret=$app_secret;
	}
	private function gen_signature($method, $params){
		ksort($params);
		$r = '';
		foreach($params as $k=>$v)$r .= $k.'='.$v;
		return md5($this->app_secret.$method.$r);
	}

	public function api($method, $params=array()) {
		$params['appId'] = $this->app_id;
		$params['t'] = time();
		$params['sig'] = $this->gen_signature($method, $params);
		$res = $this->send($this->api_url.$method, http_build_query($params));
		return json_decode($res, true);
	}
	private function send($url, $data){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$out = curl_exec($curl);
		curl_close($curl);
		return $out;
	}
}