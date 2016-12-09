<?php

namespace Myleshyson\LaravelQuickBooks;

class Quickbooks extends \QuickBooks_IPP_Service
{
    /**
     * OAUTH Info From Quickbooks
     */
    protected $context;

    /**
     * Current Realm
     */
    protected $realm;

    /**
     * User Configuration File Array
     */
    protected $config;

    /**
     * The Auth Handler for QuickBooks
     */
    protected $IntuitAnywhere;

    /**
     * Refers to set of methods for specific QuickBooks resource
     */
    protected $service;

    /**
     * The QuickBooks resource being referenced.
     */
    protected $resource;

    
    /**
     * Makes sure User is connected to QuickBooks. Needed for every method called to QuickBooks.
     */
    public function __construct()
    {
        $this->config = config('quickbooks');

        if (!\QuickBooks_Utilities::initialized($this->config['dsn'])) {
            \QuickBooks_Utilities::initialize($this->config['dsn']);
        }

        $this->IntuitAnywhere = new \QuickBooks_IPP_IntuitAnywhere($this->config['dsn'], $this->config['encryption_key'], $this->config['oauth_consumer_key'], $this->config['oauth_consumer_secret'], $this->config['quickbooks_oauth_url'], $this->config['quickbooks_success_url']);

            // Set up the IPP instance
            $IPP = new \QuickBooks_IPP($this->config['dsn']);
        if ($this->IntuitAnywhere->check($this->config['the_username'], $this->config['the_tenant']) and
                $this->IntuitAnywhere->test($this->config['the_username'], $this->config['the_tenant'])) {
            // Get our OAuth credentials from the database
            $creds = $this->IntuitAnywhere->load($this->config['the_username'], $this->config['the_tenant']);

            // Tell the framework to load some data from the OAuth store
            $IPP->authMode(
                \QuickBooks_IPP::AUTHMODE_OAUTH,
                $this->config['the_username'],
                $creds);

            if ($this->config['sandbox']) {
                // Turn on sandbox mode/URLs 
                    $IPP->sandbox(true);
            }

            // This is our current realm
            $this->realm = $creds['qb_realm'];

            // Load the OAuth information from the database
            $this->context = $IPP->context();
        }
    }

