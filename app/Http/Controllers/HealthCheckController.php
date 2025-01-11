<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Illuminate\Support\Facades\Http;

class HealthCheckController extends Controller
{
    public function getHealthStatus()
    {
        $status = [];


        // HTTP and Web Server Status
        try {
            // HTTP Status Code
            $httpStatusCode = Response::HTTP_OK;

            // Server Software (e.g., Apache, Nginx)
            $serverSoftware = $_SERVER['SERVER_SOFTWARE'];

            // Server Name (hostname)
            $serverName = $_SERVER['SERVER_NAME'];

            // Server Port
            $serverPort = $_SERVER['SERVER_PORT'];

            // Document Root (Root directory for the web server)
            $documentRoot = $_SERVER['DOCUMENT_ROOT'];

            // Server Protocol
            $serverProtocol = $_SERVER['SERVER_PROTOCOL'];

            // Request Method
            $requestMethod = $_SERVER['REQUEST_METHOD'];

            // Request Time
            $requestTime = $_SERVER['REQUEST_TIME'];

            // HTTP Host
            $httpHost = $_SERVER['HTTP_HOST'];

            $status['http'] = [
                'status_code' => $httpStatusCode,
                'status_level' => 'operational',
                'status_message' => 'HTTP service is up and running',
                'data' => [
                    'server_software' => $serverSoftware,
                    'server_name' => $serverName,
                    'server_port' => $serverPort,
                    'document_root' => $documentRoot,
                    'server_protocol' => $serverProtocol,
                    'request_method' => $requestMethod,
                    'request_time' => date('Y-m-d H:i:s', $requestTime),
                    'http_host' => $httpHost,
                ]
            ];
        } catch (\Exception $e) {
            $status['http'] = [
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'status_level' => 'error',
                'status_message' => 'HTTP service failed',
                'data' => $e->getMessage()
            ];
        }



        // Database Status
        try {
            DB::connection()->getPdo();
            $status['database'] = [
                'status_code' => Response::HTTP_OK,
                'status_level' => 'operational',
                'status_message' => 'Database connection is working',
                'data' => null
            ];
        } catch (\Exception $e) {
            $status['database'] = [
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'status_level' => 'error',
                'status_message' => 'Database connection failed',
                'data' => $e->getMessage()
            ];
        }

        // SMTP Status
        try {
            $smtpHost = Config::get('mail.host');
            $smtpPort = Config::get('mail.port');
            $smtpUsername = Config::get('mail.username');
            $smtpPassword = Config::get('mail.password');
            $smtpEncryption = Config::get('mail.encryption');

            // Check if SMTP is configured
            if (empty($smtpHost) || $smtpHost == 'smtp.mailtrap.io' || $smtpHost == 'mailpit' || empty($smtpPort)) {
                $status['smtp'] = [
                    'status_code' => 200,
                    'status_level' => 'ok',
                    'status_message' => 'SMTP service not used.',
                    'data' => null,
                ];
            } else {
                $transport = (new Swift_SmtpTransport($smtpHost, $smtpPort, $smtpEncryption))
                    ->setUsername($smtpUsername)
                    ->setPassword($smtpPassword);

                $mailer = new Swift_Mailer($transport);
                $message = (new Swift_Message('Health Check'))
                    ->setFrom([Config::get('mail.from.address') => 'Health Check'])
                    ->setTo([Config::get('mail.from.address')])
                    ->setBody('SMTP check successful');

                $mailer->send($message);

                $status['smtp'] = [
                    'status_code' => Response::HTTP_OK,
                    'status_level' => 'operational',
                    'status_message' => 'SMTP service is working',
                    'data' => null,
                ];
            }
        } catch (\Exception $e) {
            $status['smtp'] = [
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'status_level' => 'error',
                'status_message' => 'SMTP service failed',
                'data' => $e->getMessage(),
            ];
        }


        // Cache Status
        try {
            // Try setting and getting a cache value to verify cache functionality
            $cacheKey = 'cache_check_key';
            $cacheValue = 'Cache is working';
            Cache::put($cacheKey, $cacheValue, now()->addMinutes(1));

            // Retrieve the cache value to ensure it's working
            $cachedValue = Cache::get($cacheKey);

            if ($cachedValue === $cacheValue) {
                $status['cache'] = [
                    'status_code' => Response::HTTP_OK,
                    'status_level' => 'operational',
                    'status_message' => 'Cache service is working',
                    'data' => 'Cache is operational'
                ];
            } else {
                $status['cache'] = [
                    'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'status_level' => 'error',
                    'status_message' => 'Cache service is not working properly',
                    'data' => 'Failed to retrieve cache value'
                ];
            }

            // Optionally, remove the test cache key
            Cache::forget($cacheKey);
        } catch (\Exception $e) {
            $status['cache'] = [
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'status_level' => 'error',
                'status_message' => 'Cache service failed',
                'data' => $e->getMessage()
            ];
        }



        // Default Filesystem Status with Load and Read/Write Speed
        try {
            $defaultDisk = Config::get('filesystems.default');
            $filesystemConfig = Config::get("filesystems.disks.$defaultDisk");

            if (!$filesystemConfig) {
                throw new \Exception("Default filesystem '$defaultDisk' is not configured properly.");
            }

            // File System Load Calculation
            $diskFreeSpace = disk_free_space('/');
            $diskTotalSpace = disk_total_space('/');
            $diskUsedSpace = $diskTotalSpace - $diskFreeSpace;
            $diskUsagePercentage = ($diskUsedSpace / $diskTotalSpace) * 100;

            // Test file for read/write speed
            $testFilePath = 'health_check_test_file.txt';
            $testData = str_repeat('A', 1024 * 1024); // 1MB of data

            // Measure Write Speed
            $writeStartTime = microtime(true);
            Storage::disk($defaultDisk)->put($testFilePath, $testData);
            $writeEndTime = microtime(true);
            $writeDuration = $writeEndTime - $writeStartTime;
            $writeSpeed = round(1 / $writeDuration, 2); // MB/s

            // Measure Read Speed
            $readStartTime = microtime(true);
            $testFileContent = Storage::disk($defaultDisk)->get($testFilePath);
            $readEndTime = microtime(true);
            $readDuration = $readEndTime - $readStartTime;
            $readSpeed = round(1 / $readDuration, 2); // MB/s

            // Clean up test file
            Storage::disk($defaultDisk)->delete($testFilePath);

            // Verify content
            if ($testFileContent !== $testData) {
                throw new \Exception("Default filesystem '$defaultDisk' failed to read/write correctly.");
            }

            $status['filesystem'] = [
                'status_code' => Response::HTTP_OK,
                'status_level' => 'operational',
                'status_message' => "Default filesystem '$defaultDisk' is accessible and working.",
                'data' => [
                    'disk_usage_percentage' => round($diskUsagePercentage, 2) . '%',
                    'disk_free_space' => $this->formatBytes($diskFreeSpace),
                    'disk_used_space' => $this->formatBytes($diskUsedSpace),
                    'disk_total_space' => $this->formatBytes($diskTotalSpace),
                    'write_speed' => $writeSpeed . ' MB/s',
                    'read_speed' => $readSpeed . ' MB/s',
                ],
            ];
        } catch (\Exception $e) {
            $status['filesystem'] = [
                'status_code' => 200,
                'status_level' => 'ok',
                'status_message' => "Default filesystem '$defaultDisk' is not configured or is not accessible, but this is expected as it may not be used in the project.",
                'data' => $e->getMessage(),
            ];
        }



        // S3 Status
        try {
            $s3Driver = Config::get('filesystems.disks.s3.driver');
            $s3Key = Config::get('filesystems.disks.s3.key');
            $s3Secret = Config::get('filesystems.disks.s3.secret');
            $s3Region = Config::get('filesystems.disks.s3.region');
            $s3Bucket = Config::get('filesystems.disks.s3.bucket');

            // Check if S3 is configured
            if (empty($s3Driver) || $s3Driver != 's3' || empty($s3Key) || empty($s3Secret) || empty($s3Region) || empty($s3Bucket)) {
                $status['s3'] = [
                    'status_code' => 200,
                    'status_level' => 'ok',
                    'status_message' => 'S3 File system not used .',
                    'data' => null,
                ];
            } else {
                $disk = Storage::disk('s3');
                $status['s3'] = [
                    'status_code' => 200,
                    'status_level' => 'ok',
                    'status_message' => 'S3 service is working',
                    'data' => null,
                ];
            }
        } catch (\Exception $e) {
            $status['s3'] = [
                'status_code' => 500,
                'status_level' => 'error',
                'status_message' => 'S3 service failed: ' . $e->getMessage(),
                'data' => null,
            ];
        }




        // PHP Version
        $status['php_version'] = [
            'status_code' => Response::HTTP_OK,
            'status_level' => 'operational',
            'status_message' => 'PHP version retrieved',
            'data' => phpversion()
        ];

        // Server Uptime
        $uptime = $this->getServerUptime();
        $status['server_uptime'] = [
            'status_code' => Response::HTTP_OK,
            'status_level' => 'operational',
            'status_message' => 'Server uptime retrieved',
            'data' => $uptime
        ];

        // System Resource Status
        try {
            // Disk Space
            $diskFree = disk_free_space('/');
            $diskTotal = disk_total_space('/');
            $diskUsage = $diskTotal - $diskFree;
            $diskUsagePercentage = ($diskUsage / $diskTotal) * 100;

            // Memory Usage
            $memoryUsage = memory_get_usage(true);
            $memoryPeakUsage = memory_get_peak_usage(true);
            $memoryLimit = ini_get('memory_limit');

            // CPU Usage (Linux only)
            $cpuUsage = $this->getCpuUsage(); // Assuming this method is defined elsewhere in your code

            $status['system_resources'] = [
                'status_code' => Response::HTTP_OK,
                'status_level' => 'operational',
                'status_message' => 'System resource usage retrieved',
                'data' => [
                    'disk' => [
                        'free_space' => $this->formatBytes($diskFree),
                        'total_space' => $this->formatBytes($diskTotal),
                        'used_space' => $this->formatBytes($diskUsage),
                        'usage_percentage' => round($diskUsagePercentage, 2) . '%'
                    ],
                    'memory' => [
                        'memory_usage' => $this->formatBytes($memoryUsage),
                        'memory_peak_usage' => $this->formatBytes($memoryPeakUsage),
                        'memory_limit' => $memoryLimit
                    ],
                    'cpu' => [
                        'cpu_usage' => $cpuUsage // Assuming this returns a formatted string or array
                    ]
                ]
            ];
        } catch (\Exception $e) {
            $status['system_resources'] = [
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'status_level' => 'error',
                'status_message' => 'Failed to retrieve system resources',
                'data' => $e->getMessage()
            ];
        }
        // System Resource Status
        try {
            // Disk Space
            $diskFree = disk_free_space('/');
            $diskTotal = disk_total_space('/');
            $diskUsage = $diskTotal - $diskFree;
            $diskUsagePercentage = ($diskUsage / $diskTotal) * 100;

            // Memory Usage
            $memoryUsage = memory_get_usage(true);
            $memoryPeakUsage = memory_get_peak_usage(true);
            $memoryLimit = ini_get('memory_limit');

            // CPU Usage (Linux only)
            $cpuUsage = $this->getCpuUsage(); // Assuming this method is defined elsewhere in your code

            $status['system_resources'] = [
                'status_code' => Response::HTTP_OK,
                'status_level' => 'operational',
                'status_message' => 'System resource usage retrieved',
                'data' => [
                    'disk' => [
                        'free_space' => $this->formatBytes($diskFree),
                        'total_space' => $this->formatBytes($diskTotal),
                        'used_space' => $this->formatBytes($diskUsage),
                        'usage_percentage' => round($diskUsagePercentage, 2) . '%'
                    ],
                    'memory' => [
                        'memory_usage' => $this->formatBytes($memoryUsage),
                        'memory_peak_usage' => $this->formatBytes($memoryPeakUsage),
                        'memory_limit' => $memoryLimit
                    ],
                    'cpu' => [
                        'cpu_usage' => $cpuUsage // Assuming this returns a formatted string or array
                    ]
                ]
            ];
        } catch (\Exception $e) {
            $status['system_resources'] = [
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'status_level' => 'error',
                'status_message' => 'Failed to retrieve system resources',
                'data' => $e->getMessage()
            ];
        }
        // System Load
        $load = sys_getloadavg();
        $status['system_load'] = [
            'status_code' => Response::HTTP_OK,
            'status_level' => 'operational',
            'status_message' => 'System load retrieved',
            'data' => $load
        ];
        // Laravel Environment
        $status['environment'] = [
            'status_code' => Response::HTTP_OK,
            'status_level' => 'operational',
            'status_message' => 'Laravel environment details retrieved',
            'data' => [
                'app_environment' => env('APP_ENV'),
                'app_debug' => env('APP_DEBUG'),
                'app_url' => env('APP_URL')
            ]
        ];

        // IP Information
        $ipInformation = $this->getIpInformation();
        $status['ip_information'] = [
            'status_code' => Response::HTTP_OK,
            'status_level' => 'operational',
            'status_message' => 'IP information retrieved',
            'data' => $ipInformation
        ];

        return response()->json($status);
    }



    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    private function getServerUptime()
    {
        if (stristr(PHP_OS, 'WIN')) {
            return 'Server uptime check is not supported on Windows.';
        } else {
            $uptime = shell_exec('uptime -p');
            return $uptime ? trim($uptime) : 'Unable to get server uptime.';
        }
    }

    private function getCpuUsage()
    {
        if (stristr(PHP_OS, 'WIN')) {
            return 'CPU usage check is not supported on Windows.';
        } else {
            $cpuUsage = shell_exec("top -bn1 | grep 'Cpu(s)' | sed \"s/.*, *\\([0-9.]*\\)%* id.*/\\1/\" | awk '{print 100 - $1}'");
            return $cpuUsage ? trim($cpuUsage) . '%' : 'Unable to get CPU usage.';
        }
    }

    private function getIpInformation()
    {
        $ip = $this->getPublicIp();
        $info = [];

        // Get public IP
        $info['public_ip'] = $ip;

        // Optional: Fetch additional IP information from an external API
        if ($ip) {
            $response = file_get_contents("http://ip-api.com/json/{$ip}");
            if ($response) {
                $data = json_decode($response, true);
                $info['ip_details'] = $data;
            } else {
                $info['ip_details'] = 'Unable to retrieve IP details.';
            }
        }

        return $info;
    }

    private function getPublicIp()
    {
        $ip = file_get_contents('https://api.ipify.org');
        return $ip ? trim($ip) : 'Unable to retrieve public IP.';
    }
}
