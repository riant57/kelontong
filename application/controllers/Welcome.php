<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->view('admin/index');
	}
	public function laporan_pdf(){

		$data = array(
			"dataku" => array(
				"nama" => "Petani Kode",
				"url" => "http://petanikode.com"
			)
		);
		$data['users']=array(
			array('firstname'=>'Agung','lastname'=>'Setiawan','email'=>'ag@setiawan.com'),
			array('firstname'=>'Hauril','lastname'=>'Maulida Nisfar','email'=>'hm@setiawan.com'),
			array('firstname'=>'Akhtar','lastname'=>'Setiawan','email'=>'akh@setiawan.com'),
			array('firstname'=>'Gitarja','lastname'=>'Setiawan','email'=>'git@setiawan.com')
		);
	
		$this->load->library('pdf');
	
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-petanikode.pdf";
		$this->pdf->load_view('laporan_pdf', $data);
	
	
	}
	private function is_pangram( $sentence ) {
		// define "alphabet"
		$alpha = range( 'a', 'z' );
		// split lowercased string into array
		$a_sentence = str_split( strtolower( $sentence ) );
		//print_r($a_sentence); 
		echo "<br>";
		echo "<br>";
		// check that there are no letters present in alpha not in sentence
		return empty( array_diff( $alpha, $a_sentence ) );
	}
	function check_pangram(){
		$tests = array(
			"The quick brown fox jumps over the lazy dog.",
		);
		foreach ( $tests as $txt ) {
			echo '"', $txt, '"', PHP_EOL;
			echo $this->is_pangram( $txt ) ? "Yes" : "No";
			echo "<br>";
			echo "<br>";
		}
	}
	
}