    /**
     * Handles Data from Accounting NameList Resources 
     * @param  [array] $data [array of data passed from resource method.]
     * @param  [object] $obj  [The current resource handling the data.]
     */
    protected function handleNameListData($data, $obj)
    {
        isset($data['AbatementRate']) ? $obj->setAbatementRate($data['AbatementRate']) : '';
        isset($data['AccountAlias']) ? $obj->setAccountAlias($data['AccountAlias']) : '';
        isset($data['AccountSubType']) ? $obj->setAccountSubType($data['AccountSubType']) : '';
        isset($data['AccountType']) ? $obj->setAccountType($data['AccountType']) : '';
        isset($data['AcctNum']) ? $obj->setAcctNum($data['AcctNum']) : '';
        isset($data['Active']) ? $obj->setActive($data['Active']) : '';
        isset($data['AgencyRef']) ? $obj->setAgencyRef($data['AgencyRef']) : '';
        isset($data['APAccountRef']) ? $obj->setAPAccountRef($data['APAccountRef']) : '';
        isset($data['ARAccountRef']) ? $obj->setARAccountRef($data['ARAccountRef']) : '';
        isset($data['AssetAccountRef']) ? $obj->setAssetAccountRef($data['AssetAccountRef']) : '';
        isset($data['Balance']) ? $obj->setBalance($data['Balance']) : '';
        isset($data['BalanceWithJobs']) ? $obj->setBalanceWithJobs($data['BalanceWithJobs']) : '';
        isset($data['BillableTime']) ? $obj->setBillableTime($data['BillableTime']) : '';
        isset($data['BillRate']) ? $obj->setBillRate($data['BillRate']) : '';
        isset($data['BillWithParent']) ? $obj->setBillWithParent($data['BillWithParent']) : '';
        isset($data['BirthDate']) ? $obj->setBirthDate($data['BirthDate']) : '';
        isset($data['Classification']) ? $obj->setClassification($data['Classification']) : '';
        isset($data['CompanyName']) ? $obj->setCompanyName($data['CompanyName']) : '';
        isset($data['CurrencyRef']) ? $obj->setCurrencyRef($data['CurrencyRef']) : '';
        isset($data['CurrentBalance']) ? $obj->setCurrentBalance($data['CurrentBalance']) : '';
        isset($data['CurrentBalanceWithSubAccounts']) ? $obj->setCurrentBalanceWithSubAccounts($data['CurrentBalanceWithSubAccounts']) : '';
        isset($data['DaysOfMonthDue']) ? $obj->setDaysOfMonthDue($data['DaysOfMonthDue']) : '';
        isset($data['DefaultTaxCodeRef']) ? $obj->setDefaultTaxCodeRef($data['DefaultTaxCodeRef']) : '';
        isset($data['Description']) ? $obj->setDescription($data['Description']) : '';
        isset($data['DiscountDayOfMonth']) ? $obj->setDiscountDayOfMonth($data['DiscountDayOfMonth']) : '';
        isset($data['DiscountDays']) ? $obj->setDiscountDays($data['DiscountDays']) : '';
        isset($data['DiscountPercent']) ? $obj->setDiscountPercent($data['DiscountPercent']) : '';
        isset($data['DisplayName']) ? $obj->setDisplayName($data['DisplayName']) : '';
        isset($data['DisplayType']) ? $obj->setDisplayType($data['DisplayType']) : '';
        isset($data['DueDays']) ? $obj->setDueDays($data['DueDays']) : '';
        isset($data['DueNextMonthDays']) ? $obj->setDueNextMonthDays($data['DueNextMonthDays']) : '';
        isset($data['EffectiveTaxRate']) ? $obj->setEffectiveTaxRate($data['EffectiveTaxRate']) : '';
        isset($data['EmployeeNumber']) ? $obj->setEmployeeNumber($data['EmployeeNumber']) : '';
        isset($data['ExpenseAccountRef']) ? $obj->setExpenseAccountRef($data['ExpenseAccountRef']) : '';
        isset($data['FamilyName']) ? $obj->setFamilyName($data['FamilyName']) : '';
        isset($data['FullyQualifiedName']) ? $obj->setFullyQualifiedName($data['FullyQualifiedName']) : '';
        isset($data['FullyQualifiedName']) ? $obj->setFullyQualifiedName($data['FullyQualifiedName']) : '';
        isset($data['Gender']) ? $obj->setGender($data['Gender']) : '';
        isset($data['GivenName']) ? $obj->setGivenName($data['GivenName']) : '';
        isset($data['HiredDate']) ? $obj->setHiredDate($data['HiredDate']) : '';
        isset($data['IncomeAccountRef']) ? $obj->setIncomeAccountRef($data['IncomeAccountRef']) : '';
        isset($data['InvStartDate']) ? $obj->setInvStartDate($data['InvStartDate']) : '';
        isset($data['ItemCategoryType']) ? $obj->setItemCategoryType($data['ItemCategoryType']) : '';
        isset($data['Job']) ? $obj->setJob($data['Job']) : '';
        isset($data['Level']) ? $obj->setLevel($data['Level']) : '';
        isset($data['MiddleName']) ? $obj->setMiddleName($data['MiddleName']) : '';
        isset($data['Name']) ? $obj->setName($data['Name']) : '';
        isset($data['Notes']) ? $obj->setNotes($data['Notes']) : '';
        isset($data['OpenBalanceDate']) ? $obj->setOpenBalanceDate($data['OpenBalanceDate']) : '';
        isset($data['Organization']) ? $obj->setOrganization($data['Organization']) : '';
        isset($data['ParentRef']) ? $obj->setParentRef($data['ParentRef']) : '';
        isset($data['PaymentMethodRef']) ? $obj->setPaymentMethodRef($data['PaymentMethodRef']) : '';
        isset($data['PreferredDeliveryMethod']) ? $obj->setPreferredDeliveryMethod($data['PreferredDeliveryMethod']) : '';
        isset($data['PrintOnCheckName']) ? $obj->setPrintOnCheckName($data['PrintOnCheckName']) : '';
        isset($data['PurchaseCost']) ? $obj->setPurchaseCost($data['PurchaseCost']) : '';
        isset($data['PurchaseDesc']) ? $obj->setPurchaseDesc($data['PurchaseDesc']) : '';
        isset($data['PurchaseTaxCodeRef']) ? $obj->setPurchaseTaxCodeRef($data['PurchaseTaxCodeRef']) : '';
        isset($data['PurchaseTaxIncluded']) ? $obj->setPurchaseTaxIncluded($data['PurchaseTaxIncluded']) : '';
        isset($data['QtyOnHand']) ? $obj->setQtyOnHand($data['QtyOnHand']) : '';
        isset($data['RateValue']) ? $obj->setRateValue($data['RateValue']) : '';
        isset($data['ReleasedDate']) ? $obj->setReleasedDate($data['ReleasedDate']) : '';
        isset($data['ResaleNum']) ? $obj->setResaleNum($data['ResaleNum']) : '';
        isset($data['ReverseChargeRate']) ? $obj->setReverseChargeRate($data['ReverseChargeRate']) : '';
        isset($data['SalesTaxCodeRef']) ? $obj->setSalesTaxCodeRef($data['SalesTaxCodeRef']) : '';
        isset($data['SalesTaxIncluded']) ? $obj->setSalesTaxIncluded($data['SalesTaxIncluded']) : '';
        isset($data['SalesTermRef']) ? $obj->setSalesTermRef($data['SalesTermRef']) : '';
        isset($data['ServiceType']) ? $obj->setServiceType($data['ServiceType']) : '';
        isset($data['SKU']) ? $obj->setSKU($data['SKU']) : '';
        isset($data['SpecialTaxType']) ? $obj->setSpecialTaxType($data['SpecialTaxType']) : '';
        isset($data['SSN']) ? $obj->setSSN($data['SSN']) : '';
        isset($data['SubAccount']) ? $obj->setSubAccount($data['SubAccount']) : '';
        isset($data['SubClass']) ? $obj->setSubClass($data['SubClass']) : '';
        isset($data['SubDepartment']) ? $obj->setSubDepartment($data['SubDepartment']) : '';
        isset($data['SubItem']) ? $obj->setSubItem($data['SubItem']) : '';
        isset($data['Suffix']) ? $obj->setSuffix($data['Suffix']) : '';
        isset($data['Taxable']) ? $obj->setTaxable($data['Taxable']) : '';
        isset($data['TaxCodeRef']) ? $obj->setTaxCodeRef($data['TaxCodeRef']) : '';
        isset($data['TaxGroup']) ? $obj->setTaxGroup($data['TaxGroup']) : '';
        isset($data['TaxIdentifier']) ? $obj->setTaxIdentifier($data['TaxIdentifier']) : '';
        isset($data['TaxReportingBasis']) ? $obj->setTaxReportingBasis($data['TaxReportingBasis']) : '';
        isset($data['TaxReturnLineRef']) ? $obj->setTaxReturnLineRef($data['TaxReturnLineRef']) : '';
        isset($data['TermRef']) ? $obj->setTermRef($data['TermRef']) : '';
        isset($data['Title']) ? $obj->setTitle($data['Title']) : '';
        isset($data['TrackQtyOnHand']) ? $obj->setTrackQtyOnHand($data['TrackQtyOnHand']) : '';
        isset($data['TxnLocationType']) ? $obj->setTxnLocationType($data['TxnLocationType']) : '';
        isset($data['Type']) ? $obj->setType($data['Type']) : '';
        isset($data['UnitPrice']) ? $obj->setUnitPrice($data['UnitPrice']) : '';
        isset($data['Vendor1099']) ? $obj->setVendor1099($data['Vendor1099']) : '';



        if (isset($data['OtherContactInfo'])) {
            $OtherContactInfo = new \QuickBooks_IPP_Object_OtherContactInfo();
            isset($data['OtherContactInfo']['Type']) ? $OtherContactInfo->setType($data['OtherContactInfo']['Type']) : '';
            isset($data['OtherContactInfo']['Telephone']) ? $OtherContactInfo->setTelephone($data['OtherContactInfo']['Telephone']) : '';
            $obj->setOtherContactInfo($OtherContactInfo);
        }
        if (isset($data['SalesTaxRateList'])) {
            $SalesTaxRateList = new \QuickBooks_IPP_Object_SalesTaxRateList();
            foreach ($data['SalesTaxRateList'] as $key => $value) {
                $TaxRateDetail = new \QuickBooks_IPP_Object_TaxRateDetail();
                isset($value['TaxRateRef']) ? $TaxRateDetail->setTaxRateRef($value['TaxRateRef']) : '';
                isset($value['TaxTypeApplicable']) ? $TaxRateDetail->setTaxTypeApplicable($value['TaxTypeApplicable']) : '';
                isset($value['TaxOrder']) ? $TaxRateDetail->setTaxOrder($value['TaxOrder']) : '';
                $SalesTaxRateList->addTaxRateDetail($TaxRateDetail);
            }
            $obj->setSalesTaxRateList($SalesTaxRateList);
        }

        if (isset($data['PurchaseTaxRateList'])) {
            $PurchaseTaxRateList = new \QuickBooks_IPP_Object_PurchaseTaxRateList();
            foreach ($data['PurchaseTaxRateList'] as $key => $value) {
                $TaxRateDetail = new \QuickBooks_IPP_Object_TaxRateDetail();
                isset($value['TaxRateRef']) ? $TaxRateDetail->setTaxRateRef($value['TaxRateRef']) : '';
                isset($value['TaxTypeApplicable']) ? $TaxRateDetail->setTaxTypeApplicable($value['TaxTypeApplicable']) : '';
                isset($value['TaxOrder']) ? $TaxRateDetail->setTaxOrder($value['TaxOrder']) : '';
                $PurchaseTaxRateList->addTaxRateDetail($TaxRateDetail);
            }
            $obj->setPurchaseTaxRateList($PurchaseTaxRateList);
        }
        if (isset($data['PrimaryPhone'])) {
            $PrimaryPhone = new \QuickBooks_IPP_Object_PrimaryPhone();
            $PrimaryPhone->setFreeFormNumber($data['PrimaryPhone']);
            $obj->setPrimaryPhone($PrimaryPhone);
        }
        
        if ($data['AlternatePhone']) {
            $AlternatePhone = new \QuickBooks_IPP_Object_AlternatePhone();
            $AlternatePhone->setFreeFormNumber($data['AlternatePhone']);
            $obj->setAlternatePhone($AlternatePhone);
        }

        if ($data['Fax']) {
            $Fax = new \QuickBooks_IPP_Object_Fax();
            $Fax->setFreeFormNumber($data['Fax']);
            $obj->setFax($Fax);
        }

        if ($data['Mobile']) {
            $Mobile = new \QuickBooks_IPP_Object_Mobile();
            $Mobile->setFreeFormNumber($data['Mobile']);
            $obj->setMobile($Mobile);
        }

        if ($data['PrimaryEmailAddr']) {
            $PrimaryEmailAddr = new \QuickBooks_IPP_Object_PrimaryEmailAddr();
            $PrimaryEmailAddr->setAddress($data['PrimaryEmailAddr']);
            $obj->setPrimaryEmailAddr($PrimaryEmailAddr);
        }

        if ($data['WebAddr']) {
            $WebAddr = new \QuickBooks_IPP_Object_WebAddr();
            $WebAddr->setURI($data['WebAddr']);
            $obj->setWebAddr($WebAddr);
        }

        if (isset($data['BillAddr'])) {
            $BillAddr = new \QuickBooks_IPP_Object_BillAddr();
            $addrData = $data['BillAddr'];

            isset($addrData['Line1']) ? $BillAddr->setLine1($addrData['Line1']) : '';
            isset($addrData['Line2']) ? $BillAddr->setLine2($addrData['Line2']) : '';
            isset($addrData['Line3']) ? $BillAddr->setLine3($addrData['Line3']) : '';
            isset($addrData['Line4']) ? $BillAddr->setLine4($addrData['Line4']) : '';
            isset($addrData['Line5']) ? $BillAddr->setLine5($addrData['Line5']) : '';
            isset($addrData['City']) ? $BillAddr->setCity($addrData['City']) : '';
            isset($addrData['Country']) ? $BillAddr->setCountry($addrData['Country']) : '';
            isset($addrData['CountrySubDivisionCode']) ? $BillAddr->setCountrySubDivisionCode($addrData['CountrySubDivisionCode']) : '';
            isset($addrData['PostalCode']) ? $BillAddr->setPostalCode($addrData['PostalCode']) : '';
            isset($addrData['Lat']) ? $BillAddr->setLat($addrData['Lat']) : '';
            isset($addrData['Long']) ? $BillAddr->setLong($addrData['Long']) : '';

            $obj->setBillAddr($BillAddr);
        }

        if (isset($data['PrimaryAddr'])) {
            $PrimaryAddr = new \QuickBooks_IPP_Object_PrimaryAddr();
            $addrData = $data['PrimaryAddr'];

            isset($addrData['Line1']) ? $PrimaryAddr->setLine1($addrData['Line1']) : '';
            isset($addrData['Line2']) ? $PrimaryAddr->setLine2($addrData['Line2']) : '';
            isset($addrData['Line3']) ? $PrimaryAddr->setLine3($addrData['Line3']) : '';
            isset($addrData['Line4']) ? $PrimaryAddr->setLine4($addrData['Line4']) : '';
            isset($addrData['Line5']) ? $PrimaryAddr->setLine5($addrData['Line5']) : '';
            isset($addrData['City']) ? $PrimaryAddr->setCity($addrData['City']) : '';
            isset($addrData['Country']) ? $PrimaryAddr->setCountry($addrData['Country']) : '';
            isset($addrData['CountrySubDivisionCode']) ? $PrimaryAddr->setCountrySubDivisionCode($addrData['CountrySubDivisionCode']) : '';
            isset($addrData['PostalCode']) ? $PrimaryAddr->setPostalCode($addrData['PostalCode']) : '';
            isset($addrData['Lat']) ? $PrimaryAddr->setLat($addrData['Lat']) : '';
            isset($addrData['Long']) ? $PrimaryAddr->setLong($addrData['Long']) : '';

            $obj->setPrimaryAddr($PrimaryAddr);
        }

        if (isset($data['ShipAddr'])) {
            $ShipAddr = new \QuickBooks_IPP_Object_ShipAddr();
            $addrData = $data['ShipAddr'];
            isset($addrData['Line1']) ? $ShipAddr->setLine1($addrData['Line1']) : '';
            isset($addrData['Line2']) ? $ShipAddr->setLine2($addrData['Line2']) : '';
            isset($addrData['Line3']) ? $ShipAddr->setLine3($addrData['Line3']) : '';
            isset($addrData['Line4']) ? $ShipAddr->setLine4($addrData['Line4']) : '';
            isset($addrData['Line5']) ? $ShipAddr->setLine5($addrData['Line5']) : '';
            isset($addrData['City']) ? $ShipAddr->setCity($addrData['City']) : '';
            isset($addrData['Country']) ? $ShipAddr->setCountry($addrData['Country']) : '';
            isset($addrData['CountrySubDivisionCode']) ? $ShipAddr->setCountrySubDivisionCode($addrData['CountrySubDivisionCode']) : '';
            isset($addrData['PostalCode']) ? $ShipAddr->setPostalCode($addrData['PostalCode']) : '';
            isset($addrData['Lat']) ? $ShipAddr->setLat($addrData['Lat']) : '';
            isset($addrData['Long']) ? $ShipAddr->setLong($addrData['Long']) : '';
            $obj->setShipAddr($ShipAddr);
        }

        return $obj;
    }


