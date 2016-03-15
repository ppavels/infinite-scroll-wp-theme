<?php 
/**
*@var elements, attributes
*$exemple input, array('type'=>'text', 'id'=>'test', 'class'=>'value1 value2')
*/

class HTMLElements{
	
	private $element, $attributes;
	
	public function __constructor(){/*nothing to decalre */	}
	
	
	public function getElement($element, $attributes=array()){
		$this->element=$element;
		$this->attributes=$attributes;
		switch($this->element){
			case 'input':
			return $this->getInput();
			break;
			default:
			return $this->throughtError(4001);
			
		}
	}
	
	private function getInput(){
		$type=$this->getValue('type');
		
		switch ($type){
			case 'text':
			echo $this->getInputText();
			break;
		}
		
		
	}
	
	private function getInputText(){
	
    $attributes=$this->buildAttibutes();
    
    return "<input ".$attributes." />"; 
		
		
	 }
	
	private function buildAttibutes(){
		
		foreach ($this->attributes as $key=>$val){
			$attributes[]=$key.'="'.$val.'"';
		}
		
		$attributestoadd=" ".implode($attributes, ' ');
		return $attributestoadd;
	}
	
	private function getValue($attribute){
		
		//echo print_r($this->attributes,TRUE);
		foreach ($this->attributes as $key=>$val){
			if($key==$attribute){
				$value= $val;
				
			}
		}
		if(empty($value)){
			return $this->throughtError(4002);
		}
		else{
			return $value;
		}
		
		
		
	}
	
	private function throughtError($code){
		if($code==4001){
		return 'No Element Found';
		}
		else if($code==4002){
		return 'No Type Found';
		}
		else{
		return 'Error Code is Not Valid';
		}
		
	}
	
}


?>