<?php


use
	GoodSend\Catalog\Product\CustomCard\Collection
		as CustomCardCol,
	GoodSend\Catalog\Product\CustomCard\Object
		as CustomCardObj,
	GoodSend\Catalog\Product\CustomCard\Field\Object
		as CustomCardFieldObj,
	GoodSend\Catalog\Product\CustomCard\Card\Object
		as CardObj
;

class RestApiSessionUserCustomCards extends RestApi {
	
	protected 
		$id
		, $fileName
	;
	public function get( $params = array() ){
		// backward compatibility
		if( isset($params['GET']) ){
			$params = $params['GET'];
		}

		// no id is 404
		if( ! $this->getId() ) {
			throw new \Exception(
				"404: Not Found",
				404
			);
		}
		// no customer id is 403
		else if( ! $this->getOwner()->getId() ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}
		else {
			$col = new CustomCardCol();
			
			// on the frontend, we only allow active card templates
			$params['filters']['status'] = 1;
			
			// users can only access their own cards
			$params['filters']['customer_id'] = $this->getOwner()->getId();
			
			$this->applyFilters($col, $params);
			$this->applyLimit($col, $params);
			$this->applySortBy($col, $params);
				
			return $this->getReturn($col, $params);
		}
		
	}
	
	public function post( $params = array() ){
		// backward compatibility
		if( isset($params['POST']) ){
			$params = $params['POST'];
		}
		$customerId = $this->getOwner()->getId();
		if ( ! $customerId ) {
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}
		else{
			
			$cc = new CustomCardObj();
			// customers_id must come from session (for security reasons)
			$params['customers_id'] = $customerId;
			// have to set fields after we have an id
			$fields = $params['fields'];
			// create file name for PDF file to store in DB
			$this->fileName = 'pdf/' . md5(uniqid()) . '-' . time(). '.pdf';
			$cc->setPdfFile($this->fileName);
			$cc->setProperties($params);
			$cc->insert();
			$this->id = $cc->getId();
			// save to custom card fields
			foreach ( $fields as $k => $v){
				$ccf = new CustomCardFieldObj(array(
					'properties' => $v
				));
				$ccf->setCustomCardsId($this->id);
				$ccf->insert();
				unset($ccf);
			}
			
			// save custom_card_save table
			$card = new CardObj();
			$card->setCustomersId( $customerId );
			$card->setCustomCardsId( $this->id );
			$card->setProductsId( $params['products_id'] );
			$card->setAddressId( $this->getOwner()->getCustomerAddressId() );
			$card->setStatus(1);		
			$card->insert();
			
			// generate PDF file
			$this->generatePdf();
			
			return array(
				'data' => array(
					'id' => $this->id
				)
			);
		}
		
	
	}
	
