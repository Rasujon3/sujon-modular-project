<?php

namespace App\Http\Controllers;

use App\ResponseUtil\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    /**
     * @param $result
     * @param $message
     * @return mixed
     */
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    /**
     * @param $error
     * @param  int  $code
     * @return mixed
     */
    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    function amountToWords($amount)
    {
        $number = number_format($amount, 2, '.', ''); // Format to 2 decimal places
        list($whole, $decimal) = explode('.', $number);

        $whole = (int) $whole;  // Whole number part
        $decimal = (int) $decimal; // Decimal part

        $words = '';

        if ($whole > 0) {
            $words .= $this->convertNumberToWords($whole) . ' Saudi Riyals';
        } else {
            $words .= 'zero Saudi Riyals';
        }

        if ($decimal > 0) {
            $words .= ' and ' . $this->convertNumberToWords($decimal) . ' Halalas';
        } else {
            $words .= ' and zero Halalas';
        }

        return $words;
    }

    function convertNumberToWords($number)
    {
        $dictionary = [
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
        ];

        if ($number < 0) {
            return 'negative ' . $this->convertNumberToWords(abs($number));
        }

        if ($number < 21) {
            return $dictionary[$number];
        }

        if ($number < 100) {
            $ten = floor($number / 10) * 10;
            $unit = $number % 10;
            return $unit ? $dictionary[$ten] . '-' . $dictionary[$unit] : $dictionary[$ten];
        }

        if ($number < 1000) {
            return $dictionary[floor($number / 100)] . ' hundred' . ($number % 100 ? ' and ' . $this->convertNumberToWords($number % 100) : '');
        }

        foreach (array_reverse($dictionary, true) as $key => $value) {
            if ($number >= $key) {
                return $this->convertNumberToWords(floor($number / $key)) . ' ' . $value . ($number % $key ? ' ' . $this->convertNumberToWords($number % $key) : '');
            }
        }

        return '';
    }
}
