<?php

namespace AllPlayers\NMI\PaymentMethod;

use AllPlayers\NMI\PaymentMethod;

/**
 * Defines a check payment method for use with the NMI payment gateway.
 */
class Check implements PaymentMethod
{
    /**
     * Defines a bank account as being held by a business.
     *
     * @var string
     */
    const ACCOUNT_HOLDER_BUSINESS = 'business';

    /**
     * Defines a bank account as being held by an individual.
     *
     * @var string
     */
    const ACCOUNT_HOLDER_PERSONAL = 'personal';

    /**
     * Defines a bank account as checking.
     *
     * @var string
     */
    const ACCOUNT_TYPE_CHECKING = 'checking';

    /**
     * Defines a bank account as savings.
     *
     * @var string
     */
    const ACCOUNT_TYPE_SAVINGS = 'savings';

    /**
     * Defines a cash concentration or disbursement transaction.
     *
     * @var string
     */
    const SEC_CASH_CONCENTRATION_OR_DISBURSEMENT = 'CCD';

    /**
     * Defines a prearranged payment and deposit transaction.
     *
     * @var string
     */
    const SEC_PREARRANGED_PAYMENT_AND_DEPOSIT = 'PPD';

    /**
     * Defines a telephone initiated transaction.
     *
     * @var string
     */
    const SEC_TELEPHONE_INITIATED = 'TEL';

    /**
     * Defines a web initiated transaction.
     *
     * @var string
     */
    const SEC_WEB_INITIATED = 'WEB';

    /**
     * The type of account holder for the bank account.
     *
     * @var string
     */
    public $accountHolderType = self::ACCOUNT_HOLDER_PERSONAL;

    /**
     * The account number for the bank account that the transaction will be made
     * against.
     *
     * @var integer
     */
    public $accountNumber;

    /**
     * The type of the bank account.
     *
     * @var string
     */
    public $accountType = self::ACCOUNT_TYPE_CHECKING;

    /**
     * The name of the bank where the account is held.
     *
     * @var string
     */
    public $bankName;

    /**
     * The routing number of the bank account.
     *
     * @var integer
     */
    public $routingNumber;

    /**
     * The SEC code to use for procssing this transaction.
     *
     * @var string
     *
     * @link http://www.achdirect.com/resources/seccodes.asp
     * @link http://en.wikipedia.org/wiki/Automated_Clearing_House#SEC_codes
     */
    public $secCode;

    /**
     * The type of this payment method as recognized by the NMI payment gateway.
     *
     * @var string
     */
    protected $type = 'check';

    /**
     * Converts the payment method to an array that can be used in a request.
     *
     * @return array
     *   Array of data that represents the payment method.
     */
    public function toArray()
    {
        return array(
            'payment' => $this->type,
            'checkname' => $this->bankName,
            'checkaba' => $this->routingNumber,
            'checkaccount' => $this->accountNumber,
            'account_holder_type' => $this->accountHolderType,
            'account_type' => $this->accountType,
            'sec_code' => $this->secCode,
        );
    }
}
