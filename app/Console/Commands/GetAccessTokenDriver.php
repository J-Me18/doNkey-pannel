<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\FirebaseController; // Import your controller
use Illuminate\Support\Facades\Log;

class GetAccessTokenDriver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:access_token_driver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch access token for driver directly from FirebaseController';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Define the log file path for driver access token
        $driverLogFilePath = storage_path('logs/driver_access_token.log');

        try {
            // Instantiate the controller
            $controller = new FirebaseController();

            // Directly call the controller's method
            $response = $controller->getAccessTokenDriver(); // Assuming this method exists in the controller

            // Prepare log data for the driver access token
            $logData = [
                'status' => $response->status(),        // Assuming the method returns a response object
                'body' => $response->getContent(),      // Get the response body content
                'timestamp' => now()->toDateTimeString(),
            ];

            // Convert log data to string format and append to the driver log file
            $logEntry = json_encode($logData, JSON_PRETTY_PRINT) . "\n";
            file_put_contents($driverLogFilePath, $logEntry, FILE_APPEND);

            // Check if the response was successful
            if ($response->isSuccessful()) {
                $this->info('Driver access token updated successfully.');
                file_put_contents($driverLogFilePath, "Success: Driver access token updated.\n", FILE_APPEND);
            } else {
                $this->error('Failed to update driver access token. Status: ' . $response->status());
                file_put_contents($driverLogFilePath, "Error: Failed to update driver access token. Status: " . $response->status() . "\n", FILE_APPEND);
            }

        } catch (\Exception $e) {
            // Log any exceptions to the driver log file
            $errorMessage = 'Error occurred: ' . $e->getMessage();
            $this->error($errorMessage);
            file_put_contents($driverLogFilePath, "Exception: $errorMessage\n", FILE_APPEND);
        }

        return 0;
    }
}