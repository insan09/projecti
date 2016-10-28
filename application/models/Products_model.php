<?php
class Products_model extends CI_Model {
	
	function get_all() {
		
		$results = $this->db->get('produk')->result();
		
		foreach ($results as &$result) {
			
			if ($result->nilai_pilihan) {
				$result->nilai_pilihan = explode(',',$result->nilai_pilihan);
			}
			
		}
		
		return $results;
		
	}
	
	function get($id) {
		
		$results = $this->db->get_where('produk', array('id' => $id))->result();
		$result = $results[0];
		
		if ($result->nilai_pilihan) {
			$result->nilai_pilihan = explode(',',$result->nilai_pilihan);
		}
		
		return $result;
	}

	

	
}
