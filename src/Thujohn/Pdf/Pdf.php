<?php namespace Thujohn\Pdf;

class Pdf {
	protected $dompdf;
	protected $html;
	protected $size;
	protected $orientation;

	public function __construct(){
		$this->dompdf = new \DOMPDF();
	}

	public function load($html, $size = 'A4', $orientation = 'portrait'){
		$this->html = $html;
		$this->size = $size;
		$this->orientation = $orientation;

		$this->dompdf->load_html($this->html);
		$this->setPaper($this->size, $this->orientation);

		return $this;
	}

	private function setPaper($size, $orientation){
		return $this->dompdf->set_paper($size, $orientation);
	}

	private function render(){
		return $this->dompdf->render();
	}

	public function show($options = array('compress' => 1, 'Attachment' => 0)){
		$this->render();
		return $this->dompdf->stream('dompdf_out.pdf', $options);
	}

	public function download($filename = 'dompdf_out', $options = array('compress' => 1, 'Attachment' => 1)){
		$this->render();
		return $this->dompdf->stream($filename.'.pdf', $options);
	}
}