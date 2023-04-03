<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

if (! function_exists('failed')) {
    function failed($message = '请求失败', $code = Response::HTTP_BAD_REQUEST, $status_code = Response::HTTP_OK)
    {
        return message($message, $code, $header = [], $status_code);
    }
}

if (! function_exists('success')) {
    function success($data = [], $message = '请求成功', $header = [])
    {
        return respond($data, $message, $code = Response::HTTP_OK, $header);
    }
}

if (! function_exists('message')) {
    function message($message, $code = Response::HTTP_OK, $header = [], $status_code = Response::HTTP_OK)
    {
        return respond([], $message, $code, $header, $status_code);
    }
}

if (! function_exists('respond')) {
    function respond($data = [], $message = '', $code = Response::HTTP_OK, array $header = [], $status_code = 200)
    {
        if ($data instanceof LengthAwarePaginator) {
            return response()->json($data, $status_code, $header);
        }
        return response()->json([
            'code' => $code,
            'msg' => $message,
            'data' => $data ? $data : null,
        ], $status_code, $header);
    }
}

if (! function_exists('count_days')) {
    /**
     * 返回两个时间相差天数.
     * @param mixed $now_time
     * @param mixed $normal_time
     * @return float
     */
    function count_days($now_time, $normal_time)
    {
        $now_time = strtotime($now_time);
        $normal_time = strtotime($normal_time);
        $a_dt = getdate($now_time);
        $b_dt = getdate($normal_time);
        $a_new = mktime(12, 0, 0, $a_dt['mon'], $a_dt['mday'], $a_dt['year']);
        $b_new = mktime(12, 0, 0, $b_dt['mon'], $b_dt['mday'], $b_dt['year']);
        return round(($a_new - $b_new) / 86400);
    }
}

if (! function_exists('urlSafeBase64encode')) {
    /**
     * 获取base64安全连接.
     * @param mixed $string
     * @return string|string[]
     */
    function urlSafeBase64encode($string)
    {
        $data = base64_encode($string);
        return str_replace(['+', '/', '='], ['-', '_', ''], $data);
    }
}

if (! function_exists('urlSafeBase64decode')) {
    /**
     * 解析base64安全连接.
     * @param mixed $string
     * @return false|string
     */
    function urlSafeBase64decode($string)
    {
        $data = str_replace(['-', '_'], ['+', '/'], $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}

if (! function_exists('getMillisecond')) {
    /**
     * 获取毫秒时间戳.
     * @return float
     */
    function getMillisecond()
    {
        [$s1, $s2] = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }
}

/*
 * PHP判断一个string 是否是json string
 */
if (! function_exists('isJsonString')) {
    function isJsonString($str)
    {
        try {
            $jObject = json_decode($str);
        } catch (Exception $e) {
            return false;
        }
        return (is_object($jObject)) ? true : false;
    }
}

if (! function_exists('getImage')) {
    /**
     * 获取图片标签.
     * @param string $type
     * @param string $imageSrc
     * @return string
     */
    function getImage($type = 'url', $imageSrc = '')
    {
        $src = $type == 'url' ? env('APP_URL') . '/' . $imageSrc : 'data:image/png;base64,' . $imageSrc;
        return '<img src="' . $src . "\" class='rounded border border-1 shadow w-10' width='100px' hight='100px' onclick=\"{
                let imgSrc = $(this).attr('src');
                const img = new window.Image();
                img.src = imgSrc;
                const newWin = window.open('');
                newWin.document.body.style.background = '#000';
                newWin.document.body.style.textAlign = 'center';
                newWin.document.body.appendChild(img);
                newWin.document.title = '图片预览';
                newWin.document.close();
            }\" />";
    }
}