    /**
     * Handles Data from Accounting Transaction Resources 
     * @param  [array] $data [array of data passed from resource method.]
     * @param  [object] $obj  [The current resource handling the data.]
     */
    protected function handleTransactionData($data, $obj)
    {
        isset($data['AcceptedBy']) ? $obj->setAcceptedBy($data['AcceptedBy']) : '';
        isset($data['AcceptedDate']) ? $obj->setAcceptedDate($data['AcceptedDate']) : '';
        isset($data['Adjustment']) ? $obj->setAdjustment($data['Adjustment']) : '';
        isset($data['ApplyTaxAfterDiscount']) ? $obj->setApplyTaxAfterDiscount($data['ApplyTaxAfterDiscount']) : '';
        isset($data['APAccountRef']) ? $obj->setAPAccountRef($data['APAccountRef']) : '';
        isset($data['Balance']) ? $obj->setBalance($data['Balance']) : '';
        isset($data['ARAccountRef']) ? $obj->setARAccountRef($data['ARAccountRef']) : '';
        isset($data['BreakHours']) ? $account->setBreakHours($data['BreakHours']) : '';
        isset($data['BreakMinutes']) ? $account->setBreakMinutes($data['BreakMinutes']) : '';
        isset($data['ClassRef']) ? $obj->setClassRef($data['ClassRef']) : '';
        isset($data['Credit']) ? $obj->setCredit($data['Credit']) : '';
        isset($data['CurrencyRef']) ? $obj->setCurrencyRef($data['CurrencyRef']) : '';
        isset($data['CustomerMemo']) ? $obj->setCustomerMemo($data['CustomerMemo']) : '';
        isset($data['CustomerRef']) ? $obj->setCustomerRef($data['CustomerRef']) : '';
        isset($data['DeliveryInfo']) ? $obj->setDeliveryInfo($data['DeliveryInfo']) : '';
        isset($data['DepartmentRef']) ? $obj->setDepartmentRef($data['DepartmentRef']) : '';
        isset($data['Deposit']) ? $obj->setDeposit($data['Deposit']) : '';
        isset($data['DepositToAccountRef']) ? $obj->setDepositToAccountRef($data['DepositToAccountRef']) : '';
        isset($data['DocNumber']) ? $obj->setDocNumber($data['DocNumber']) : '';
        isset($data['DueDate']) ? $obj->setDueDate($data['DueDate']) : '';
        isset($data['EmailStatus']) ? $obj->setEmailStatus($data['EmailStatus']) : '';
        isset($data['EmployeeRef']) ? $account->setEmployeeRef($data['EmployeeRef']) : '';
        isset($data['EndTime']) ? $account->setEndTime($data['EndTime']) : '';
        isset($data['EntityRef']) ? $obj->setEntityRef($data['EntityRef']) : '';
        isset($data['ExchangeRate']) ? $obj->setExchangeRate($data['ExchangeRate']) : '';
        isset($data['ExpirationDate']) ? $obj->setExpirationDate($data['ExpirationDate']) : '';
        isset($data['FromAccountRef']) ? $account->setFromAccountRef($data['FromAccountRef']) : '';
        isset($data['GlobalTaxCalculation']) ? $obj->setGlobalTaxCalculation($data['GlobalTaxCalculation']) : '';
        isset($data['HomeBalance']) ? $obj->setHomeBalance($data['HomeBalance']) : '';
        isset($data['HomeTotalAmt']) ? $obj->setHomeTotalAmt($data['HomeTotalAmt']) : '';
        isset($data['HourlyRate']) ? $account->setHourlyRate($data['HourlyRate']) : '';
        isset($data['Hours']) ? $account->setHours($data['Hours']) : '';
        isset($data['ItemRef']) ? $account->setItemRef($data['ItemRef']) : '';
        isset($data['Memo']) ? $account->setMemo($data['Memo']) : '';
        isset($data['Minutes']) ? $account->setMinutes($data['Minutes']) : '';
        isset($data['NameOf']) ? $account->setNameOf($data['NameOf']) : '';
        isset($data['PaymentMethodRef']) ? $obj->setPaymentMethodRef($data['PaymentMethodRef']) : '';
        isset($data['PaymentRefNum']) ? $obj->setPaymentRefNum($data['PaymentRefNum']) : '';
        isset($data['PaymentType']) ? $account->setPaymentType($data['PaymentType']) : '';
        isset($data['PayType']) ? $obj->setPayType($data['PayType']) : '';
        isset($data['POStatus']) ? $account->setPOStatus($data['POStatus']) : '';
        isset($data['PrintStatus']) ? $obj->setPrintStatus($data['PrintStatus']) : '';
        isset($data['PrivateNote']) ? $obj->setPrivateNote($data['PrivateNote']) : '';
        isset($data['ProcessBillPayment']) ? $obj->setProcessBillPayment($data['ProcessBillPayment']) : '';
        isset($data['PurchaseEx']) ? $obj->setPurchaseEx($data['PurchaseEx']) : '';
        isset($data['RemainingCredit']) ? $obj->setRemainingCredit($data['RemainingCredit']) : '';
        isset($data['SalesTermRef']) ? $obj->setSalesTermRef($data['SalesTermRef']) : '';
        isset($data['ShipDate']) ? $obj->setShipDate($data['ShipDate']) : '';
        isset($data['ShipMethodRef']) ? $obj->setShipMethodRef($data['ShipMethodRef']) : '';
        isset($data['StartTime']) ? $account->setStartTime($data['StartTime']) : '';
        isset($data['Taxable']) ? $account->setTaxable($data['Taxable']) : '';
        isset($data['ToAccountRef']) ? $account->setToAccountRef($data['ToAccountRef']) : '';
        isset($data['TotalAmt']) ? $obj->setTotalAmt($data['TotalAmt']) : '';
        isset($data['TrackingNum']) ? $obj->setTrackingNum($data['TrackingNum']) : '';
        isset($data['TransactionLocationType']) ? $obj->setTransactionLocationType($data['TransactionLocationType']) : '';
        isset($data['TxnDate']) ? $obj->setTxnDate($data['TxnDate']) : $obj->setTxnDate(date('Y-m-d'));
        isset($data['TxnSource']) ? $obj->setTxnSource($data['TxnSource']) : '';
        isset($data['UnappliedAmt']) ? $obj->setUnappliedAmt($data['UnappliedAmt']) : '';



        if (isset($data['BillAddr'])) {
            $BillAddr = new \QuickBooks_IPP_Object_BillAddr();
            $addrData = $data['BillAddr'];

            isset($addrData['Line1']) ? $BillAddr->setLine1($addrData['Line1']) : '';
            isset($addrData['Line2']) ? $BillAddr->setLine2($addrData['Line2']) : '';
            isset($addrData['Line3']) ? $BillAddr->setLine3($addrData['Line3']) : '';
            isset($addrData['Line4']) ? $BillAddr->setLine4($addrData['Line4']) : '';
            isset($addrData['Line5']) ? $BillAddr->setLine5($addrData['Line5']) : '';
            isset($addrData['City']) ? $BillAddr->setCity($addrData['City']) : '';
            isset($addrData['Country']) ? $BillAddr->setCountry($addrData['Country']) : '';
            isset($addrData['CountrySubDivisionCode']) ? $BillAddr->setCountrySubDivisionCode($addrData['CountrySubDivisionCode']) : '';
            isset($addrData['PostalCode']) ? $BillAddr->setPostalCode($addrData['PostalCode']) : '';
            isset($addrData['Lat']) ? $BillAddr->setLat($addrData['Lat']) : '';
            isset($addrData['Long']) ? $BillAddr->setLong($addrData['Long']) : '';

            $obj->setBillAddr($BillAddr);
        }

        if (isset($data['BillEmail'])) {
            $billEmail = new \QuickBooks_IPP_Object_BillEmail();
            $billEmail->setAddress($data['BillEmail']);
            $obj->setBillEmail($billEmail);
        }

        if (isset($data['CheckPayment'])) {
            $CheckPayment = new \Quickbooks_IPP_Object_CheckPayment();
            isset($data['CheckPayment']['BankAccountRef']) ? $CheckPayment->setBankAccountRef($data['CheckPayment']['BankAccountRef']) : '';
            isset($data['CheckPayment']['PrintStatus']) ? $CheckPayment->setPrintStatus($data['CheckPayment']['PrintStatus']) : '';
            $obj->setCheckPayment($CheckPayment);
        }

        if (isset($data['CreditCardPayment'])) {
            $CreditCardPayment = new \Quickbooks_IPP_Object_CreditCardPayment();
            isset($data['CreditCardPayment']['CCAccountRef']) ? $CreditCardPayment->setCCAccountRef($data['CreditCardPayment']['CCAccountRef']) : '';
            $obj->setCreditCardPayment($CreditCardPayment);
        }

        if (isset($data['CustomField'])) {
            $customField = new \QuickBooks_IPP_Object_CustomField();
            isset($data['CustomField']['Id']) ? $customField->setDefinitionId($data['CustomField']['Id']) : '';
            isset($data['CustomField']['Name']) ? $customField->setDefinitionName($data['CustomField']['Name']) : '';
            isset($data['CustomField']['Type']) ? $customField->setDefinitionType($data['CustomField']['Type']) : '';
            isset($data['CustomField']['StringValue']) ? $customField->setDefinitionStringValue($data['CustomField']['StringValue']) : '';
            $obj->setCustomField($customField);
        }

        if (isset($data['LinkedTxn'])) {
            foreach ($data['LinkedTxn'] as $key => $value) {
                $LinkedTxn = new \Quickbooks_IPP_Object_LinkedTxn();
                isset($value['TxnId']) ? $LinkedTxn->setTxnId($value['TxnId']) : '';
                isset($value['TxnType']) ? $LinkedTxn->setTxnType($value['TxnType']) : '';
                isset($value['TxnLineId']) ? $LinkedTxn->setTxnLineId($value['TxnLineId']) : '';
                $obj->addLinkedTxn($LinkedTxn);
            }
        }

        if (isset($data['RemitToAddr'])) {
            $RemitToAddr = new \QuickBooks_IPP_Object_RemitToAddr();
            $addrData = $data['RemitToAddr'];
            isset($addrData['Line1']) ? $RemitToAddr->setLine1($addrData['Line1']) : '';
            isset($addrData['Line2']) ? $RemitToAddr->setLine2($addrData['Line2']) : '';
            isset($addrData['Line3']) ? $RemitToAddr->setLine3($addrData['Line3']) : '';
            isset($addrData['Line4']) ? $RemitToAddr->setLine4($addrData['Line4']) : '';
            isset($addrData['Line5']) ? $RemitToAddr->setLine5($addrData['Line5']) : '';
            isset($addrData['City']) ? $RemitToAddr->setCity($addrData['City']) : '';
            isset($addrData['Country']) ? $RemitToAddr->setCountry($addrData['Country']) : '';
            isset($addrData['CountrySubDivisionCode']) ? $RemitToAddr->setCountrySubDivisionCode($addrData['CountrySubDivisionCode']) : '';
            isset($addrData['PostalCode']) ? $RemitToAddr->setPostalCode($addrData['PostalCode']) : '';
            isset($addrData['Lat']) ? $RemitToAddr->setLat($addrData['Lat']) : '';
            isset($addrData['Long']) ? $RemitToAddr->setLong($addrData['Long']) : '';
            $obj->setRemitToAddr($RemitToAddr);
        }
        
        if (isset($data['ShipAddr'])) {
            $ShipAddr = new \QuickBooks_IPP_Object_ShipAddr();
            $addrData = $data['ShipAddr'];
            isset($addrData['Line1']) ? $ShipAddr->setLine1($addrData['Line1']) : '';
            isset($addrData['Line2']) ? $ShipAddr->setLine2($addrData['Line2']) : '';
            isset($addrData['Line3']) ? $ShipAddr->setLine3($addrData['Line3']) : '';
            isset($addrData['Line4']) ? $ShipAddr->setLine4($addrData['Line4']) : '';
            isset($addrData['Line5']) ? $ShipAddr->setLine5($addrData['Line5']) : '';
            isset($addrData['City']) ? $ShipAddr->setCity($addrData['City']) : '';
            isset($addrData['Country']) ? $ShipAddr->setCountry($addrData['Country']) : '';
            isset($addrData['CountrySubDivisionCode']) ? $ShipAddr->setCountrySubDivisionCode($addrData['CountrySubDivisionCode']) : '';
            isset($addrData['PostalCode']) ? $ShipAddr->setPostalCode($addrData['PostalCode']) : '';
            isset($addrData['Lat']) ? $ShipAddr->setLat($addrData['Lat']) : '';
            isset($addrData['Long']) ? $ShipAddr->setLong($addrData['Long']) : '';
            $obj->setShipAddr($ShipAddr);
        }

        if (isset($data['TxnTaxDetail'])) {
            $taxTxnDetail = new \QuickBooks_IPP_Object_TxnTaxDetail();
            $taxData = $data['TxnTaxDetail'];
            isset($taxData['TxnTaxCodeRef']) ? $taxTxnDetail->setTxnTaxCodeRef($taxData['TxnTaxCodeRef']) : '';
            isset($taxData['TotalTax']) ? $taxTxnDetail->setTotalTax($taxData) : '';
            $this->createLines($taxData['Lines'], $taxTxnDetail);
            $obj->setTaxTxnDetail($taxTxnDetail);
        }

        if (isset($data['VendorAddr'])) {
            $VendorAddr = new \QuickBooks_IPP_Object_VendorAddr();
            $addrData = $data['VendorAddr'];
            isset($addrData['Line1']) ? $VendorAddr->setLine1($addrData['Line1']) : '';
            isset($addrData['Line2']) ? $VendorAddr->setLine2($addrData['Line2']) : '';
            isset($addrData['Line3']) ? $VendorAddr->setLine3($addrData['Line3']) : '';
            isset($addrData['Line4']) ? $VendorAddr->setLine4($addrData['Line4']) : '';
            isset($addrData['Line5']) ? $VendorAddr->setLine5($addrData['Line5']) : '';
            isset($addrData['City']) ? $VendorAddr->setCity($addrData['City']) : '';
            isset($addrData['Country']) ? $VendorAddr->setCountry($addrData['Country']) : '';
            isset($addrData['CountrySubDivisionCode']) ? $VendorAddr->setCountrySubDivisionCode($addrData['CountrySubDivisionCode']) : '';
            isset($addrData['PostalCode']) ? $VendorAddr->setPostalCode($addrData['PostalCode']) : '';
            isset($addrData['Lat']) ? $VendorAddr->setLat($addrData['Lat']) : '';
            isset($addrData['Long']) ? $VendorAddr->setLong($addrData['Long']) : '';
            $obj->setVendorAddr($VendorAddr);
        }

        return $obj;
    }

