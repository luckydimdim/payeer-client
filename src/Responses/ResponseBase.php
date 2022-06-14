<?php

namespace Payeer\Responses;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Base response model
 */
abstract class ResponseBase extends DataTransferObject
{
    public bool $success = false;

    #[MapFrom('error.code')]
    public string $errorCode = '';

    /**
     * Checks if there is any API level errors and triggers Exceptions
     * @return void
     * @throws \Exception
     */
    public function handleApiErrors(): void
    {
        if (!$this->errorCode) {
            return;
        }

        // TODO: introduce service layer exception type
        switch ($this->errorCode) {
            case 'INVALID_SIGNATURE':
                $message = "Возможные причины:
- неверная подпись API-SIGN
- неверно указан API-ID
- API-пользователь заблокирован (можно разблокировать в настройках)";
                throw new \Exception($message);
            case 'INVALID_IP_ADDRESS':
                $message = "IP-адрес ip источника запроса не совпадает с тем, который прописан в настройках API";
                throw new \Exception($message);
            case 'LIMIT_EXCEEDED':
                $message = "Превышение установленных лимитов (количество запросов/весов/ордеров), подробнее указано в параметре desc";
                throw new \Exception($message);
            case 'INVALID_TIMESTAMP':
                $message = "Параметр ts указан неверно:
- запрос шел до сервера API более 60 секунд
- на вашем сервере неверное время, настройте синхронизацию";
                throw new \Exception($message);
            case 'ACCESS_DENIED':
                $message = "Доступ к API/ордеру запрещен. Проверьте ID заказа";
                throw new \Exception($message);
            case 'INVALID_PARAMETER':
                $message = "Параметр parameter указан неверно";
                throw new \Exception($message);
            case 'PARAMETER_EMPTY':
                $message = "Параметр parameter обязателен (не должен быть пустым)";
                throw new \Exception($message);
            case 'INVALID_STATUS_FOR_REFUND':
                $message = "Статус status ордера не позволяет произвести возврат (ордер уже возвращен или отменен)";
                throw new \Exception($message);
            case 'REFUND_LIMIT':
                $message = "Ордер может быть отменен не менее через 1 минуту после создания";
                throw new \Exception($message);
            case 'UNKNOWN_ERROR':
                $message = "Неизвестная ошибка на бирже. Торги приостановлены для проверки. Попробуйте через 15 минут.";
                throw new \Exception($message);
            case 'INVALID_DATE_RANGE':
                $message = "Неверно указан диапазон дат для фильтрации (период не должен превышать 32 дня)";
                throw new \Exception($message);
            case 'INSUFFICIENT_FUNDS':
                $message = "Недостаточно средств для создания ордера (maxAmount, maxValue)";
                throw new \Exception($message);
            case 'INSUFFICIENT_VOLUME':
                $message = "Недостаточно объема для создания ордера (maxAmount, maxValue)";
                throw new \Exception($message);
            case 'INCORRECT_PRICE':
                $message = "Цена выходит из допустимого диапазона (minPrice, maxPrice)";
                throw new \Exception($message);
            case 'MIN_AMOUNT':
                $message = "Количество меньше минимального minAmount для выбранной пары";
                throw new \Exception($message);
            case 'MIN_VALUE':
                $message = "Сумма ордера меньше минимальной minValue для выбранной пары";
                throw new \Exception($message);
            default:
                throw new \Exception('General service layer exception');
        }
    }
}
