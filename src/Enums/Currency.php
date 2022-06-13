<?php

namespace Payeer\Enums;

/**
 * Available currency list
 */
enum Currency: string
{
    case None = '';
    case Usd = 'USD';
    case Rub = 'RUB';
    case Eur = 'EUR';
    case Btc = 'BTC';
    case Eth = 'ETH';
    case Bch = 'BCH';
    case Ltc = 'LTC';
    case Dash = 'DASH';
    case Usdt = 'USDT';
    case Xrp = 'XRP';
    case Doge = 'DOGE';
    case Trx = 'TRX';
}