    /**
     * Creates Line data for each QuickBooks Resource. There are multiple types of lines in QuickBooks. There is a mehtod to handle each one since they all have unique data.
     * @param  [array] $data [Line data]
     * @param  [object] $obj  [The Current resource handling Line data.]
     */
    protected function createLines($data, $obj)
    {
        foreach ($data as $key => $value) {
            $line = new \QuickBooks_IPP_Object_Line();
            isset($value['LineNumber']) ? $lnumber = $value['LineNumber'] - 1 : $lnumber = null;

            if ($key != 'DescriptionOnly') {
                $accountType = '\\QuickBooks_IPP_Object_'.$key;
                $account = new $accountType();
            }
           
            switch ($key) {
                case 'SalesItemLineDetail':
                    $this->handleSalesItemLineDetail($account, $value, $lnumber, $obj);
                    break;
                case 'ItemBasedExpenseLineDetail':
                    $this->handleItemBasedExpenseLineDetail($account, $value, $lnumber, $obj);
                    break;
                case 'AccountBasedExpenseLineDetail':
                    $this->handleAccountBasedExpenseLineDetail($account, $value, $lnumber, $obj);
                    break;
                case 'GroupLineDetail':
                    $this->handleGroupLineDetail($account, $value, $lnumber, $obj);
                    break;
                case 'DescriptionOnly':
                    $this->handleDescriptionOnly($value, $lnumber, $obj);
                    break;
                case 'DiscountLineDetail':
                    $this->handleDiscountLineDetail($account, $value, $lnumber, $obj);
                    break;
                case 'SubtotalLine':
                    $this->handleSubtotalLineDetail($account, $value, $lnumber, $obj);
                    break;
                case 'TaxLineDetail':
                    $this->handleTaxLineDetail($account, $value, $lnumber, $obj);
                    break;
                default:
                    null;
                    break;
            }
        }
    }

