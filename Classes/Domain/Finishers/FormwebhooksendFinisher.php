<?php
namespace Brightside\Formwebhooksend\Domain\Finishers;

use TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher;
use GuzzleHttp\Client;
use Symfony\Component\Yaml\Yaml;

class FormwebhooksendFinisher extends AbstractFinisher
{
    protected function executeInternal()
    {
        $formRuntime = $this->finisherContext->getFormRuntime();
        $formValues = $formRuntime->getFormState()->getFormValues();

        // Get webhook URL and API token from finisher options
        $webhookUrl = $this->parseOption('webhookUrl');
        $apiToken = $this->parseOption('apiToken');

        // Get field mappings from finisher options
        $fieldMappingsOption = $this->parseOption('fieldMappings');
        $fieldMappings = $this->parseFieldMappings($fieldMappingsOption);

        // Get custom values from finisher options
        $customValues = $this->parseOption('customValues');
        $customData = $this->parseCustomValues($customValues);

        // Map the form fields based on configuration
        $mappedData = $this->mapFields($formValues, $fieldMappings);

        // Merge custom data into mapped data
        $mappedData = array_merge($mappedData, $customData);

        // Convert mapped data to JSON and send to webhook
        $jsonData = $this->convertArrayToJson($mappedData);
        $this->sendToWebhook($jsonData, $webhookUrl, $apiToken);
    }

    /**
     * Parse field mappings from YAML string or key-value array
     */
    private function parseFieldMappings($fieldMappingsOption)
    {
        if (is_string($fieldMappingsOption)) {
            try {
                $parsedMappings = Yaml::parse($fieldMappingsOption);
            } catch (\Exception $e) {
                throw new \RuntimeException('Invalid YAML in field mappings: ' . $e->getMessage());
            }
            return $parsedMappings;
        } elseif (is_array($fieldMappingsOption)) {
            return $fieldMappingsOption;
        } else {
            return [];
        }
    }

    /**
     * Parse custom values from string input
     */
    private function parseCustomValues($customValues)
    {
        $customData = [];

        // Split input by commas or new lines and parse as key-value pairs
        $lines = preg_split('/[\r\n,]+/', $customValues);
        foreach ($lines as $line) {
            $parts = explode(':', $line, 2);
            if (count($parts) === 2) {
                $key = trim($parts[0]);
                $value = trim($parts[1]);
                $customData[$key] = $value;
            }
        }

        return $customData;
    }

    /**
     * Map form fields based on the provided mapping
     */
    private function mapFields(array $formValues, array $fieldMappings)
    {
        $mappedData = [];

        foreach ($fieldMappings as $originalKey => $mappedKey) {
            if (isset($formValues[$originalKey])) {
                $mappedData[$mappedKey] = $formValues[$originalKey];
            }
        }

        return $mappedData;
    }

    /**
     * Convert array to JSON
     */
    private function convertArrayToJson($data)
    {
        return json_encode($data);
    }

    /**
     * Send data to webhook
     */
    private function sendToWebhook($jsonData, $webhookUrl, $apiToken)
    {
        // Example using Guzzle HTTP client to send JSON data
        $client = new Client();
        $response = $client->post($webhookUrl, [
            'json' => json_decode($jsonData, true),
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-token' => $apiToken,
            ],
        ]);

        // Handle response from webhook endpoint
        $statusCode = $response->getStatusCode();
        if ($statusCode === 200) {
            // Webhook successfully sent
            // Handle response if needed
        } else {
            echo "Error on sending form information via webhook";
            // Handle error
            // Log or retry mechanism
        }
    }
}
