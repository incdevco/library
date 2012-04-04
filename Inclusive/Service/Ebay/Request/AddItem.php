<?php

abstract class Inclusive_Service_Ebay_Request_AddItem 
	extends Inclusive_Service_Ebay_Request_Abstract {
	
	const ITEM = 'Item';
	
	const ITEM_APPLICATIONDATA = 'Item.ApplicationData';
	
	const ITEM_ATTRIBUTEARRAY = 'Item.AttributeArray';
	
	const ITEM_ATTRIBUTEARRAY_ATTRIBUTE = 'Item.AttributeArray.Attribute';
	
	const ITEM_ATTRIBUTEARRAY_ATTRIBUTE_VALUE = 
		'Item.AttributeArray.Attribute.Value';
	
	const ITEM_ATTRIBUTEARRAY_ATTRIBUTE_VALUE_VALUELITERAL = 
		'Item.AttributeArray.Attribute.Value.ValueLiteral';
		
	const ITEM_AUTOPAY = 'Item.AutoPay';
	
	const ITEM_BESTOFFERDETAILS = 'Item.BestOfferDetails';
	
	const ITEM_BESTOFFERDETAILS_BESTOFFERENABLED = 
		'Item.BestOfferDetails.BestOfferEnabled';
	
	const ITEM_BUYERREQUIREMENTDETAILS = 'Item.BuyerRequiredDetails';
	
	const ITEM_BUYERREQUIREMENTDETAILS_LINKEDPAYPALACCOUNT = 
		'Item.BuyerRequiredDetails.LinkedPayPalAccount';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMBUYERPOLICYVIOLATIONS = 
		'Item.BuyerRequiredDetails.MaximumBuyerPolicyViolations';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMBUYERPOLICYVIOLATIONS_COUNT = 
		'Item.BuyerRequiredDetails.MaximumBuyerPolicyViolations.Count';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMBUYERPOLICYVIOLATIONS_PERIOD = 
		'Item.BuyerRequiredDetails.MaximumBuyerPolicyViolations.Period';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMITEMREQUIREMENTS = 
		'Item.BuyerRequiredDetails.MaximumItemRequirements';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMITEMCOUNT = 
		'Item.BuyerRequiredDetails.MaximumItemCount';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMFEEDBACKSCORE = 
		'Item.BuyerRequiredDetails.MaximumFeedbackScore';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMUNPAIDITEMSTRIKESINFO = 
		'Item.BuyerRequiredDetails.MaximumUnpaidItemStrikesInfo';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMUNPAIDITEMSTRIKESINFO_COUNT = 
		'Item.BuyerRequiredDetails.MaximumUnpaidItemStrikesInfo.Count';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MAXIMUMUNPAIDITEMSTRIKESINFO_PERIOD = 
		'Item.BuyerRequiredDetails.MaximumUnpaidItemStrikesInfo.Period';
	
	const ITEM_BUYERREQUIREMENTDETAILS_MINIMUMFEEDBACKSCORE = 
		'Item.BuyerRequiredDetails.MinimumFeedbackScore';
	
	const ITEM_BUYERREQUIREMENTDETAILS_SHIPTOREGISTRATIONCOUNTRY = 
		'Item.BuyerRequiredDetails.ShipToRegistrationCountry';
	
	const ITEM_BUYERREQUIREMENTDETAILS_VERIFIEDUSERREQUIREMENTS = 
		'Item.BuyerRequiredDetails.VerifiedUserRequirements';
	
	const ITEM_BUYERREQUIREMENTDETAILS_VERIFIEDUSERREQUIREMENTS_MINIMUMFEEDBACKSCORE = 
		'Item.BuyerRequiredDetails.VerifiedUserRequirements.MinimumFeedbackScore';
	
	const ITEM_BUYERREQUIREMENTDETAILS_VERIFIEDUSERREQUIREMENTS_VERIFIEDUSER = 
		'Item.BuyerRequiredDetails.VerifiedUserRequirements.VerifiedUser';
	
	const ITEM_BUYERREQUIREMENTDETAILS_ZEROFEEDBACKSCORE = 
		'Item.BuyerRequiredDetails.ZeroFeedbackScore';
	
	const ITEM_BUYERRESPONSIBLEFORSHIPPING = 
		'Item.BuyerResponsibleForShipping';
	
	const ITEM_BUYITNOWPRICE = 'Item.BuyItNowPrice';
	
	const ITEM_CATEGORYBASEDATTRIBUTESPREFILL = 
		'Item.CategoryBasedAttributesPrefill';
	
	const ITEM_CATEGOERYMAPPINGALLOWED = 'Item.CategoryMappingAllowed';
	
	const ITEM_CHARITY = 'Item.Charity';
	
	const ITEM_CHARITY_CHARITYID = 'Item.Charity.CharityID';
	
	const ITEM_CHARITY_CHARITYNUMBER = 'Item.Charity.CharityNumber';
	
	const ITEM_CHARITY_DONATIONPERCENT = 'Item.Charity.DonationPercent';
	
	const ITEM_CONDITIONID = 'Item.ConditoinID';
	
	const ITEM_COUNTRY = 'Item.Country';
	
	const ITEM_CROSSBORDERTRADE = 'Item.CrossBorderTrade';
	
	const ITEM_CURRENCY = 'Item.Currency';
	
	const ITEM_DESCRIPTION = 'Item.Description';
	
	const ITEM_DISABLEBUYERREQUIREMENTS = 'Item.DisableBuyerRequirements';
	
	const ITEM_DISCOUNTPRICEINFO = 'Item.DiscountPriceInfo';
	
	const ITEM_DISCOUNTPRICEINFO_MADEFOROUTLETCOMPARISONPRICE = 
		'Item.DiscountPriceInfo.MadeForOutletComparisonPrice';
	
	const ITEM_DISCOUNTPRICEINFO_MINIMUMADVERTISEDPRICE = 
		'Item.DiscountPriceInfo.MinimumAdvertisingPrice';
	
	const ITEM_DISCOUNTPRICEINFO_MINIMUMADVERTISEDPRICEEXPOSURE = 
		'Item.DiscountPriceInfo.MinimumAdvertisedPriceExposure';
	
	const ITEM_DISCOUNTPRICEINFO_ORIGINALRETAILPRICE = 
		'Item.DiscountPriceInfo.OriginalRetailPrice';
	
	const ITEM_DISCOUNTPRICEINFO_SOLDOFFEBAY = 
		'Item.DiscountPriceInfo.SoldOffeBay';
	
	const ITEM_DISCOUNTPRICEINFO_SOLDONEBAY = 
		'Item.DiscountPriceInfo.SoldOneBay';
	
	const ITEM_DISPATCHTIMEMAX = 'Item.DispatchTimeMax';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS = 
		'Item.ExtendedSellerContactDetails';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CLASSIFIEDADCONTACTBYEMAILENABLED = 
		'Item.ExtendedSellerContactDetails.ClassifiedAdContactByEmailEnabled';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_HOURS1ANYTIME = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.Hours1AnyTime';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_HOURS1DAYS = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.Hours1Days';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_HOURS1FROM = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.Hours1From';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_HOURS1TO = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.Hours1To';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_HOURS2ANYTIME = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.Hours2AnyTime';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_HOURS2DAYS = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.Hours2Days';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_HOURS2FROM = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.Hours2From';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_HOURS2TO = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.Hours2To';
	
	const ITEM_EXTENDEDSELLERCONTACTDETAILS_CONTACTHOURSDETAILS_TIMEZONEID = 
		'Item.ExtendedSellerContactDetails.ContactHoursDetails.TimeZoneID';
	
	const ITEM_EXTERNALPRODUCTID = 'Item.ExternalProductID';
	
	const ITEM_EXTERNALPRODUCTID_RETURNSEARCHRESULTONDUPLICATES = 
		'Item.ExternalProductID.ReturnSearchResultOnDuplicates';
	
	const ITEM_EXTERNALPRODUCTID_TYPE = 'Item.ExternalProductID.Type';
	
	const ITEM_EXTERNALPRODUCTID_VALUE = 'Item.ExternalProductID.Value';
	
	const ITEM_GETITFAST = 'Item.GetItFast';
	
	const ITEM_GIFTICON = 'Item.GiftIcon';
	
	const ITEM_GIFTSERVICES = 'Item.GiftServices';
	
	const ITEM_HITCOUNTER = 'Item.HitCounter';
	
	const ITEM_ITEMCOMPATIBILITYLIST = 'Item.ItemCompatibilityList';
	
	const ITEM_ITEMCOMPATIBILITYLIST_COMPATIBILITY = 
		'Item.ItemCompatibilityList.Compatibility';
	
	const ITEM_ITEMCOMPATIBILITYLIST_COMPATIBILITY_COMPATIBILITYNOTES = 
		'Item.ItemCompatibilityList.Compatibility.CompatibilityNotes';
	
	const ITEM_ITEMCOMPATIBILITYLIST_COMPATIBILITY_NAMEVALUELIST = 
		'Item.ItemCompatibilityList.Compatibility.NameValueLIst';
	
	const ITEM_ITEMCOMPATIBILITYLIST_COMPATIBILITY_NAMEVALUELIST_NAME = 
		'Item.ItemCompatibilityList.Compatibility.NameValueLIst.Name';
	
	const ITEM_ITEMCOMPATIBILITYLIST_COMPATIBILITY_NAMEVALUELIST_VALUE = 
		'Item.ItemCompatibilityList.Compatibility.NameValueLIst.Value';
	
	const ITEM_ITEMSPECIFICS = 'Item.ItemSpecifics';
	
	const ITEM_ITEMSPECIFICS_NAMEVALUELIST = 
		'Item.ItemSpecifics.NameValueList';
	
	const ITEM_ITEMSPECIFICS_NAMEVALUELIST_NAME = 
		'Item.ItemSpecifics.NameValueList.Name';
	
	const ITEM_ITEMSPECIFICS_NAMEVALUELIST_VALUE = 
		'Item.ItemSpecifics.NameValueList.Value';
		
	const ITEM_LISTINGCHECKOUTREDIRECTPREFERENCE = 
		'Item.ListingCheckoutRedirectPreference';
	
	const ITEM_LISTINGCHECKOUTREDIRECTPREFERENCE_PROSTORESSTORENAME = 
		'Item.ListingCheckoutRedirectPreference.ProStoresStoreName';
	
	const ITEM_LISTINGCHECKOUTREDIRECTPREFERENCE_SELLERTHIRDPARTYUSERNAME = 
		'Item.ListingCheckoutRedirectPreference.SellerThirdPartyUsername';
		
	const ITEM_LISTINGDESIGNER = 'Item.ListingDesigner';
	
	const ITEM_LISTINGDESIGNER_LAYOUTID = 'Item.ListingDesigner.LayoutID';
	
	const ITEM_LISTINGDESIGNER_OPTIMALPICTURESIZE = 
		'Item.ListingDesigner.OptimalPictureSize';
	
	const ITEM_LISTINGDESIGNER_THEMEID = 'Item.ListingDesigner.ThemeID';
	
	const ITEM_LISTINGDETAILS = 'Item.ListingDetails';
	
	const ITEM_LISTINGDETAILS_BESTOFFERAUTOACCEPTPRICE = 
		'Item.ListingDetails.BestOfferAutoAcceptPrice';
	
	const ITEM_LISTINGDETAILS_LOCALLISTINGDISTANCE = 
		'Item.ListingDetails.LocalListingDeistance';
	
	const ITEM_LISTINGDETAILS_MINIMUMBESTOFFERPRICE = 
		'Item.ListingDetails.MinimumBestOfferPrice';
	
	const ITEM_LISTINGDETAILS_PAYPERLEADENABLED = 
		'Item.ListingDetails.PayPerLeadEnabled';
	
	const ITEM_LISTINGDURATION = 'Item.ListingDuration';
	
	const ITEM_LISTINGENHANCEMENT = 'Item.ListingEnhancement';
	
	const ITEM_LISTINGSUBTYPE2 = 'Item.ListingSubtype2';
	
	const ITEM_LISTINGTYPE = 'Item.ListingType';
	
	const ITEM_LOCATION = 'Item.Location';
	
	const ITEM_LOOKUPATTRIBUTEARRAY = 'Item.LookupAttributeArray';
	
	const ITEM_LOOKUPATTRIBUTEARRAY_LOOKUPATTRIBUTE = 
		'Item.LookupAttributeArray.LookupAttribute';
	
	const ITEM_LOOKUPATTRIBUTEARRAY_LOOKUPATTRIBUTE_NAME = 
		'Item.LookupAttributeArray.LookupAttribute.Name';
	
	const ITEM_LOOKUPATTRIBUTEARRAY_LOOKUPATTRIBUTE_VALUE = 
		'Item.LookupAttributeArray.LookupAttribute.Value';
		
	const ITEM_LOTSIZE = 'Item.LotSize';
	
	const ITEM_MOTORSGERMANYSEARCHABLE = 'Item.MotorsGermanySearchable';
	
	const ITEM_PAYMENTDETAILS = 'Item.PaymentDtails';
	
	const ITEM_PAYMENTDETAILS_DAYSTOFULLPAYMENT = 
		'Item.PaymentDtails.DaysToFullPayment';
	
	const ITEM_PAYMENTDETAILS_DEPOSITAMOUNT = 
		'Item.PaymentDtails.DepositAmount';
	
	const ITEM_PAYMENTDETAILS_DEPOSITTYPE = 
		'Item.PaymentDtails.DepositType';
	
	const ITEM_PAYMENTDETAILS_HOURSTODEPOSIT = 
		'Item.PaymentDtails.HoursToDeposit';
	
	const ITEM_PAYMENTMETHODS = 'Item.PaymentMethods';
	
	const ITEM_PAYPAYLEMAILADDRESS = 'Item.PayPalEmailAddress';
	
	const ITEM_PICTUREDETAILS = 'Item.PictureDetails';
	
	const ITEM_PICTUREDETAILS_EXTERNALPICTUREURL = 
		'Item.PictureDetails.ExternalPictureURL';
	
	const ITEM_PICTUREDETAILS_GALLERYDURATION = 
		'Item.PictureDetails.GalleryDuration';
	
	const ITEM_PICTUREDETAILS_GALLERYTYPE = 
		'Item.PictureDetails.GalleryType';
	
	const ITEM_PICTUREDETAILS_GALLERYURL = 
		'Item.PictureDetails.GalleryURL';
	
	const ITEM_PICTUREDETAILS_PHOTODISPLAY = 
		'Item.PictureDetails.PhotoDisplay';
	
	const ITEM_PICTUREDETAILS_PICTUREURL = 
		'Item.PictureDetails.PictureURL';
	
	const ITEM_POSTALCODE = 'Item.PostalCode';
	
	const ITEM_POSTCHECKOUTEXPERIENCEENABLED = 
		'Item.PostCheckoutExperienceEnabled';
	
	const ITEM_PRIMARYCATEGORY = 'Item.PrimaryCategory';
	
	const ITEM_PRIMARYCATEGORY_CATEGORYID = 
		'Item.PrimaryCategory.CategoryID';
	
	const ITEM_PRIVATELISTING = 'Item.PrivateListing';
	
	const ITEM_PRODUCTLISTINGDETAILS = 'Item.ProductListingDetails';
	
	const ITEM_PRODUCTLISTINGDETAILS_BRANDMPN = 
		'Item.ProductListingDetails.BrandMPN';
	
	const ITEM_PRODUCTLISTINGDETAILS_BRANDMPN_BRAND = 
		'Item.ProductListingDetails.BrandMPN.Brand';
	
	const ITEM_PRODUCTLISTINGDETAILS_BRANDMPN_MPN = 
		'Item.ProductListingDetails.BrandMPN.MPN';
	
	const ITEM_PRODUCTLISTINGDETAILS_EAN = 
		'Item.ProductListingDetails.EAN';
	
	const ITEM_PRODUCTLISTINGDETAILS_INCLUDEPREFILLEDITEMINFORMATION = 
		'Item.ProductListingDetails.IncludePrefilledItemInformation';
	
	const ITEM_PRODUCTLISTINGDETAILS_INCLUDESTOCKPHOTOURL = 
		'Item.ProductListingDetails.IncludeStockPhotoURL';
	
	const ITEM_PRODUCTLISTINGDETAILS_ISBN = 
		'Item.ProductListingDetails.ISBN';
	
	const ITEM_PRODUCTLISTINGDETAILS_LISTIFNOPRODUCT = 
		'Item.ProductListingDetails.ListIfNoProduct';
	
	const ITEM_PRODUCTLISTINGDETAILS_PRODUCTID = 
		'Item.ProductListingDetails.ProductID';
	
	const ITEM_PRODUCTLISTINGDETAILS_PRODUCTREFERENCEID = 
		'Item.ProductListingDetails.ProductReferenceID';
	
	const ITEM_PRODUCTLISTINGDETAILS_RETURNSEARCHRESULTONDUPLICATES = 
		'Item.ProductListingDetails.ReturnSearchResultOnDuplicates';
	
	const ITEM_PRODUCTLISTINGDETAILS_TICKETLISTINGDETAILS = 
		'Item.ProductListingDetails.TicketListingDetails';
	
	const ITEM_PRODUCTLISTINGDETAILS_TICKETLISTINGDETAILS_EVENTTITLE = 
		'Item.ProductListingDetails.TicketListingDetails.EventTitle';
	
	const ITEM_PRODUCTLISTINGDETAILS_TICKETLISTINGDETAILS_PRINTEDDATE = 
		'Item.ProductListingDetails.TicketListingDetails.PrintedDate';
	
	const ITEM_PRODUCTLISTINGDETAILS_TICKETLISTINGDETAILS_PRINTEDTIME = 
		'Item.ProductListingDetails.TicketListingDetails.PrintedTime';
	
	const ITEM_PRODUCTLISTINGDETAILS_TICKETLISTINGDETAILS_VENUE = 
		'Item.ProductListingDetails.TicketListingDetails.Venue';
	
	const ITEM_PRODUCTLISTINGDETAILS_UPC = 'Item.ProductListingDetails.UPC';
	
	const ITEM_PRODUCTLISTINGDETAILS_USEFIRSTPRODUCT = 
		'Item.ProductListingDetails.UseFirstProduct';
	
	const ITEM_PRODUCTLISTINGDETAILS_USESTOCKPHOTOURLASGALLERY = 
		'Item.ProductListingDetails.UseStockPhotoURLAsGallery';
		
	const ITEM_QUANTITY = 'Item.Quantity';
	
	const ITEM_QUANTITYINFO = 'Item.QuantityInfo';
	
	const ITEM_QUANTITYINFO_MINIMUMREMNANTSET = 
		'Item.QuantityInfo.MinimumRemnantSet';
	
	const ITEM_RESERVEPRICE = 'Item.ReservePrice';
	
	const ITEM_RETURNPOLICY = 'Item.ReturnPolicy';
	
	const ITEM_RETURNPOLICY_DESCRIPTION = 'Item.ReturnPolicy.Description';
	
	const ITEM_RETURNPOLICY_EAN = 'Item.ReturnPolicy.EAN';
	
	const ITEM_RETURNPOLICY_REFUNDOPTION = 
		'Item.ReturnPolicy.RefundOption';
	
	const ITEM_RETURNPOLICY_RETURNSACCEPTEDOPTION = 
		'Item.ReturnPolicy.ReturnsAcceptedOption';
	
	const ITEM_RETURNPOLICY_RETURNSWITHINOPTION = 
		'Item.ReturnPolicy.ReturnsWithinOption';
	
	const ITEM_RETURNPOLICY_SHIPPINGCOSTPAIDBYOPTION = 
		'Item.ReturnPolicy.ShippingCostPaidByOption';
	
	const ITEM_RETURNPOLICY_WARRANTYDURATIONOPTION = 
		'Item.ReturnPolicy.WarrantyDurationOption';
	
	const ITEM_RETURNPOLICY_WARRANTYOFFEREDOPTION = 
		'Item.ReturnPolicy.WarrantyOfferedOption';
	
	const ITEM_RETURNPOLICY_WARRANTYTYPEOPTION = 
		'Item.ReturnPolicy.WarrantyTypeOption';
	
	const ITEM_SCHEDULETIME = 'Item.ScheduleTime';
	
	const ITEM_SECONDARYCATEGORY = 'Item.SecondaryCategory';
	
	const ITEM_SECONDARYCATEGORY_CATEGORYID = 
		'Item.SecondaryCategory.CategoryID';
	
	const ITEM_SELLER = 'Item.Seller';
	
	const ITEM_SELLER_MOTORSDEALER = 'Item.Seller.MotorDealer';
	
	const ITEM_SELLERCONTACTDETAILS = 'Item.SellerContactDetails';
	
	const ITEM_SELLERCONTACTDETAILS_COMPANYNAME = 
		'Item.SellerContactDetails.CompanyName';
	
	const ITEM_SELLERCONTACTDETAILS_COUNTY = 
		'Item.SellerContactDetails.County';
	
	const ITEM_SELLERCONTACTDETAILS_PHONE2AREAORCITYCODE = 
		'Item.SellerContactDetails.Phone2AreaOrCityCode';
	
	const ITEM_SELLERCONTACTDETAILS_PHONE2COUNTRYCODE = 
		'Item.SellerContactDetails.Phone2CountryCode';
	
	const ITEM_SELLERCONTACTDETAILS_PHONE2LOCALNUMBER = 
		'Item.SellerContactDetails.Phone2LocalNumber';
	
	const ITEM_SELLERCONTACTDETAILS_PHONEAREAORCITYCODE = 
		'Item.SellerContactDetails.PhoneAreaOrCityCode';
	
	const ITEM_SELLERCONTACTDETAILS_PHONECOUNTRYCODE = 
		'Item.SellerContactDetails.PhoneCountryCode';
	
	const ITEM_SELLERCONTACTDETAILS_PHONELOCALNUMBER = 
		'Item.SellerContactDetails.PhoneLocalNumber';
	
	const ITEM_SELLERCONTACTDETAILS_STREET = 
		'Item.SellerContactDetails.Street';
	
	const ITEM_SELLERCONTACTDETAILS_STREET2 = 
		'Item.SellerContactDetails.Street2';
	
	const ITEM_SELLERINVENTORYID = 'Item.SellerInventoryID';
	
	const ITEM_SELLERPROFILES = 'Item.SellerProfiles';
	
	const ITEM_SELLERPROFILES_SELLERPAYMENTPROFILE = 
		'Item.SellerProfiles.SellerPaymentProfile';
	
	const ITEM_SELLERPROFILES_SELLERPAYMENTPROFILE_PAYMENTPROFILEID = 
		'Item.SellerProfiles.SellerPaymentProfile.PaymentProfileID';
	
	const ITEM_SELLERPROFILES_SELLERPAYMENTPROFILE_PAYMENTPROFILENAME = 
		'Item.SellerProfiles.SellerPaymentProfile.PaymentProfileName';
	
	const ITEM_SELLERPROFILES_SELLERRETURNPROFILE = 
		'Item.SellerProfiles.SellerReturnProfile';
	
	const ITEM_SELLERPROFILES_SELLERRETURNPROFILE_RETURNPROFILEID = 
		'Item.SellerProfiles.SellerReturnProfile.ReturnProfileID';
	
	const ITEM_SELLERPROFILES_SELLERRETURNPROFILE_RETURNPROFILENAME = 
		'Item.SellerProfiles.SellerReturnProfile.ReturnProfileName';
	
	const ITEM_SELLERPROFILES_SELLERSHIPPINGPROFILE = 
		'Item.SellerProfiles.SellerShippingProfile';
	
	const ITEM_SELLERPROFILES_SELLERSHIPPINGPROFILE_SHIPPINGPROFILEID = 
		'Item.SellerProfiles.SellerShippingProfile.ShippingProfileID';
	
	const ITEM_SELLERPROFILES_SELLERSHIPPINGPROFILE_SHIPPINGPROFILENAME = 
		'Item.SellerProfiles.SellerShippingProfile.ShippingProfileName';
		
	const ITEM_SELLERPROVIDEDTITLE = 'Item.SellerProvidedTitle';
	
	const ITEM_SHIPPINGDETAILS = 'Item.ShippingDetails';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE = 
		'Item.ShippingDetails.CalculatedShippingRate';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_INTERNATIONALPACKAGINGHANDLINGCOSTS = 
		'Item.ShippingDetails.CalculatedShippingRate.InternationalPackagingHandlingCosts';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_MEASUREMENTUNIT = 
		'Item.ShippingDetails.CalculatedShippingRate.MeasurementUnit';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_ORIGINATINGPOSTALCODE = 
		'Item.ShippingDetails.CalculatedShippingRate.OriginatingPostalCode';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_PACKAGEDEPTH = 
		'Item.ShippingDetails.CalculatedShippingRate.PackageDepth';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_PACKAGELENGTH = 
		'Item.ShippingDetails.CalculatedShippingRate.PackageLength';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_PACKAGEWIDTH = 
		'Item.ShippingDetails.CalculatedShippingRate.PackageWidth';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_PACKAGEHANDLINGCOSTS = 
		'Item.ShippingDetails.CalculatedShippingRate.PackageHandlingCosts';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_SHIPPINGIRREGULAR = 
		'Item.ShippingDetails.CalculatedShippingRate.ShippingIrregular';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_SHIPPINGPACKAGE = 
		'Item.ShippingDetails.CalculatedShippingRate.ShippingPackage';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_WEIGHTMAJOR = 
		'Item.ShippingDetails.CalculatedShippingRate.WeightMajor';
	
	const ITEM_SHIPPINGDETAILS_CALCULATEDSHIPPINGRATE_WEIGHTMINOR = 
		'Item.ShippingDetails.CalculatedShippingRate.WeightMinor';
	
	const ITEM_SHIPPINGDETAILS_CODCOST = 'Item.ShippingDetails.CODCost';
	
	const ITEM_SHIPPINGDETAILS_EXCLUDESHIPTOLOCATION = 
		'Item.ShippingDetails.ExcludeShipToLocation';
	
	const ITEM_SHIPPINGDETAILS_INSURANCEDETAILS = 
		'Item.ShippingDetails.InsuranceDetails';
	
	const ITEM_SHIPPINGDETAILS_INSURANCEDETAILS_INSURANCEFEE = 
		'Item.ShippingDetails.InsuranceDetails.InsuranceFee';
	
	const ITEM_SHIPPINGDETAILS_INSURANCEDETAILS_INSURANCEOPTION = 
		'Item.ShippingDetails.InsuranceDetails.InsuranceOption';
	
	const ITEM_SHIPPINGDETAILS_INSURANCEFEE = 
		'Item.ShippingDetails.InsuranceFee';
	
	const ITEM_SHIPPINGDETAILS_INSURANCEOPTION = 
		'Item.ShippingDetails.InsuranceOption';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALINSURANCEDETAILS = 
		'Item.ShippingDetails.InternationalInsuranceDetails';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALINSURANCEDETAILS_INSURANCEFEE = 
		'Item.ShippingDetails.InternationalInsuranceDetails.InsuranceFee';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALINSURANCEDETAILS_INSURANCEOPTION = 
		'Item.ShippingDetails.InternationalInsuranceDetails.InsuranceOption';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALPROMOTIONALSHIPPINGDISCOUNT = 
		'Item.ShippingDetails.InternationalPromotionalShippingDiscount';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALPROMOTIONALSHIPPINGDISCOUNTPROFILEID = 
		'Item.ShippingDetails.InternationalPromotionalShippingDiscountProfileID';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALSHIPPINGSERVICEOPTION = 
		'Item.ShippingDetails.InternationalShippingServiceOption';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALSHIPPINGSERVICEOPTION_SHIPPINGSERVICEADDITIONALCOST = 
		'Item.ShippingDetails.InternationalShippingServiceOption.ShippingServiceAdditionalCost';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALSHIPPINGSERVICEOPTION_SHIPPINGSERVICECOST = 
		'Item.ShippingDetails.InternationalShippingServiceOption.ShippingServiceCost';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALSHIPPINGSERVICEOPTION_SHIPPINGSERVICEPRIORITY = 
		'Item.ShippingDetails.InternationalShippingServiceOption.ShippingServicePriority';
	
	const ITEM_SHIPPINGDETAILS_INTERNATIONALSHIPPINGSERVICEOPTION_SHIPTOLOCATION = 
		'Item.ShippingDetails.InternationalShippingServiceOption.ShipToLocation';
	
	const ITEM_SHIPPINGDETAILS_PAYMENTINSTRUCTIONS = 
		'Item.ShippingDetails.PaymentInstructions';
	
	const ITEM_SHIPPINGDETAILS_PROMOTIONALSHIPPINGDISCOUNT = 
		'Item.ShippingDetails.PromotionalShippingDiscount';
	
	const ITEM_SHIPPINGDETAILS_RATETABLEDETAILS = 
		'Item.ShippingDetails.RateTableDetails';
	
	const ITEM_SHIPPINGDETAILS_RATETABLEDETAILS_DOMESTICRATETABLE = 
		'Item.ShippingDetails.RateTableDetails.DomesticRateTable';
	
	const ITEM_SHIPPINGDETAILS_SALESTAX = 
		'Item.ShippingDetails.SalesTax';
	
	const ITEM_SHIPPINGDETAILS_SALESTAX_SALESTAXPERCENT = 
		'Item.ShippingDetails.SalesTax.SalesTaxPercent';
	
	const ITEM_SHIPPINGDETAILS_SALESTAX_SALESTAXSTATE = 
		'Item.ShippingDetails.SalesTax.SalesTaxState';
	
	const ITEM_SHIPPINGDETAILS_SALESTAX_SHIPPINGINCLUDEDINTAX = 
		'Item.ShippingDetails.SalesTax.ShippingIncludedInTax';
	
	const ITEM_SHIPPINGDETAILS_SALESTAX_SHIPPINGDISCOUNTPROFILEID = 
		'Item.ShippingDetails.SalesTax.ShippingDiscountProfileID';
	
	const ITEM_SHIPPINGDETAILS_SHIPPINGSERVICEOPTIONS = 
		'Item.ShippingDetails.ShippingServiceOptions';
	
	const ITEM_SHIPPINGDETAILS_SHIPPINGSERVICEOPTIONS_FREESHIPPING = 
		'Item.ShippingDetails.ShippingServiceOptions.FreeShipping';
	
	const ITEM_SHIPPINGDETAILS_SHIPPINGSERVICEOPTIONS_SHIPPINGSERVICE = 
		'Item.ShippingDetails.ShippingServiceOptions.ShippingService';
	
	const ITEM_SHIPPINGDETAILS_SHIPPINGSERVICEOPTIONS_SHIPPINGSERVICEADDITIONALCOST = 
		'Item.ShippingDetails.ShippingServiceOptions.ShippingServiceAdditionalCost';
	
	const ITEM_SHIPPINGDETAILS_SHIPPINGSERVICEOPTIONS_SHIPPINGSERVICECOST = 
		'Item.ShippingDetails.ShippingServiceOptions.ShippingServiceCost';
	
	const ITEM_SHIPPINGDETAILS_SHIPPINGSERVICEOPTIONS_SHIPPINGSERVICEPRIORITY = 
		'Item.ShippingDetails.ShippingServiceOptions.ShippingServicePriority';
	
	const ITEM_SHIPPINGDETAILS_SHIPPINGSERVICEOPTIONS_SHIPPINGSURCHARGE = 
		'Item.ShippingDetails.ShippingServiceOptions.ShippingSurcharge';
	
	const ITEM_SHIPPINGDETAILS_SHIPPINGTYPE = 
		'Item.ShippingDetails.ShippingType';
	
	const ITEM_SHIPPINGPACKAGEDETAILS = 
		'Item.ShippingPackagingDetails';
	
	const ITEM_SHIPPINGPACKAGEDETAILS_MEASUREMENTUNIT = 
		'Item.ShippingPackagingDetails.MeasurementUnit';
	
	const ITEM_SHIPPINGPACKAGEDETAILS_PACKAGEDEPTH = 
		'Item.ShippingPackagingDetails.PackageDepth';
	
	const ITEM_SHIPPINGPACKAGEDETAILS_PACKAGELENGTH = 
		'Item.ShippingPackagingDetails.PackageLength';
	
	const ITEM_SHIPPINGPACKAGEDETAILS_PACKAGEWIDTH = 
		'Item.ShippingPackagingDetails.PackageWidth';
	
	const ITEM_SHIPPINGPACKAGEDETAILS_SHIPPINGIRREGULAR = 
		'Item.ShippingPackagingDetails.ShippingIrregular';
	
	const ITEM_SHIPPINGPACKAGEDETAILS_SHIPPINGPACKAGE = 
		'Item.ShippingPackagingDetails.ShippingPackage';
	
	const ITEM_SHIPPINGPACKAGEDETAILS_WEIGHTMAJOR = 
		'Item.ShippingPackagingDetails.WeightMajor';
	
	const ITEM_SHIPPINGPACKAGEDETAILS_WEIGHTMINOR = 
		'Item.ShippingPackagingDetails.WeightMinor';
	
	const ITEM_SHIPPINGTERMSINDESCRIPTION = 
		'Item.ShippingTermsInDescription';
	
	const ITEM_SHIPTOLOCATIONS = 'Item.ShippingToLocations';
	
	const ITEM_SITE = 'Item.Site';
	
	const ITEM_SKU = 'Item.SKU';
	
	const ITEM_SKYPECONTACTOPTION = 'Item.SkypeContactOption';
	
	const ITEM_SKYPEENABLED = 'Item.SkypeEnabled';
	
	const ITEM_SKYPEID = 'Item.SkypeID';
	
	const ITEM_STARTPRICE = 'Item.StartPrice';
	
	const ITEM_STOREFRONT = 'Item.Storefront';
	
	const ITEM_STOREFRONT_STORECATEGORY2ID = 
		'Item.Storefront.StoreCategory2ID';
	
	const ITEM_STOREFRONT_STORECATEGORYID = 
		'Item.Storefront.StoreCategoryID';
	
	const ITEM_SUBTITLE = 'Item.SubTitle';
	
	const ITEM_TAXCATEGORY = 'Item.TaxCategory';
	
	const ITEM_THIRDPARTYCHECKOUT = 'Item.ThirdPartyCheckout';
	
	const ITEM_THIRDPARTYCHECKOUTINTEGRATION = 
		'Item.ThirdPartyCheckoutIntegration';
	
	const ITEM_TITLE = 'Item.Title';
	
	const ITEM_USERECOMMENDEDPRODUCT = 'Item.UseRecommendedProduct';
	
	const ITEM_USETAXTABLE = 'Item.UseTaxTable';
	
	const ITEM_UUID = 'Item.UUID';
	
	const ITEM_VATDETAILS = 'Item.VATDetails';
	
	const ITEM_VATDETAILS_BUSINESSSELLER = 
		'Item.VATDetails.BusinessSeller';
	
	const ITEM_VATDETAILS_RESTRICTEDTOBUSINESS = 
		'Item.VATDetails.RestrictedToBusiness';
	
	const ITEM_VATDETAILS_VATPERCENT = 
		'Item.VATDetails.VATPercent';
	
	const ITEM_VIN = 'Item.VIN';
	
	const ITEM_VRM = 'Item.VRM';
	
	const CATEGORY2ID = 'Category2ID'
	
	const CATEGORYID = 'CategoryID';
	
	const DISCOUNTREASON = 'DiscountReason';
	
	const ENDTIME = 'EndTime';
	
	const FEES = 'Fees';
	
	const FEESFEE = 'Fees.Fee';
	
	const FEESFEEFEE = 'Fees.Fee.Fee';
	
	const FEESFEENAME = 'Fees.Fee.Name';
	
	const FEESFEEPROMOTIONALDISCOUNT = 'Fees.Fee.PromotionalDiscount';
	
	const ITEMID = 'ItemID';
	
	const PRODUCTSUGGESTIONS = 'ProductSuggestions';
	
	const PRODUCTSUGGESTIONS_PRODUCTSUGGESTION = 
		'ProductSuggestions.ProductSuggestion';
	
	const PRODUCTSUGGESTIONS_PRODUCTSUGGESTION_EPID = 
		'ProductSuggestions.ProductSuggestion.EPID';
	
	const PRODUCTSUGGESTIONS_PRODUCTSUGGESTION_RECOMMENDED = 
		'ProductSuggestions.ProductSuggestion.Recommended';
	
	const PRODUCTSUGGESTIONS_PRODUCTSUGGESTION_STOCKPHOTO = 
		'ProductSuggestions.ProductSuggestion.StockPhoto';
	
	const PRODUCTSUGGESTIONS_PRODUCTSUGGESTION_TITLE = 
		'ProductSuggestions.ProductSuggestion_TITLE';
		
	const STARTTIME = 'StartTime';
	
}