    protected function handleSalesItemLineDetail($account, $data, $lnumber = null, $obj)
    {
        isset($lnumber) ?  $line = $obj->getLine($lnumber) :  $line = new \QuickBooks_IPP_Object_Line();
  
        $line->setAmount($data['Amount']);
        $line->setDetailType('SalesItemLineDetail');
        isset($data['LineNum']) ? $line->setLineNum($data['LineNum']) : '';
        isset($data['Description']) ? $line->setDescription($data['Description']) : '';

        isset($data['ItemRef']) ? $account->setItemRef($data['ItemRef']) : '';
        isset($data['ClassRef']) ? $account->setClassRef($data['ClassRef']) : '';
        isset($data['UnitPrice']) ? $account->setUnitPrice($data['UnitPrice']) : '';
        isset($data['Qty']) ? $account->setQty($data['Qty']) : '';
        isset($data['TaxCodeRef']) ? $account->setTaxCodeRef($data['TaxCodeRef']) : '';
        isset($data['ServiceDate']) ? $account->setServiceDate($data['ServiceDate']) : '';

        if (isset($value['MarkupInfo'])) {
            $markup = new \QuickBooks_IPP_Object_MarkupInfo();
            $markupData = $value['MarkupInfo'];
            isset($markupData) ? $markup->setPercentBased($markupData['PercentBased']) : '';
            isset($markupData) ? $markup->setValue($markupData['Value']) : '';
            isset($markupData) ? $markup->setPercent($markupData['Percent']) : '';
            isset($markupData) ? $markup->setPriceLevelRef($markupData['PriceLevelRef']) : '';
            $account->setMarkupInfo($markup);
        }
        $line->setSalesItemLineDetail($account);
       
        isset($lnumber) ? '' : $obj->addLine($line);
    }

