<?php

namespace Voidemort\LaravelVerifySign;

use Illuminate\Support\Facades\Log;

class VerifySign
{

    /**
     * @throws \Exception
     */
    public static function isValid($params, $key, $mustParams = [], $signName = 'sign', $expire_at = 10): bool
    {
        if (isset($params['iv']) && is_string($params['iv'])) {
            $iv = $params['iv'];
        }

        $mustParams[] = $signName;
        foreach ($mustParams as $must) {
            if (!isset($params[$must]) || ! is_scalar($params[$must])) {
                throw new \Exception('缺少必要的参数！'. $must);
            }
        }

        $sign = $params[$signName];
        unset($params[$signName]);

        ksort($params);
        $value = rawurldecode(http_build_query($params));
        $value = base64_encode(openssl_encrypt($value, 'AES-128-CBC', $key, 1, $iv ?? ''));

        return $value == $sign;
    }
}