	public function delete( $params ){
	
		// check to see that the id of the card belongs to the owner
		// no customer id is 403
		if( ! $this->getOwner()->getId() ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}
		else {
			$cols = new CustomCardCol();
			$customCardId = $this->getId();
			// users can only access their own cards
			$cols->setFilter('customer_id', $this->getOwner()->getId());
			$cols->setFilter('id', $customCardId);
			
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
						
				$col = $cols->getFirstElement();
				$col->setId($customCardId);
				$col->delete();
				
				$ccf = new CustomCardFieldObj();
				$ccf->setCustomCardsId($customCardId);
				$ccf->delete();
				
				// delete custom_card_save from table
				$card = new CardObj();
				$card->setCustomCardsId($customCardId);
				$card->delete();	
			}else{
				throw new \Exception(
					"404: Delete Not Found",
					404
				);
			}
			
		}
	
	}
	
	public function put( $params = array() ) {
		
		$customerId = $this->getOwner()->getId();
		if ( ! $customerId ) {
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}
		else{
			$cols = new CustomCardCol();
			$this->id = $this->getId();
			
			// users can only access their own cards
			$cols->setFilter('customer_id', $customerId);
			$cols->setFilter('id', $this->id);
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();
				$col = $cols->getFirstElement();
				
				$params['PUT']['customers_id'] = $customerId;
				$fields = $params['PUT']['fields'];
				// set properties custom card and update card id
				$col->setProperties($params['PUT']);
				// create file name for PDF file to store in DB
				$this->fileName = 'pdf/' . md5(uniqid()) . '-' . time() . '.pdf';
				$col->setPdfFile($this->fileName);
				
				$col->update();				
				// create new instance for custom card field to update with main card id
				// first delete field in custom card field that have custom card id
				// equal with main id custom_card
				$ccf = new CustomCardFieldObj();
				$ccf->setCustomCardsId($this->id);
				$ccf->delete();
				
				foreach ( $fields as $k => $v){
					$ccf->setProperties($v);
					$ccf->setCustomCardsId($this->id);
					$ccf->insert();
					unset($v);
				}
				
				//generate pdf file
				$this->generatePdf();
				return array(
					'data' => array(
						'id' => $customCardId
					)
				);
			}else{
				throw new \Exception(
					"403: Update Denied",
					403
				);
			}
			
		}
		
	}
	
	public function generatePdf(){
		include_once(DIR_WS_MODULES .'fpdf/fpdf.php' );
		$customCards = new CustomCardCol();
		$customCards->filterById( $this->id );
		$customCards->populate();
		foreach ($customCards->getElements() as $customCard){
			$customCard->load();
			$ar = $customCard->toArray();
			$fpdf = new FPDF('L', 'in', array(7, 5));
			$fpdf->AddPage();
			//image background
			$fpdf->Image(
				DIR_FS_CATALOG . $ar['image_background'],
				// x/y pos
				0,
				0,
				// dpi
				$ar['width'] / 300,
				$ar['height'] / 300
			);
			// create array of font to load script font of each file 
			$fontFaceArray = [
				'airstream', 
				'arial', 
				'armalite-rifle', 
				'cabin-sketch', 
				'floran-laura', 
				'fontlerbrown', 
				'gondola-sd', 
				'gothic-ultra', 
				'tangerine-regular',
				'courier',
				'helvetica'
			];
			foreach( $ar['fields'] as $a ){
				// information in template
				if( $a['image'] ){
					$fpdf->Image(
						DIR_FS_CATALOG . $a['image'],
						// x/y pos
						$a['pos_x'] / 300,
						$a['pos_y'] / 300,
						// dpi
						$a['width'] / 300,
						$a['height'] / 300,
						'PNG'
					);
				}
				
				// convert hax color to RGB
				list($r, $g, $b) = sscanf($a['font_color'], "#%02x%02x%02x");
				$fpdf->SetTextColor($r, $g, $b);
		
				// set text alignment
				if( $a['text_alignment'] == 'right' ) {
					$align = 'R';
				}
				else if( $a['text_alignment'] == 'left' ) {
					$align = 'L';
				}
				else if( $a['text_alignment'] == 'center' ) {
					$align = 'C';
				}
				$fontFamily = strtolower( $a['font_family'] );
				$fontFace = 'times';
				// if font is in array
				if( in_array($fontFamily, $fontFaceArray) ){
					$fontFace = $fontFamily;
				}
				// get font family
				$fpdf->AddFont($fontFace,'',$fontFace . '.php');
				$fontSize = $a['font_size'] / 4;
				$fpdf->SetFont($fontFace,'', $fontSize);
				$fpdf->SetXY( $a['pos_x'] / 300, $a['pos_y'] / 300 );
				$fpdf->MultiCell( $a['width'] / 300, 0.2, $a['text'], 0, $align);
				$fpdf->SetAutoPageBreak(false);
			}		
			// Rotate text watermark
			$fpdf->SetFont('helvetica', 'b', 33);
			$fpdf->SetTextColor(225, 225, 225);
			for($i=1; $i<7; $i++){
				$fpdf->RotatedText( $i-1.5, $i+1, 'GOOD SEND', 45 );
			}
			for($i=1; $i<7; $i++){
				$fpdf->RotatedText( $i+0.3, $i-1.8, 'GOOD SEND', 45 );
			}	
			// out put pdf file
			$path = DIR_FS_CATALOG . $this->fileName;
			$fpdf->Output($path);
		}
	}
	
	public function patch( $params = array() ){
		// check to see that the id of the card belongs to the owner
		// no customer id is 403
		if( ! $this->getOwner()->getId() ){
			throw new \Exception(
				"403: Access Denied",
				403
			);
		}
		else {
			$cols = new CustomCardCol();
			$customCardId = $this->getId();
			// users can only access their own cards
			$cols->setFilter('customer_id', $this->getOwner()->getId());
			$cols->setFilter('id', $customCardId);
			if( $cols->getTotalCount() > 0 ){
				$cols->populate();		
				$col = $cols->getFirstElement();
				$col->setId($customCardId);
				$col->setDeliveryDate($params['PATCH']['data']);
				$col->updateDateDelivery();		
			}
		}		
	}
		
}