    protected function handleItemBasedExpenseLineDetail($account, $data, $lnumber = null, $obj)
    {
        isset($lnumber) ?  $line = $obj->getLine($lnumber) :  $line = new \QuickBooks_IPP_Object_Line();
  
        $line->setAmount($data['Amount']);
        $line->setDetailType('ItemBasedExpenseLineDetail');
        isset($data['LineNum']) ? $line->setLineNum($data['LineNum']) : '';
        isset($data['Description']) ? $line->setDescription($data['Description']) : '';

        isset($data['ItemRef']) ? $account->setItemRef($data['ItemRef']) : '';
        isset($data['ClassRef']) ? $account->setClassRef($data['ClassRef']) : '';
        isset($data['UnitPrice']) ? $account->setUnitPrice($data['UnitPrice']) : '';
        isset($data['PriceLevelRef']) ? $account->setPriceLevelRef($data['PriceLevelRef']) : '';
        isset($data['Qty']) ? $account->setQty($data['Qty']) : '';
        isset($data['TaxCodeRef']) ? $account->setTaxCodeRef($data['TaxCodeRef']) : '';
        isset($data['CustomerRef']) ? $account->setCustomerRef($data['CustomerRef']) : '';
        isset($data['BillableStatus']) ? $account->setBillableStatus($data['BillableStatus']) : '';
        isset($data['TaxInclusiveAmt']) ? $account->setTaxInclusiveAmt($data['TaxInclusiveAmt']) : '';

        if (isset($value['MarkupInfo'])) {
            $markup = new \QuickBooks_IPP_Object_MarkupInfo();
            $markupData = $value['MarkupInfo'];
            isset($markupData) ? $markup->setPercentBased($markupData['PercentBased']) : '';
            isset($markupData) ? $markup->setValue($markupData['Value']) : '';
            isset($markupData) ? $markup->setPercent($markupData['Percent']) : '';
            isset($markupData) ? $markup->setPriceLevelRef($markupData['PriceLevelRef']) : '';
            $account->setMarkupInfo($markup);
        }
        $line->setItemBasedExpensLineDetail($account);
       
        isset($lnumber) ? '' : $obj->addLine($line);
    }

