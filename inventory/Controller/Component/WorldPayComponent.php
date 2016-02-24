<?php
/**
 * Default Component
 *
 * PHP version 5
   This component consists the website default functions
 */
 
class WorldPayComponent extends Component {

	protected $_controller = null;
  /**
 * Remove any special character in string and used only numeric and digit
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
        }
        public function initialize(Controller $controller) {
		$this->_controller =& $controller;
	}
	
	public function request()
	{
		$xml='<?xml version="1.0" encoding="UTF-8"?>
					<!DOCTYPE paymentService PUBLIC "-//WorldPay/DTD
							WorldPay PaymentService v1//EN"
							"http://dtd.worldpay.com/paymentService_v1.dtd">
							<paymentService version="1.4" merchantCode="MERCHANTCODE">
    						<submit>
        					<order orderCode="T0211011" installationId="111111">
            				<description>20 English Roses from MYMERCHANT Webshops</description>
            				<amount value="100" currencyCode="GBP" exponent="2"/>
           					<orderContent>
                			<![CDATA[
                    			<center>
                        		<table>
                                		<tr><td bgcolor="#ffff00">Your Internet Order:</td><td colspan="2" bgcolor="#ffff00" align="right">T0211010</td></tr>
                                		<tr><td bgcolor="#ffff00" colspan="3">Your billing address:</td></tr>
                                		<tr><td colspan="3">Mr. J. Shopper<br><br>27b ParkView Mansions<br>47 Queensbridge Road<br>Chesterton<br>Cambridge<br>CB9 4BQ<br>United Kingdom</td></tr>
                                		<tr><td colspan="3">&nbsp;</td></tr>
                                		<tr><td bgcolor="#ffff00" colspan="3">Your shipping address:</td></tr>
                                		<tr><td colspan="3">Mr.J. Shopper<br>47A Queensbridge Road<br>Cambridge<br>CB9 4BQ<br>UK</td></tr>
                                		<tr><td colspan="3">&nbsp;</td></tr>
                                		<tr><td bgcolor="#ffff00" colspan="3">Our contact information:</td></tr>
                                		<tr><td colspan="3">MYMERCHANT Webshops International<br>461 Merchant Street <br>Merchant Town<br>ZZ1 1ZZ<br>UK <br>mymerchant@webshops.int<br>01234 567 890</td></tr>
                                		<tr><td colspan="3">&nbsp;</td></tr>
                                		<tr><td bgcolor="#c0c0c0" colspan="3">Billing notice:</td></tr>
                                		<tr><td colspan="3">Your payment will be handled by WorldPay<br>This name may appear on your bank statement<br>http://www.worldpay.com</td></tr>
                        </table>
                    </center>
]]>
            </orderContent>
            <paymentDetails>
                <VISA-SSL>
                    <cardNumber>4444333322221111</cardNumber>
                    <expiryDate>
                        <date month="09" year="2019"/>
                    </expiryDate>
                    <cardHolderName>J. Shopper</cardHolderName>
                    <cvc>123</cvc>
                    <cardAddress>
                        <address>
                            <street>47A Queensbridge Rd</street>
                            <postalCode>CB94BQ</postalCode>
                            <countryCode>GB</countryCode>
                        </address>
                    </cardAddress>
                </VISA-SSL>
            <session shopperIPAddress="213.137.19.45" id="0215ui8ib1" />
            </paymentDetails>
            <shopper>
                <shopperEmailAddress>jshopper@myprovider.int</shopperEmailAddress>
                <browser> 
                    <acceptHeader>text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</acceptHeader> 
                    <userAgentHeader>Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 (.NET CLR 3.5.30729)</userAgentHeader> 
                </browser>
            </shopper>
            <shippingAddress>
                <address>
                    <firstName>John</firstName>
                    <lastName>Shopper</lastName>
                    <address1>27b ParkView Mansions</address1>
                    <address2>47 Queensbridge Rd</address2>
                    <address3>Chesterton</address3>
                    <postalCode>CB94BQ</postalCode>
                    <countryCode>GB</countryCode>
                    <telephoneNumber>01234567890</telephoneNumber>
                </address>
            </shippingAddress>
        </order>
    </submit>
</paymentService>';
$url ="https://MERCHANTCODE:PASSWORD@secure-test.wp3.rbsworldpay.com/jsp/merchant/xml/paymentService.jsp";

$ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$xml);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_NOPROGRESS, 0);
    $result = curl_exec ($ch); 
	print_r($result);die;
    if ( $result == false )
    {
    echo "false";
    }
    else    
    {   
    print_r($result);
    echo $result;
    }



	}
	
}
