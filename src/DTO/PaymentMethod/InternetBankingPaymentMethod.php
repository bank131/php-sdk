<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\PaymentMethod;

use Bank131\SDK\DTO\InternetBanking\AbstractInternetBanking;
use Bank131\SDK\DTO\InternetBanking\Alipay;
use Bank131\SDK\DTO\InternetBanking\AlipayHK;
use Bank131\SDK\DTO\InternetBanking\Dana;
use Bank131\SDK\DTO\InternetBanking\GCash;
use Bank131\SDK\DTO\InternetBanking\Kakaopay;
use Bank131\SDK\DTO\InternetBanking\PhoneIdent;
use Bank131\SDK\DTO\InternetBanking\SberPay;
use Bank131\SDK\DTO\InternetBanking\WeChatPay;
use Bank131\SDK\DTO\PaymentMethod\Enum\PaymentMethodEnum;
use Bank131\SDK\Exception\InvalidArgumentException;

class InternetBankingPaymentMethod extends PaymentMethod
{
    /**
     * @var string $type
     */
    private $type;

    /**
     * @var SberPay|null
     */
    private $sber_pay = null;

    /**
     * @var Alipay|null
     */
    private $alipay = null;

    /**
     * @var AlipayHK|null
     */
    private $alipay_hk = null;

    /**
     * @var Dana|null
     */
    private $dana = null;

    /**
     * @var GCash|null
     */
    private $gcash = null;

    /**
     * @var Kakaopay|null
     */
    private $kakaopay = null;

    /**
     * @var WeChatPay|null
     */
    private $wechatpay = null;

    /**
     * @var PhoneIdent|null
     */
    private $phone_ident = null;

    public function __construct(AbstractInternetBanking $internetBanking)
    {
        if (!property_exists($this, $internetBanking->getType())) {
            throw new InvalidArgumentException('Invalid internet banking type');
        }

        $this->type          = $internetBanking->getType();
        $this->{$this->type} = $internetBanking;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSberPay(): ?SberPay
    {
        return $this->sber_pay;
    }

    public function getAlipay(): ?Alipay
    {
        return $this->alipay;
    }

    public function getAlipayHK(): ?AlipayHK
    {
        return $this->alipay_hk;
    }

    public function getDana(): ?Dana
    {
        return $this->dana;
    }

    public function getGCash(): ?GCash
    {
        return $this->gcash;
    }

    public function getKakaopay(): ?Kakaopay
    {
        return $this->kakaopay;
    }

    public function getWeChat(): ?WeChatPay
    {
        return $this->wechatpay;
    }

    public function getPhoneIdent(): ?PhoneIdent
    {
        return $this->phone_ident;
    }
}