    protected function handleAccountBasedExpenseLineDetail($account, $data, $lnumber = null, $obj)
    {
        isset($lnumber) ?  $line = $obj->getLine($lnumber) :  $line = new \QuickBooks_IPP_Object_Line();
  
        $line->setAmount($data['Amount']);
        $line->setDetailType('AccountBasedExpenseLineDetail');
        isset($data['LineNum']) ? $line->setLineNum($data['LineNum']) : '';
        isset($data['Description']) ? $line->setDescription($data['Description']) : '';

        isset($data['CustomerRef']) ? $account->setCustomerRef($data['CustomerRef']) : '';
        isset($data['ClassRef']) ? $account->setClassRef($data['ClassRef']) : '';
        isset($data['AccountRef']) ? $account->setAccountRef($data['AccountRef']) : '';
        isset($data['BillableStatus']) ? $account->setBillableStatus($data['BillableStatus']) : '';
        isset($data['TaxAmount']) ? $account->setTaxAmount($data['TaxAmount']) : '';
        isset($data['TaxCodeRef']) ? $account->setTaxCodeRef($data['TaxCodeRef']) : '';
        isset($data['TaxInclusiveAmt']) ? $account->setTaxInclusiveAmt($data['TaxInclusiveAmt']) : '';

        if (isset($value['MarkupInfo'])) {
            $markup = new \QuickBooks_IPP_Object_MarkupInfo();
            $markupData = $value['MarkupInfo'];
            isset($markupData) ? $markup->setPercentBased($markupData['PercentBased']) : '';
            isset($markupData) ? $markup->setValue($markupData['Value']) : '';
            isset($markupData) ? $markup->setPercent($markupData['Percent']) : '';
            isset($markupData) ? $markup->setPriceLevelRef($markupData['PriceLevelRef']) : '';
            $account->setMarkupInfo($markup);
        }
        $line->setAccountBasedExpensLineDetail($account);
       
        isset($lnumber) ? '' : $obj->addLine($line);
    }

