<?php


namespace system;


use think\App;

/**
 * 获取系统信息
 * Class SystemInfo
 * @package app\common\tool
 */
abstract class SystemInfo
{

    /**
     * 获取系统信息
     *
     * @return array
     */
    public static function getSystemInfo()
    {

        $baseInfo = [
            'operating_system' => PHP_OS,
            'php_version' => PHP_VERSION,
            'zend_version' => zend_version(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'],
        ];
        $avdInfo = [];
        if (!IS_WIN) {
            $avdInfo = self::getLinuxSystemInfo();
        } else {
            $avdInfo = self::getWindowsSystemInfo();
        }

        $avdInfo['disk_size'] = sprintf("%.2f", disk_total_space(__DIR__) / 1024 / 1024 / 1024) . ' GB';

        return array_merge($baseInfo, $avdInfo);
    }

    /**
     * 获取linux 系统信息
     *
     * @return array
     */
    private static function getLinuxSystemInfo()
    {
        $cpuInfo = self::getLinuxCpuInfo();
        $memeryInfo = self::getLinuxMemeryInfo();
        return [
            'cpu_name' => $cpuInfo['model_name'],
            'memery_size' => sprintf("%.2f", (int)$memeryInfo['MemTotal'] / 1024 / 1024) . ' GB'
        ];
    }

    /**
     * 获取Linux系统Cpu信息
     * @return array
     */
    private static function getLinuxCpuInfo()
    {
        $cpuInfo = file_get_contents('/proc/cpuinfo');

        $cpuInfo = self::linuxProcFileToArray($cpuInfo);

        return $cpuInfo;
    }

    /**
     * 获取linux内存信息
     * @return array|false|string
     */
    private static function getLinuxMemeryInfo()
    {
        $memInfo = file_get_contents('/proc/meminfo');

        $memInfo = self::linuxProcFileToArray($memInfo);

        return $memInfo;
    }

    private static function linuxProcFileToArray(String $rawInfo)
    {
        $rawInfo = explode("\n", str_replace('	', '', $rawInfo));
        $infoArr = [];
        foreach ($rawInfo as $line) {
            if (empty($line)) {
                continue;
            }
            $arr = explode(':', $line);
            if (count($arr) == 2) {
                list($key, $val) = $arr;
            }
            $infoArr[trim(str_replace(' ', '_', $key))] = trim($val);
        }
        return $infoArr;
    }

    /**
     * 获取windows系统信息
     *
     * @return array
     */
    private static function getWindowsSystemInfo()
    {
        $cpuInfo = self::getWindowsCpuInfo();
        $memeryInfo = self::getWindowsMemeryInfo();
        return [
            'cpu_name' => $cpuInfo['name'],
            'memery_size' => $memeryInfo
        ];
    }


    private static function getWindowsCpuInfo()
    {
        exec("wmic cpu get name", $raw); // 型号
        exec("wmic cpu get SerialNumber", $raw); //
        exec("wmic cpu get ThreadCount", $raw); // 线程数
        exec("wmic cpu get NumberOfCores", $raw); // 核心数
        exec("wmic cpu get ProcessorId", $raw); // 处理器编号

        return [
            'name' => $raw[1],
            'serial_number' => $raw[4],
            'thread_count' => $raw[7],
            'number_cores' => $raw[11],
            'processor_id' => $raw[13],
        ];

    }

    /**
     * 获取windows 内存信息
     *
     * @return string
     */
    private static function getWindowsMemeryInfo()
    {

        exec("wmic memorychip", $memeryRawInfo);

        $caption = false;
        $memeryInfo = [];
        // 去除排版格式 整理数据
        foreach ($memeryRawInfo as $str) {
            $str = str_replace('        ', ' ', $str);
            $str = str_replace('       ', ' ', $str);
            $str = str_replace('      ', ' ', $str);
            $str = str_replace('     ', ' ', $str);
            $str = str_replace('    ', ' ', $str);
            $str = str_replace('   ', ' ', $str);
            $str = str_replace('  ', ' ', $str);
            if (false === $caption) {
                foreach (explode(' ', $str) as $i => $item) {
                    if ($item == 'Caption') {
                        $caption = $i;
                    }
                }
                continue;
            }
            $memeryInfo[] = explode(' ', $str);

        }

        $string = '';
        // 拼接字符串
        foreach ($memeryInfo as $item) {
            if (isset($item[$caption])) {
                $string .= ($item[$caption] / 1024 / 1024 / 1024 . 'GB + ');
            }
        }
        // 去除多余字符串
        $string = rtrim($string, ' + ');
        return $string;
    }


    /**
     * 获取监控信息
     *
     * @return array
     */
    public static function getMonitorInfo()
    {
        if (!IS_WIN) {
            // linux
            $monitorInfo['loadAvg'] = self::getLinuxLoadAvg();

            $cpuInfo = file_get_contents('/proc/stat');
            $pattern = "/(cpu[0-9]?)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)/";
            preg_match_all($pattern, $cpuInfo, $out);
            $cpuUsage = (100 * $out[2][0] + $out[3][0]) / ($out[4][0] + $out[5][0] + $out[6][0] + $out[7][0]);

            $memInfo = file_get_contents('/proc/meminfo');
            $memInfo = self::linuxProcFileToArray($memInfo);
            $notUsageSize = (int)$memInfo['MemTotal'] - (int)$memInfo['MemFree'];

            $monitorInfo['memery_usage'] = sprintf('%.2f', $notUsageSize / (int)$memInfo['MemTotal']);
            $monitorInfo['cpu_usage'] = sprintf('%.2f', $cpuUsage);
        } else {
            // windows
            $winUsageInfo = new WinUsageInfo();
            $monitorInfo['cpu_usage'] = sprintf('%.2f', $winUsageInfo->getCpuUsage());
            $monitorInfo['memery_usage'] = sprintf('%.2f', $winUsageInfo->getMemoryUsage()['usage']);
        }
        return $monitorInfo;
    }

    private static function getLinuxLoadAvg()
    {
        $avg = file_get_contents('/proc/loadavg');
        $avg = explode(' ', $avg);
        return $avg;
    }
}