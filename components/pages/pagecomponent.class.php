<?php
class PageComponent extends Component {
		
		public function __construct() {
			$template = 'pages/'.strtolower(get_class($this));
			
			parent::__construct($template);						
		}	
		
}