    protected function handleGroupLineDetail($account, $data, $lnumber = null, $obj)
    {
        isset($lnumber) ?  $line = $obj->getLine($lnumber) :  $line = new \QuickBooks_IPP_Object_Line();

        $line->setDetailType('GroupLineDetail');
        isset($data['Description']) ? $line->setDescription($data['Description']) : '';
        isset($data['LineNum']) ? $line->setLineNum($data['LineNum']) : '';
        isset($data['GroupItemRef']) ? $line->setGroupItemRef($data['GroupItemRef']) : '';
        isset($data['Quantity']) ? $line->setQuantity($data['Quantity']) : '';
        isset($data['Description']) ? $line->setDescription($data['Description']) : '';
        
        if (isset($data['Lines'])) {
            $this->createLines($data['Lines'], $account);
        }
        $line->setGroupLineDetail($account);
        isset($lnumber) ? '' : $obj->addLine($line);
    }

    protected function handleDescriptionOnly($data, $lnumber = null, $obj)
    {
        $account = new \QuickBooks_IPP_Object_DescriptionLineDetail();
        isset($lnumber) ?  $line = $obj->getLine(0) :  $line = new \QuickBooks_IPP_Object_Line();
        $line->setDetailType('DescriptionOnly');
        $line->setAmount($data['Amount']);
        isset($data['Description']) ? $line->setDescription($data['Description']) : '';
        isset($data['LineNum']) ? $line->setLineNum($data['LineNum']) : '';

        isset($data['ServiceDate']) ? $account->setServiceDate($data['ServiceDate']) : '';
        isset($data['TaxCodeRef']) ? $account->setTaxCodeRef($data['TaxCodeRef']) : '';

        $line->setDescriptionLineDetail($account);
        isset($lnumber) ? '' : $obj->addLine($line);
    }

    protected function handleDiscountLineDetail($account, $data, $lnumber = null, $obj)
    {
        isset($lnumber) ?  $line = $obj->getLine($lnumber) :  $line = new \QuickBooks_IPP_Object_Line();
        $line->setDetailType('DiscountLineDetail');
        $line->setAmount($data['Amount']);
        isset($data['Description']) ? $line->setDescription($data['Description']) : '';
        isset($data['LineNum']) ? $line->setLineNum($data['LineNum']) : '';

        isset($data['PercentBased']) ? $account->setPercentBased($data['PercentBased']) : '';
        isset($data['DiscountPercent']) ? $account->setDiscountPercent($data['DiscountPercent']) : '';
        isset($data['DiscountAccountRef']) ? $account->setDiscountAccountRef($data['DiscountAccountRef']) : '';
        isset($data['ClassRef']) ? $account->setClassRef($data['ClassRef']) : '';
        isset($data['TaxCodeRef']) ? $account->setTaxCodeRef($data['TaxCodeRef']) : '';

        $line->setDiscountLineDetail($account);
        isset($lnumber) ? '' : $obj->addLine($line);
    }

    protected function handleSubtotalLineDetail($account, $data, $lnumber = null, $obj)
    {
        isset($lnumber) ?  $line = $obj->getLine($lnumber) :  $line = new \QuickBooks_IPP_Object_Line();
        $line->setDetailType('SubtotalLineDetail');
        $line->setAmount($data['Amount']);
        isset($data['Description']) ? $line->setDescription($data['Description']) : '';
        isset($data['LineNum']) ? $line->setLineNum($data['LineNum']) : '';

        isset($data['ItemRef']) ? $account->setItemRef($data['ItemRef']) : '';

        $line->setSubtotalLineDetail($account);
        isset($lnumber) ? '' : $obj->addLine($line);
    }

    protected function handleTaxLineDetail($account, $data, $lnumber = null, $obj)
    {
        isset($lnumber) ?  $line = $obj->getLine($lnumber) :  $line = new \QuickBooks_IPP_Object_TaxLine();
        $line->setDetailType('TaxLineDetail');
        $account->setTaxRateRef($data['TaxRateRef']);
        isset($data['Amount']) ? $line->setAmount($data['Amount']) : '';
        isset($data['PercentBased']) ? $account->setPercentBased($data['PercentBased']) : '';
        isset($data['NetAmountTaxable']) ? $account->setNetAmountTaxable($data['NetAmountTaxable']) : '';
        isset($data['TaxInclusiveAmount']) ? $account->setTaxInclusiveAmount($data['TaxInclusiveAmount']) : '';
        isset($data['OverrideDeltaAmount']) ? $account->setOverrideDeltaAmount($data['OverrideDeltaAmount']) : '';
        isset($data['TaxPercent']) ? $account->setTaxPercent($data['TaxPercent']) : '';
        $line->setTaxLineDetail($account);
        isset($lnumber) ? '' : $obj->addLine($line);
    }
}
