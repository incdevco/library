<?php

class Inclusive_Service_Ebay_Request_AddItem 
	extends Inclusive_Service_Ebay_Request_Abstract {
	
	public $callName = 'AddItem';
	
	protected $_ApplicationData = null;
	
	protected $_AutoPay = null;
	
	protected $_BuyItNowPrice = null;
	
	protected $_BuyerResponsibleForShipping = null;
	
	protected $_CategoryBasedAttributesPrefill = null;
	
	protected $_CategoryMappingAllowed = null;
	
	protected $_Charity = array();
	
	protected $_CODCost = null;
	
	protected $_ConditionID = null;
	
	protected $_Country = null;
	
	protected $_CrossBorderTrade = null;
	
	protected $_Currency = null;
	
	protected $_Description = null;
	
	protected $_DisableBuyerRequirements = null;
	
	protected $_DispatchTimeMax = null;
	
	protected $_ExcludeShipToLocation = null;
	
	protected $_ExternalPictureURL = null;
	
	protected $_GalleryDuration = null;
	
	protected $_GalleryType = null;
	
	protected $_GalleryURL = null;
	
	protected $_GetItFast = null;
	
	protected $_GiftIcon = null;
	
	protected $_GiftServices = array();
	
	protected $_HitCounter = null;
	
	protected $_ItemCompatibility = array();
	
	protected $_InsuranceDetails = null;
	
	protected $_InsuranceFee = null;
	
	protected $_InsuranceOption = null;
	
	protected $_ItemSpecifics = array();
	
	protected $_ListingDesigner = array();
	
	protected $_LocalListingDistance = null;
	
	protected $_ListingDuration = 7;
	
	protected $_ListingEnhancement = null;
	
	protected $_ListingType = 'Chinese';
	
	protected $_Location = null;
	
	protected $_LotSize = null;
	
	protected $_PaymentMethods = array();
	
	protected $_PaypalEmailAddress = null;
	
	protected $_PhotoDisplay = null;
	
	protected $_PictureURL = array();
	
	protected $_PostalCode = null;
	
	protected $_PrimaryCategory = null;
	
	protected $_Quantity = null;
	
	protected $_ReservePrice = null;
	
	protected $_ReturnPolicy = array();
	
	protected $_ScheduleTime = null;
	
	protected $_SecondaryCategory = null;
	
	protected $_ShippingPackageDetails = null;
	
	protected $_ShippingServices = array();
	
	protected $_ShippingTermsInDescription = null;
	
	protected $_ShipToLocations = null;
	
	protected $_Site = null;
	
	protected $_SKU = null;
	
	protected $_Skype = array();
	
	protected $_StartPrice = null;
	
	protected $_SubTitle = null;
	
	protected $_TaxCategory = null;
	
	protected $_Title = null;
	
	protected $_UseRecommendedProduct = null;
	
	protected $_UseTaxTable = null;
	
	protected $_UUID = null;
	
	
	public function toXml() {
	
		return $this->_renderRequest();
	
	}
	
	public function getResponse($response) {
	
		return new Inclusive_Service_Ebay_Response_AddItem($response);
	
	}
	
	
	public function getApplicationData() {
	
		return $this->_ApplicationData;
		
	}
	
	public function setApplicationData($value) {
	
		$this->_ApplicationData = $value;
		
		return $this;
		
	}
	
	public function getAutoPay() {
	
		return $this->_AutoPay;
		
	}
	
	public function setAutoPay(bool $value) {
	
		$this->_AutoPay = $value;
		
		return $this;
		
	}
	
	public function getBuyerResponsibleForShipping() {
	
		return $this->_BuyerResponsibleForShipping;
	
	}
	
	public function setBuyerResponsibleForShipping($value) {
	
		$this->_BuyerResponsibleForShipping = $value;
		
		return $this;
	
	}
	
	public function getBuyItNowPrice() {
	
		return $this->_BuyItNowPrice;
	
	}
	
	public function setBuyItNowPrice($price) {
	
		$this->_BuyItNowPrice = $price;
		
		return $this;
	
	}
	
	public function getCategoryBasedAttributesPrefill() {
	
		return $this->_CategoryBasedAttributesPrefill;
	
	}
	
	public function setCategoryBasedAttributesPrefill($value) {
	
		$this->_CategoryBasedAttributesPrefill = $value;
		
		return $this;
	
	}
	
	public function getCategoryMappingAllowed() {
	
		return $this->_CategoryMappingAllowed;
	
	}
	
	public function setCategoryMappingAllowed($value) {
	
		$this->_CategoryMappingAllowed = $value;
		
		return $this;
	
	}
	
	public function getCharity() {
	
		return $this->_Charity;
		
	}
	
	public function setCharity($id,$number,$percent) {
	
		$this->_Charity = array(
			'id'=>$id,
			'number'=>$number,
			'percent'=>$percent
			);
			
		return $this;
	
	}
	
	public function getConditionId() {
	
		return $this->_ConditionID;
	
	}
	
	public function setConditionId($id) {
	
		$this->_ConditionID = $id;
		
		return $this;
	
	}
	
	public function getCountry() {
	
		return $this->_Country;
	
	}
	
	public function setCountry($country) {
	
		$this->_Country = $country;
		
		return $this;
	
	}
	
	public function addCrossBorderTrade($id) {
	
		if ($this->hasCrossBorderTrade($id)) {
		
			return $this;
			
		}
	
		$this->_CrossBorderTrade[] = $id;
		
		return $this;
	
	}
	
	public function getCrossBorderTrade() {
	
		return $this->_CrossBorderTrade;
	
	}
	
	public function hasCrossBorderTrade($id) {
	
		if (in_array($id,$this->_CrossBorderTrade)) {
		
			return true;
			
		}
	
		return false;
	
	}
	
	public function setCrossBorderTrade(array $id) {
	
		$this->_CrossBorderTrade = $id;
		
		return $this;
	
	}
	
	public function getCurrency() {
	
		return $this->_Currency;
	
	}
	
	public function setCurrency($id) {
	
		$this->_Currency = $id;
		
		return $this;
	
	}
	
	public function getDescription() {
	
		return $this->_Description;
		
	}
	
	public function setDescription($value) {
	
		$this->_Description = $value;
		
		return $this;
	
	}
	
	public function getDisableBuyerRequirements() {
	
		return $this->_DisableBuyerRequirements;
		
	}
	
	public function setDisableBuyerRequirements($value) {
	
		$this->_DisableBuyerRequirements = $value;
		
		return $this;
	
	}
	
	public function setDispatchTimeMax($days) {
	
		$this->_DispatchTimeMax = $days;
		
		return $this;
	
	}
	
	public function getExternalPictureURL() {
	
		return $this->_ExternalPictureURL;
	
	}
	
	public function setExternalPictureURL($url) {
	
		$this->_ExternalPictureURL = $url;
		
		return $this;
	
	}
	
	public function getGetItFast() {
	
		return $this->_GetItFast;
		
	}
	
	public function setGetItFast($value) {
	
		$this->_GetItFast = $value;
		
		return $this;
	
	}
	
	public function getGiftIcon() {
	
		return $this->_GiftIcon;
		
	}
	
	public function setGiftIcon($icon) {
	
		$this->_GiftIcon = $icon;
		
		return $this;
	
	}
	
	public function addGiftService($service) {
	
		if ($this->hasGiftService($service)) {
		
			return $this;
			
		}
		
		$this->_GiftServices[] = $service;
		
		return $this;
	
	}
	
	public function getGiftServices() {
	
		return $this->_GiftServices;
		
	}
	
	public function hasGiftService($service) {
	
		if (in_array($service,$this->_GiftServices)) {
		
			return true;
			
		}
		
		return false;
	
	}
	
	public function setGiftServices($services) {
	
		$this->_GiftServices = $services;
		
		return $this;
	
	}
	
	public function getHitCounter() {
	
		return $this->_HitCounter;
		
	}
	
	public function setHitCounter($counter) {
	
		$this->_HitCounter = $counter;
		
		return $this;
	
	}
	
	public function addInternationalShippingServiceOption(
		$service,
		$free=null,
		$additionalCost=null,
		$cost=null,
		$surcharge=null,
		$priority=null,
		array $locations=null
		) {
	
		if ($this->hasInternationalShippingServiceOption($service)) {
		
			return $this;
		
		}
		
		$this->_InternationalShippingServiceOptions[$service] = array(
			'FreeShipping'=>$free,
			'ShippingService'=>$service,
			'ShippingServiceAdditionalCost'=>$additionalCost,
			'ShippingServiceCost'=>$cost,
			'ShippingServicePriority'=>$priority,
			'ShippingSurcharge'=>$surcharge,
			'ShipToLocation'=>$locations
			);
		
		return $this;
	
	}
	
	public function getInternationalShippingServiceOptions() {
	
		return $this->_InternationalShippingServiceOptions;
		
	}
	
	public function hasInternationalShippingServiceOption($service) {
	
		if (in_array($service,$this->_InternationalShippingServiceOptions)) {
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function setInternationalShippingServiceOptions(array $options) {
	
		$this->_InternationalShippingServiceOptions = $options;
		
		return $this;
	
	}
	
	public function addItemCompatibility($name,$value) {
	
		$this->_ItemCompatibility[$name] = $value;
		
		return $this;
	
	}
	
	public function getItemCompatibility() {
	
		return $this->_ItemCompatibility;
		
	}
	
	public function setItemCompatibility(array $compatibility) {
	
		$this->_ItemCompatibility = $compatibility;
		
		return $this;
	
	}
	
	public function addItemSpecific($name,$value) {
	
		$this->_ItemSpecifics[$name] = $value;
		
		return $this;
	
	}
	
	public function getItemSpecifics() {
	
		return $this->_ItemSpecifics;
		
	}
	
	public function setItemSpecifics(array $specifics) {
	
		$this->_ItemSpecifics = $specifics;
		
		return $this;
	
	}
	
	public function getListingDesigner() {
	
		return $this->_ListingDesigner;
	
	}
	
	public function setListingDesigner(
		$layoutId=null,
		$themeId=null,
		$optimalPictureSize=null
		) {
	
		$this->_ListingDesigner = array(
			'layoutId'=>$layoutId,
			'optimalPictureSize'=>$optimalPictureSize,
			'themeId'=>$themeId
			);
	
		return $this;
	
	}
	
	public function getListingDuration() {
	
		return $this->_ListingDuration;
	
	}
	
	public function setListingDuration($days) {
	
		$this->_ListingDuration = $days;
		
		return $this;
	
	}
	
	public function addListingEnhancement($enhancement) {
	
		if ($this->hasListingEnhancement($enhancement)) {
		
			return $this;
			
		}
		
		$this->_ListingEnhancements[] = $enhancement;
		
		return $this;
	
	}
	
	public function getListingEnhancements() {
	
		return $this->_ListingEnhancements;
	
	}
	
	public function hasListingEnhancement($enhancement) {
	
		if (in_array($enhancement,$this->_ListingEnhancements)) {
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function setListingEnhancements(array $enhancements) {
	
		$this->_ListingEnhancements = $enhancements;
		
		return $this;
	
	}
	
	public function setListingType($type) {
	
		$this->_ListingType = $type;
		
		return $this;
	
	}
	
	public function getLocalListingDistance() {
	
		return $this->_LocalListingDistance;
	
	}
	
	public function setLocalListingDistance($distance) {
	
		$this->_LocalListingDistance = $distance;
		
		return $this;
	
	}
	
	public function setLocation($location) {
	
		$this->_Location = $location;
		
		return $this;
	
	}
	
	public function setLotSize($size) {
	
		$this->_LotSize = $size;
		
		return $this;
	
	}
	
	public function addPaymentMethod($method) {
	
		if (!$this->hasPaymentMethod($method)) {
		
			$this->_PaymentMethods[] = $method;
		
		}
		
		return $this;
	
	}
	
	public function getPaymentMethods() {
	
		return $this->_PaymentMethods;
	
	}
	
	public function hasPaymentMethod($method) {
	
		if (in_array($method,$this->_PaymentMethods)) {
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function setPaymentMethods(array $methods) {
	
		$this->_PaymentMethods = $methods;
	
		return $this;
	
	}
	
	public function setPaypalEmailAddress($emailAddress) {
		
		$this->_PaypalEmailAddress = $emailAddress;
		
		if ($this->_shouldRenderPaypalEmailAddress()) {
		
			$this->addPaymentMethod('Paypal');
		
		}
	
		return $this;
	
	}
	
	public function addPictureURL($url) {
	
		if ($this->hasPictureURL($url)) {
		
			return $this;
		
		}
		
		$this->_PictureURL[] = $url;
		
		return $this;
	
	}
	
	public function getPictureURL() {
	
		return $this->_PictureURL;
		
	}
	
	public function hasPictureURL($url) {
	
		if (in_array($url,$this->_PictureURL)) {
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function setPictureURL(array $urls) {
	
		$this->_PictureURL = $urls;
		
		return $this;
	
	}
	
	public function setPrimaryCategory($id) {
	
		$this->_PrimaryCategory = $id;
		
		return $this;
	
	}
	
	public function setPostalCode($code) {
	
		$this->_PostalCode = $code;
		
		return $this;
	
	}
	
	public function setQuantity($quantity) {
	
		$this->_Quantity = $quantity;
		
		return $this;
	
	}
	
	public function setReservePrice($price) {
	
		$this->_ReservePrice = $price;
		
		return $this;
	
	}
	
	public function setReturnPolicy(
		$description,
		$refund=null,
		$returnAccepted=null,
		$returnWithin=null,
		$shippingCostPaidBy=null,
		$ean=null,
		$warrantyOffered=null,
		$warrantyDuration=null,
		$warrantyType=null
		) {
	
		$this->_ReturnPolicy = array(
			'Description'=>$description,
			'RefundOption'=>$refund,
			'ReturnsAcceptedOption'=>$returnAccepted,
			'ShippingCostPaidByOption'=>$shippingCostPaidBy,
			'WarrantyDuration'=>$warrantyDuration,
			'WarrantyOffered'=>$warrantyOffered,
			'WarrantyType'=>$warrantyType,
			'EAN'=>$ean
			);
			
		return $this;
	
	}
	
	public function setScheduleTime($time) {
	
		$new = strtotime($time);
		
		if ($new !== false) {
		
			$time = $new;
		
		}
		
		$this->_ScheduleTime = gmdate('c',$time);
		
		return $this;
	
	}
	
	public function addShippingServiceOption(
		$service,
		$free=null,
		$additionalCost=null,
		$cost=null,
		$surcharge=null,
		$priority=null
		) {
	
		if ($this->hasShippingServiceOption($service)) {
		
			return $this;
		
		}
		
		$this->_ShippingServices[$service] = array(
			'FreeShipping'=>$free,
			'ShippingService'=>$service,
			'ShippingServiceAdditionalCost'=>$additionalCost,
			'ShippingServiceCost'=>$cost,
			'ShippingServicePriority'=>$priority,
			'ShippingSurcharge'=>$surcharge
			);
		
		return $this;
	
	}
	
	public function getShippingServiceOptions() {
	
		return $this->_ShippingServices;
		
	}
	
	public function hasShippingServiceOption($service) {
	
		if (in_array($service,$this->_ShippingServices)) {
		
			return true;
		
		}
		
		return false;
	
	}
	
	public function setShippingServiceOptions(array $options) {
	
		$this->_ShippingServices = $options;
		
		return $this;
	
	}
	
	public function setShippingPackageDetails(
		$postalCode,
		$weightMajor,
		$weightMinor,
		$depth,
		$length,
		$width,
		$package='PackageThickEnvelope',
		$irregular=false,
		$system='English'
		) {
		
		$this->_PostalCode = $postalCode;
		
		$this->_ShippingPackageDetails = array(
			'MeasurementUnit'=>$system,
			'ShippingPackage'=>$package,
			'ShippingIrregular'=>($irregular) ? 1 : 0,
			'PackageDepth'=>$depth,
			'PackageLength'=>$length,
			'PackageWidth'=>$width,
			'WeightMajor'=>$weightMajor,
			'WeightMinor'=>$weightMinor
			);
	
		return $this;
	
	}
	
	public function setShippingTermsInDescription($value=true) {
	
		$this->_ShippingTermsInDescription = $value;
	
		return $this;
	
	}
	
	public function setShipToLocations($locations) {
	
		$this->_ShipToLocations = $shipToLocations;
	
		return $this;
	
	}
	
	public function setSite($site) {
	
		$this->_Site = $site;
	
		return $this;
	
	}
	
	public function setSKU($sku) {
	
		$this->_SKU = $sku;
	
		return $this;
	
	}
	
	public function disableSkype() {
	
		$this->_Skype = array();
		
		return $this;
	
	}
	
	public function enableSkype($id,array $options=null) {
	
		$this->_Skype = array(
			'id'=>$id,
			'options'=>$options
			);
		
		return $this;
	
	}
	
	public function setStartPrice($price) {
	
		$this->_StartPrice = $price;
		
		return $this;
	
	}
	
	public function setSubTitle($title) {
	
		$this->_SubTitle = $title;
	
		return $this;
	
	}
	
	public function setTaxCategory($category) {
	
		$this->_TaxCategory = $category;
	
		return $this;
	
	}
	
	public function setTitle($title) {
	
		$this->_Title = $title;
	
		return $this;
	
	}
	
	public function setUseRecommendedProduct($value=true) {
	
		$this->_UseRecommendedProduct = $value;
	
		return $this;
	
	}
	
	public function setUseTaxTable($value=true) {
	
		$this->_UseTaxTable = $value;
	
		return $this;
	
	}
	
	public function setUUID($UUID) {
	
		$this->_UUID = $UUID;
	
		return $this;
	
	}
	
	// Rendering Functions
	
	protected function _renderRequest($content='') {
	
		$string = '<?xml version="1.0" encoding="utf-8"?>'."\n";
		
		$string .= '<AddItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">'."\n";
		
		$string .= $this->_rendereBayAuthToken()."\n";
		
		$string .= $this->_renderWarningLevel()."\n";
		
		$string .= $this->_renderErrorHandling()."\n";
		
		$string .= $this->_renderErrorLanguage()."\n";
		
		$string .= $this->_renderItem()."\n";
		
		$string .= $content."\n";
		
		$string .= '</AddItemRequest>'."\n";
		
		return $string;
	
	}
	
	protected function _renderItem($content='') {
	
		$string = '<Item>'."\n";
		
		if ($this->_shouldRenderApplicationData()) {
		
			$string .= $this->_renderApplicationData()."\n";
		
		}
		
		if ($this->_shouldRenderAutoPay()) {
		
			$string .= $this->_renderAutoPay()."\n";
		
		}
		
		if ($this->_shouldRenderBestOfferDetails()) {
		
			$string .= $this->_renderBestOfferDetails()."\n";
		
		}
		
		// skipped BuyerRequirementDetails
		
		if ($this->_shouldRenderBuyerResponsibleForShipping()) {
		
			$string .= $this->_renderBuyerResponsibleForShipping()."\n";
			
		}
		
		if ($this->_shouldRenderBuyItNowPrice()) {
		
			$string .= $this->_renderBuyItNowPrice()."\n";
			
		}
		
		if ($this->_shouldRenderCategoryBasedAttributesPrefill()) {
		
			$string .= $this->_renderCategoryBasedAttributesPrefill()."\n";
			
		}
		
		if ($this->_shouldRenderCategoryMappingAllowed()) {
		
			$string .= $this->_renderCategoryMappingAllowed()."\n";
			
		}
		
		if ($this->_shouldRenderCharity()) {
		
			$string .= $this->_renderCharity()."\n";
			
		}
		
		if ($this->_shouldRenderConditionID()) {
		
			$string .= $this->_renderConditionID()."\n";
			
		}
		
		if ($this->_shouldRenderCrossBorderTrade()) {
		
			$string .= $this->_renderCrossBorderTrade()."\n";
			
		}
		
		if ($this->_shouldRenderCurrency()) {
		
			$string .= $this->_renderCurrency()."\n";
			
		}
		
		$string .= $this->_renderCountry()."\n";
				
		if ($this->_shouldRenderDescription()) {
		
			$string .= $this->_renderDescription()."\n";
			
		}
		
		// skipped DiscountPriceInfo
		
		if ($this->_shouldRenderDispatchTimeMax()) {
		
			$string .= $this->_renderDispatchTimeMax()."\n";
		
		}
		
		// skipped ExtendedSellerContactDetails
		
		// skipped ExternalProductID
		
		if ($this->_shouldRenderGetItFast()) {
		
			$string .= $this->_renderGetItFast()."\n";
		
		}
		
		if ($this->_shouldRenderGiftIcon()) {
		
			$string .= $this->_renderGiftIcon()."\n";
		
		}
		
		if ($this->_shouldRenderGiftServices()) {
		
			$string .= $this->_renderGiftServices()."\n";
		
		}
		
		if ($this->_shouldRenderHitCounter()) {
		
			$string .= $this->_renderHitCounter()."\n";
		
		}
		
		// skipped ItemCompatibility
		
		// skipped ItemSpecifics
		
		// skipped ListingCheckoutRedirectPreference
		
		if ($this->_shouldRenderListingDesigner()) {
		
			$string .= $this->_renderListingDesigner()."\n";
			
		}
		
		if ($this->_shouldRenderListingDetails()) {
		
			$string .= $this->_renderListingDetails()."\n";
			
		}
		
		if ($this->_shouldRenderListingDuration()) {
		
			$string .= $this->_renderListingDuration()."\n";
			
		}
		
		if ($this->_shouldRenderListingEnhancement()) {
		
			$string .= $this->_renderListingEnhancement()."\n";
			
		}
		
		$string .= $this->_renderListingType()."\n";
		
		if ($this->_shouldRenderLocation()) {
		
			$string .= $this->_renderLocation()."\n";
			
		}
		
		if ($this->_shouldRenderLotSize()) {
		
			$string .= $this->_renderLotSize()."\n";
			
		}
		
		if ($this->_shouldRenderPaymentDetails()) {
		
			$string .= $this->_renderPaymentDetails()."\n";
			
		}
		
		if ($this->_shouldRenderPaymentMethods()) {
		
			$string .= $this->_renderPaymentMethods()."\n";
			
		}
		
		if ($this->_shouldRenderPaypalEmailAddress()) {
		
			$string .= $this->_renderPaypalEmailAddress()."\n";
			
		}
		
		if ($this->_shouldRenderPictureDetails()) {
		
			$string .= $this->_renderPictureDetails()."\n";
			
		}
		
		if ($this->_shouldRenderPostalCode()) {
		
			$string .= $this->_renderPostalCode()."\n";
			
		}
		
		if ($this->_shouldRenderPrimaryCategory()) {
		
			$string .= $this->_renderPrimaryCategory()."\n";
			
		}
		
		// skipped ProductListingDetails
		
		if ($this->_shouldRenderQuantity()) {
		
			$string .= $this->_renderQuantity()."\n";
			
		}
		
		if ($this->_shouldRenderReservePrice()) {
		
			$string .= $this->_renderReservePrice()."\n";
			
		}
		
		if ($this->_shouldRenderReturnPolicy()) {
		
			$string .= $this->_renderReturnPolicy()."\n";
			
		}
		
		if ($this->_shouldRenderScheduleTime()) {
		
			$string .= $this->_renderScheduleTime()."\n";
			
		}
		
		if ($this->_shouldRenderSecondaryCategory()) {
		
			$string .= $this->_renderSecondaryCategory()."\n";
			
		}
		
		// skipped Seller
		
		// skipped SellerContactDetails
		
		// skipped SellerInventoryId
		
		// skipped SellerProfiles
		
		// skipped SellerProvidedTitle
		
		if ($this->_shouldRenderShippingDetails()) {
		
			$string .= $this->_renderShippingDetails()."\n";
			
		}
		
		if ($this->_shouldRenderShippingPackageDetails()) {
		
			$string .= $this->_renderShippingPackageDetails()."\n";
			
		}
		
		if ($this->_shouldRenderShippingTermsInDescription()) {
		
			$string .= $this->_renderShippingTermsInDescription()."\n";
			
		}
		
		if ($this->_shouldRenderShipToLocations()) {
		
			$string .= $this->_renderShipToLocations()."\n";
			
		}
		
		if ($this->_shouldRenderSite()) {
		
			$string .= $this->_renderSite()."\n";
			
		}
		
		if ($this->_shouldRenderSKU()) {
		
			$string .= $this->_renderSKU()."\n";
			
		}
		
		if ($this->_shouldRenderSkype()) {
		
			$string .= $this->_renderSkype()."\n";
			
		}
		
		if ($this->_shouldRenderStartPrice()) {
		
			$string .= $this->_renderStartPrice()."\n";
			
		}
		
		// skipped StoreFront
		
		if ($this->_shouldRenderSubTitle()) {
		
			$string .= $this->_renderSubTitle()."\n";
			
		}
		
		if ($this->_shouldRenderTaxCategory()) {
		
			$string .= $this->_renderTaxCategory()."\n";
			
		}
		
		// skipped ThirdPartyCheckout
		
		// skipped ThirdPartyCheckoutIntegration
		
		$string .= $this->_renderTitle()."\n";
		
		// skipped UseRecommendedProduct
		
		// skipped UseTaxTable
		
		if ($this->_shouldRenderUUID()) {
		
			$string .= $this->_renderUUID()."\n";
			
		}
		
		// skipped VATDetails
		
		// skipped VIN
		
		// skipped VRM
		
		$string .= $content;
		
		$string .= '</Item>'."\n";
		
		return $string;
	
	}
	
	protected function _renderApplicationData() {
	
		return $this->_renderValue('ApplicationData');
	
	}
	
	protected function _shouldRenderApplicationData() {
	
		return $this->_shouldRenderValue('ApplicationData');
	
	}
	
	protected function _shouldRenderAutoPay() {
	
		return $this->_shouldRenderValue('AutoPay');
	
	}
	
	protected function _renderAutoPay() {
	
		return $this->_renderValue('AutoPay');
	
	}
	
	protected function _renderBestOfferDetails() {
	
		$string = '<BestOfferDetails>';
		
		$string .= '<BestOfferEnabled>1</BestOfferEnabled>';
		
		$string .= '</BestOfferDetails>';
		
		return $string;
	
	}
	
	protected function _shouldRenderBestOfferDetails() {
	
		if (!empty($this->_ListingDetails)
			&& (
				isset($this->_listingDetails['BestOfferAutoAcceptPrice'])
				or isset($this->_listingDetails['MinimumBestOfferPrice'])
				)) {
		
			return true;
			
		}
		
		return false;
	
	}
	
	protected function _renderBuyerResponsibleForShipping() {
	
		return $this->_renderValue('ResponsibleForShipping');
	
	}
	
	protected function _shouldRenderBuyerResponsibleForShipping() {
	
		return $this->_shouldRenderValue('BuyerResponsibleForShipping');
	
	}
	
	protected function _renderBuyItNowPrice() {
	
		return $this->_renderValue('BuyItNowPrice');
	
	}
	
	protected function _shouldRenderBuyItNowPrice() {
	
		return $this->_shouldRenderValue('BuyItNowPrice');
	
	}
	
	protected function _renderCalculatedShippingRate($option) {
	
		$string = '<CalculatedShippingRate>';
		
		$string .= '<MeasurementUnit>';
		
		$string .= $this->_ShippingPackageDetails['MeasurementUnit'];
		
		$string .= '</MeasurementUnit>';
		
		$string .= '<OriginatingPostalCode>';
		
		$string .= $this->_PostalCode;
		
		$string .= '</OriginatingPostalCode>';
		
		$string .= '<PackageDepth>';
		
		$string .= $this->_ShippingPackageDetails['PackageDepth'];
		
		$string .= '</PackageDepth>';
		
		$string .= '<PackageLength>';
		
		$string .= $this->_ShippingPackageDetails['PackageLength'];
		
		$string .= '</PackageLength>';
		
		$string .= '<PackageWidth>';
		
		$string .= $this->_ShippingPackageDetails['PackageWidth'];
		
		$string .= '</PackageWidth>';
		
		$string .= '<ShippingIrregular>';
		
		$string .= $this->_ShippingPackageDetails['ShippingIrregular'];
		
		$string .= '</ShippingIrregular>';
		
		$string .= '<ShippingPackage>';
		
		$string .= $this->_ShippingPackageDetails['ShippingPackage'];
		
		$string .= '</ShippingPackage>';
		
		$string .= '<WeightMajor>';
		
		$string .= $this->_ShippingPackageDetails['WeightMajor'];
		
		$string .= '</WeightMajor>';
		
		$string .= '<WeightMinor>';
		
		$string .= $this->_ShippingPackageDetails['WeightMinor'];
		
		$string .= '</WeightMinor>';
		
		$string .= '</CalculatedShippingRate>';
		
		return $string;
	
	}
	
	protected function _renderCategoryBasedAttributesPrefill() {
	
		return $this->_renderValue('CategoryBasedAttributesPrefill');
	
	}
	
	protected function _shouldRenderCategoryBasedAttributesPrefill() {
	
		return $this->_shouldRenderValue('CategoryBasedAttributesPrefill');
	
	}
	
	protected function _renderCategoryMappingAllowed() {
	
		return $this->_renderValue('CategoryMappingAllowed');
	
	}
	
	protected function _shouldRenderCategoryMappingAllowed() {
	
		return $this->_shouldRenderValue('CategoryMappingAllowed');
	
	}
	
	protected function _renderCharity() {
	
		return $this->_renderArray('Charity');
	
	}
	
	protected function _shouldRenderCharity() {
	
		return $this->_shouldRenderArray('Charity');
	
	}
	
	protected function _renderCODCost() {
	
		return $this->_renderValue('CODCost');
	
	}
	
	protected function _shouldRenderCODCost() {
	
		return $this->_shouldRenderValue('CODCost');
	
	}
	
	protected function _renderConditionID() {
	
		return $this->_renderValue('ConditionID');
	
	}
	
	protected function _shouldRenderConditionID() {
	
		return $this->_shouldRenderValue('ConditionID');
	
	}
	
	protected function _renderCountry() {
	
		return $this->_renderValue('Country');
	
	}
	
	protected function _renderCrossBorderTrade() {
	
		return $this->_renderArray('CrossBorderTrade');
	
	}
	
	protected function _shouldRenderCrossBorderTrade() {
	
		return $this->_shouldRenderArray('CrossBorderTrade');
	
	}
	
	protected function _renderCurrency() {
	
		return $this->_renderValue('Currency');
	
	}
	
	protected function _shouldRenderCurrency() {
	
		return $this->_shouldRenderValue('Currency');
	
	}
	
	protected function _renderDescription() {
	
		return $this->_renderValue('Description');
	
	}
	
	protected function _shouldRenderDescription() {
	
		return $this->_shouldRenderValue('Description');
	
	}
	
	protected function _renderDisableBuyerRequirements() {
	
		return $this->_renderValue('DisableBuyerRequirements');
	
	}
	
	protected function _shouldRenderDisableBuyerRequirements() {
	
		return $this->_shouldRenderValue('DisableBuyerRequirements');
	
	}
	
	protected function _renderDispatchTimeMax() {
	
		return $this->_renderValue('DispatchTimeMax');
	
	}
	
	protected function _shouldRenderDispatchTimeMax() {
	
		return $this->_shouldRenderValue('DispatchTimeMax');
	
	}
	
	protected function _renderExcludeShipToLocation() {
	
		return $this->_renderValue('ExcludeShipToLocation');
	
	}
	
	protected function _shouldRenderExcludeShipToLocation() {
	
		return $this->_shouldRenderValue('ExcludeShipToLocation');
	
	}
	
	protected function _renderExternalPictureURL() {
	
		return $this->_renderValue('ExternalPictureURL');
	
	}
	
	protected function _shouldRenderExternalPictureURL() {
	
		return $this->_shouldRenderValue('ExternalPictureURL');

	}
	
	protected function _shouldRenderGalleryDuration() {
	
		return $this->_shouldRenderValue('GalleryDuration');
		
	}
	
	protected function _renderGalleryDuration() {
	
		return $this->_renderValue('GalleryDuration');
	
	}
	
	protected function _shouldRenderGalleryType() {
	
		return $this->_shouldRenderValue('GalleryType');
		
	}
	
	protected function _renderGalleryType() {
	
		return $this->_renderValue('GalleryType');
	
	}
	
	protected function _shouldRenderGalleryURL() {
	
		return $this->_shouldRenderValue('GalleryURL');
		
	}
	
	protected function _renderGalleryURL() {
	
		return $this->_renderValue('GalleryURL');
	
	}
	
	protected function _renderGetItFast() {
	
		return $this->_renderValue('GetItFast');
	
	}
	
	protected function _shouldRenderGetItFast() {
	
		return $this->_shouldRenderValue('GetItFast');
	
	}
	
	protected function _renderGiftIcon() {
	
		return $this->_renderValue('GiftIcon');
	
	}
	
	protected function _shouldRenderGiftIcon() {
	
		return $this->_shouldRenderValue('GiftIcon');
	
	}
	
	protected function _renderGiftServices() {
	
		return $this->_renderArray('GiftServices');
	
	}
	
	protected function _shouldRenderGiftServices() {
	
		return $this->_shouldRenderArray('GiftServices');
	
	}
	
	protected function _renderHitCounter() {
	
		return $this->_renderValue('HitCounter');
	
	}
	
	protected function _shouldRenderHitCounter() {
	
		return $this->_shouldRenderValue('HitCounter');
	
	}
	
	protected function _renderInsuranceDetails() {
	
		return $this->_renderValue('InsuranceDetails');
	
	}
	
	protected function _shouldRenderInsuranceDetails() {
	
		return $this->_shouldRenderValue('InsuranceDetails');
	
	}
	
	protected function _renderInsuranceFee() {
	
		return $this->_renderValue('InsuranceFee');
	
	}
	
	protected function _shouldRenderInsuranceFee() {
	
		return $this->_shouldRenderValue('InsuranceFee');
	
	}
	
	protected function _renderInsuranceOption() {
	
		return $this->_renderValue('InsuranceOption');
	
	}
	
	protected function _shouldRenderInsuranceOption() {
	
		return $this->_shouldRenderValue('InsuranceOption');
	
	}
	
	protected function _renderInternationalShippingServiceOption(array $option) {
	
		$string = '<InternationalShippingServiceOption>';
	
		$string .= '<ShippingService>';
		
		$string .= $options['ShippingService'];
		
		$string .= '</ShippingService>';
	
		$string .= '<ShippingServiceAdditionalCost>';
		
		$string .= $options['ShippingServiceAdditionalCost'];
		
		$string .= '</ShippingServiceAdditionalCost>';
	
		$string .= '<ShippingServiceCost>';
		
		$string .= $options['ShippingServiceCost'];
		
		$string .= '</ShippingServiceCost>';
	
		$string .= '<ShippingServicePriority>';
		
		$string .= $options['ShippingServicePriority'];
		
		$string .= '</ShippingServicePriority>';
	
		$string .= '</InternationalShippingServiceOption>';
		
		foreach ($options['ShipToLocation'] as $location) {
		
			$string .= '<ShipToLocation>';
			
			$string .= $location;
			
			$string .= '</ShipToLocation>';
		
		}
		
		return $string;
		
	}
	
	protected function _renderListingDesigner() {
	
		return $this->_renderArray('ListingDesigner');
	
	}
	
	protected function _shouldRenderListingDesigner() {
	
		return $this->_shouldRenderArray('ListingDesigner');
	
	}
	
	protected function _renderListingDetails() {
	
		return $this->_renderArray('ListingDetails');
	
	}
	
	protected function _shouldRenderListingDetails() {
	
		return $this->_shouldRenderArray('ListingDetails');
	
	}
	
	protected function _renderListingDuration() {
	
		$string = '<ListingDuration>';
		
		$string .= 'Days_'.$this->_ListingDuration;
		
		$string .= '</ListingDuration>';
		
		return $string;
	
	}
	
	protected function _shouldRenderListingDuration() {
	
		return $this->_shouldRenderValue('ListingDuration');
	
	}
	
	protected function _renderListingEnhancement() {
	
		return $this->_renderArray('ListingEnhancement');
	
	}
	
	protected function _shouldRenderListingEnhancement() {
	
		return $this->_shouldRenderArray('ListingEnhancement');
	
	}
	
	protected function _renderListingType() {
	
		return $this->_renderValue('ListingType');
	
	}
	
	protected function _shouldRenderListingType() {
	
		return $this->_shouldRenderValue('ListingType');
	
	}
	
	protected function _renderLocation() {
	
		return $this->_renderValue('Location');
	
	}
	
	protected function _shouldRenderLocation() {
	
		return $this->_shouldRenderValue('Location');
	
	}
	
	protected function _renderLotSize() {
	
		return $this->_renderValue('LotSize');
	
	}
	
	protected function _shouldRenderLotSize() {
	
		return $this->_shouldRenderValue('LotSize');
	
	}
	
	protected function _shouldRenderPaymentDetails() {
	
		return $this->_shouldRenderArray('PaymentDetails');
	
	}
	
	protected function _shouldRenderPaymentInstructions() {
	
		return $this->_shouldRenderValue('PaymentInstructions');
		
	}
	
	protected function _renderPaymentInstructions() {
	
		return $this->_renderValue('PaymentInstructions');
		
	}
	
	protected function _renderPaymentMethods() {
	
		return $this->_renderArray('PaymentMethods');
	
	}
	
	protected function _shouldRenderPaymentMethods() {
	
		return $this->_shouldRenderArray('PaymentMethods');
	
	}
	
	protected function _renderPaypalEmailAddress() {
	
		return $this->_renderValue('PaypalEmailAddress');
	
	}
	
	protected function _shouldRenderPaypalEmailAddress() {
	
		return $this->_shouldRenderValue('PaypalEmailAddress');
		
	}
	
	protected function _shouldRenderPhotoDisplay() {
	
		return $this->_shouldRenderValue('PhotoDisplay');
		
	}
	
	protected function _renderPhotoDisplay() {
	
		return $this->_renderValue('PhotoDisplay');
		
	}
	
	protected function _renderPictureDetails() {
	
		$string = '<PictureDetails>';
		
		if ($this->_shouldRenderExternalPictureURL()) {
		
			$string .= $this->_renderExternalPictureURL();
		
		}
		
		if ($this->_shouldRenderGalleryDuration()) {
		
			$string .= $this->_renderGalleryDuration();
		
		}
		
		if ($this->_shouldRenderGalleryType()) {
		
			$string .= $this->_renderGalleryType();
		
		}
		
		if ($this->_shouldRenderGalleryURL()) {
		
			$string .= $this->_renderGalleryURL();
		
		}
		
		if ($this->_shouldRenderPhotoDisplay()) {
		
			$string .= $this->_renderPhotoDisplay();
		
		}
		
		if ($this->_shouldRenderPictureURL()) {
		
			$string .= $this->_renderPictureURL();
		
		}
		
		$string .= '</PictureDetails>';
		
		return $string;
	
	}
	
	protected function _shouldRenderPictureDetails() {
		
		if ($this->_shouldRenderExternalPictureURL()
			or $this->_shouldRenderGalleryDuration()
			or $this->_shouldRenderGalleryType()
			or $this->_shouldRenderGalleryURL()
			or $this->_shouldRenderPhotoDisplay()
			or $this->_shouldRenderPictureURL()) {
		
			return true;
		
		}
		
		return false;
		
	}
	
	protected function _shouldRenderPictureURL() {
	
		return $this->_shouldRenderArray('PictureURL');
		
	}
	
	protected function _renderPictureURL() {
	
		return $this->_renderArray('PictureURL');
		
	}
	
	protected function _shouldRenderPostalCode() {
	
		return $this->_shouldRenderValue('PostalCode');
		
	}
	
	protected function _renderPostalCode() {
	
		return $this->_renderValue('PostalCode');
		
	}
	
	protected function _shouldRenderPrimaryCategory() {
	
		return $this->_shouldRenderValue('PrimaryCategory');
		
	}
	
	protected function _renderPrimaryCategory() {
	
		$string = '<PrimaryCategory>';
		
		$string .= '<CategoryID>';
		
		$string .= $this->_PrimaryCategory;
		
		$string .= '</CategoryID>';
		
		$string .= '</PrimaryCategory>';
		
		return $string;
		
	}
	
	protected function _shouldRenderPrivateListing() {
	
		return $this->_shouldRenderValue('PrivateListing');
		
	}
	
	protected function _renderPrivateListing() {
	
		return $this->_renderValue('PrivateListing');
		
	}
	
	protected function _shouldRenderQuantity() {
	
		return $this->_shouldRenderValue('Quantity');
		
	}
	
	protected function _renderQuantity() {
	
		return $this->_renderValue('Quantity');
		
	}
	
	protected function _shouldRenderReservePrice() {
	
		return $this->_shouldRenderValue('ReservePrice');
		
	}
	
	protected function _renderReservePrice() {
	
		return $this->_renderValue('ReservePrice');
		
	}
	
	protected function _renderReturnPolicy() {
	
		return $this->_renderArray('ReturnPolicy');
	
	}
	
	protected function _shouldRenderReturnPolicy() {
	
		return $this->_shouldRenderArray('ReturnPolicy');
	
	}
	
	protected function _shouldRenderSalesTax() {
	
		return $this->_shouldRenderArray('SalesTax');
	
	}
	
	protected function _renderSalesTax() {
	
		return $this->_renderArray('SalesTax');
	
	}
	
	protected function _shouldRenderScheduleTime() {
	
		return $this->_shouldRenderValue('ScheduleTime');
		
	}
	
	protected function _renderScheduleTime() {
	
		return $this->_renderValue('ScheduleTime');
		
	}
	
	protected function _shouldRenderSecondaryCategory() {
	
		return $this->_shouldRenderValue('SecondaryCategory');
		
	}
	
	protected function _renderSecondaryCategory() {
	
		$string = '<SecondaryCategory>';
		
		$string .= '<CategoryID>';
		
		$string .= $this->_SecondaryCategory;
		
		$string .= '</CategoryID>';
		
		$string .= '</SecondaryCategory>';
		
		return $string;
		
	}
	
	protected function _shouldRenderShippingDetails() {
	
		return $this->_shouldRenderArray('ShippingServices');
	
	}
	
	protected function _renderShippingDetails() {
	
		$string = '<ShippingDetails>';
		
		$calculatedString = '';
		
		$shippingString = '';
		
		foreach ($this->_ShippingServices as $option) {
		
			$calculatedString .= 
				$this->_renderCalculatedShippingRate($option);
				
			$shippingString .=
				$this->_renderShippingServiceOption($option);
		
		}
		
		$string .= $calculatedString;
		
		if ($this->_shouldRenderCODCost()) {
		
			$string .= $this->_renderCODCost();
		
		}
		
		if ($this->_shouldRenderExcludeShipToLocation()) {
		
			$string .= $this->_renderExcludeShipToLocation();
		
		}
		
		if ($this->_shouldRenderInsuranceDetails()) {
		
			$string .= $this->_renderInsuranceDetails();
		
		}
		
		if ($this->_shouldRenderInsuranceFee()) {
		
			$string .= $this->_renderInsuranceFee();
		
		}
		
		if ($this->_shouldRenderInsuranceOption()) {
		
			$string .= $this->_renderInsuranceOption();
		
		}
		
		/*
		if ($this->_shouldRenderInternationalInsuranceDetails()) {
		
			$string .= $this->_renderInternationalInsuranceDetails();
		
		}
		
		if ($this->_shouldRenderInternationalShippingServiceOption()) {
		
			foreach ($this->_InternationalShippingServiceOptions as $option) {
		
				$string .= 
					$this->_renderInternationalShippingServiceOption($option);
			
			}
		
		}
		*/
		
		if ($this->_shouldRenderPaymentInstructions()) {
		
			$string .= $this->_renderPaymentInstructions();
		
		}
		
		if ($this->_shouldRenderSalesTax()) {
		
			$string .= $this->_renderSalesTax();
		
		}
		
		$string .= $shippingString;
		
		$string .= '</ShippingDetails>';
		
		return $string;
	
	}
	
	protected function _shouldRenderShippingPackageDetails() {
	
		return $this->_shouldRenderArray('ShippingPackageDetails');
	
	}
	
	protected function _renderShippingPackageDetails() {
	
		return $this->_renderArray('ShippingPackageDetails');
		
	}
	
	protected function _renderShippingServiceOption($option) {
	
		$string = '<ShippingServiceOptions>';
		
		foreach ($option as $key => $value) {
		
			if ($value !== null) {
		
				$string .= '<'.$key.'>';
				
				$string .= $value;
				
				$string .= '</'.$key.'>';
			
			}
		
		}
		
		$string .= '</ShippingServiceOptions>';
		
		return $string;
	
	}
	
	protected function _shouldRenderShippingTermsInDescription() {
	
		return $this->_shouldRenderValue('ShippingTermsInDescription');
	
	}
	
	protected function _renderShippingTermsInDescription() {
	
		return $this->_renderValue('ShippingTermsInDescription');
		
	}
	
	protected function _shouldRenderShipTolocations() {
	
		return $this->_shouldRenderArray('ShipTolocations');
	
	}
	
	protected function _renderShipTolocations() {
	
		return $this->_renderArray('ShipTolocations');
		
	}
	
	protected function _shouldRenderSite() {
	
		return $this->_shouldRenderValue('Site');
	
	}
	
	protected function _renderSite() {
	
		return $this->_renderValue('Site');
		
	}
	
	protected function _shouldRenderSKU() {
	
		return $this->_shouldRenderValue('SKU');
	
	}
	
	protected function _renderSKU() {
	
		return $this->_renderValue('SKU');
		
	}
	
	protected function _shouldRenderSkype() {
	
		return $this->_shouldRenderArray('Skype');
	
	}
	
	protected function _renderSkype() {
	
		$string = '';
	
		foreach ($this->_Skype['options'] as $option) {
		
			$string .= '<SkypeContactOption>';
			
			$string .= $option;
			
			$string .= '</SkypeContactOption>';
		
		}
		
		$string .= '<SkypeEnabled>';
		
		$string .= '1';
		
		$string .= '</SkypeEnabled>';
		
		$string .= '<SkypeID>';
		
		$string .= $this->_Skype['id'];
		
		$string .= '</SkypeID>';
		
		return $string;
		
	}
	
	protected function _shouldRenderStartPrice() {
	
		return $this->_shouldRenderValue('StartPrice');
	
	}
	
	protected function _renderStartPrice() {
	
		return $this->_renderValue('StartPrice');
	
	}
	
	protected function _shouldRenderSubTitle() {
	
		return $this->_shouldRenderValue('SubTitle');
	
	}
	
	protected function _renderSubTitle() {
	
		return $this->_renderValue('SubTitle');
	
	}
	
	protected function _shouldRenderTaxCategory() {
	
		return $this->_shouldRenderValue('TaxCategory');
	
	}
	
	protected function _renderTaxCategory() {
	
		return $this->_renderValue('TaxCategory');
	
	}
	
	protected function _renderTitle() {
	
		return $this->_renderValue('Title');
	
	}
	
	protected function _shouldUseRecommendedProduct() {
	
		return $this->_shouldRenderValue('UseRecommendedProduct');
	
	}
	
	protected function _renderUseRecommendedProduct() {
	
		return $this->_renderValue('UseRecommendedProduct');
	
	}
	
	protected function _shouldRenderUUID() {
	
		return $this->_shouldRenderValue('UUID');
	
	}
	
	protected function _renderUUID() {
	
		return $this->_renderValue('UUID');
	
	}
	
}