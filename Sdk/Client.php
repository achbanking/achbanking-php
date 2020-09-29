<?php

namespace AchBanking\Sdk;

use AchBanking\Sdk\Exceptions\ConnectException;
use AchBanking\Sdk\Exceptions\RequestException;
use Exception;
use OAAPIRequest;
use OAAPIResponse;
use OAClient;

/**
 * A client for accessing the ACH Banking API.
 *
 * @method object getExternalAccount(array $attributes = [])
 * @method object getExternalAccounts(array $attributes = [])
 * @method object getExternalAccountsSummary(array $attributes = [])
 * @method object getPaymentProfile(array $attributes = [])
 * @method object getPaymentProfilesList(array $attributes = [])
 * @method object getPaymentProfileByExtId(array $attributes = [])
 * @method object getPaymentSchedule(array $attributes = [])
 * @method object getPaymentScheduleByDate(array $attributes = [])
 * @method object getPaymentSchedulesLastUpdates(array $attributes = [])
 * @method object getPaymentSchedulesLastExtendedUpdates(array $attributes = [])
 * @method object getPaymentSchedulesLastExtendedUpdatesForPS(array $attributes = [])
 * @method object getPaymentSchedulesSuspends(array $attributes = [])
 * @method object getPaymentSchedules(array $attributes = [])
 * @method object getPaymentSchedulesSummary(array $attributes = [])
 * @method object getPaymentType(array $attributes = [])
 * @method object getPaymentTypes(array $attributes = [])
 * @method object saveExternalAccount(array $attributes = [])
 * @method object savePaymentProfile(array $attributes = [])
 * @method object savePaymentSchedule(array $attributes = [])
 * @method object changePaymentProfileSatus(array $attributes = [])
 * @method object changePaymentScheduleStatus(array $attributes = [])
 * @method object saveProfileComplete(array $attributes = [])
 * @method object savePaymentType(array $attributes = [])
 * @method object savePaymentTypeEA(array $attributes = [])
 * @method object getPaymentTypeEA(array $attributes = [])
 * @method object getPhoneById(array $attributes = [])
 * @method object getTxtByPhoneId(array $attributes = [])
 * @method object changePhoneDetails(array $attributes = [])
 * @method object getIndividualAchEntryIdByPaymentSchedule(array $attributes = [])
 * @method object getPaymentSchedulesListByDate(array $attributes = [])
 * @method object getCardinalUpdates(array $attributes = [])
 * @method object saveSingleTransaction(array $attributes = [])
 * @method object getBlocked(array $attributes = [])
 * @method object getBlockedById(array $attributes = [])
 * @method object checkGiact(array $attributes = [])
 * @method object getGiactLog(array $attributes = [])
 * @method object getPaymentScheduleTransactionsLog(array $attributes = [])
 * @method object getDocument(array $attributes = [])
 * @method object getDocuments(array $attributes = [])
 * @method object saveDocument(array $attributes = [])
 * @method object savePaymentProfileAndExternalAccount(array $attributes = [])
 * @method object experianGetLog(array $attributes = [])
 * @method object experianGetLogs(array $attributes = [])
 * @method object experianSearchBusinessOwnerProfile(array $attributes = [])
 * @method object tloGetLog(array $attributes = [])
 * @method object tloGetLogs(array $attributes = [])
 * @method object tloSearchPersonal(array $attributes = [])
 * @method object tloSearchBusiness(array $attributes = [])
 */
class Client
{
    protected $client;
    protected $connected = false;
    protected $sessionId;
    protected $error;

    protected $token;
    protected $key;
    protected $endpoint;

    public function __construct(
        string $token = null,
        string $key = null,
        string $endpoint = null
    ) {
        $this->client = new OAClient();

        $this->useCredentials($token, $key, $endpoint);
    }

    public function __destruct()
    {
        if ($this->connected) {
            $this->client->disconnect();
        }
    }

    public function __call(string $name, array $arguments)
    {
        $request = new class() extends OAAPIRequest {
            public $action;
        };

        $request->action = $name;

        foreach ($arguments[0] ?? [] as $attribute => $value) {
            $request->{$attribute} = $value;
        }

        return $this->sendRequest($request);
    }

    public function useCredentials(
        string $token = null,
        string $key = null,
        string $endpoint = null
    ) {
        if (
            $this->connected
            && $this->token === $token
            && $this->key === $key
            && $this->endpoint === $endpoint
        ) {
            return;
        }

        if ($this->connected) {
            $this->client->disconnect();
        }

        $this->token = $token;
        $this->key = $key;
        $this->endpoint = $endpoint;

        if (!$this->token || !$this->key) {
            $this->error = 'Credentials are required';
            return;
        }

        if (!$this->endpoint) {
            $this->error = 'The endpoint is not set';
            return;
        }

        try {
            $response = $this->client->connect(
                $this->token,
                $this->key,
                $this->endpoint
            );

            if ($response instanceof OAAPIResponse && $response->success) {
                $this->connected = $response->success;
                $this->sessionId = $response->session_id;
                return;
            }

            $this->error = !empty($response->error) ? $response->error : 'Unable to connect';
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function isConnected()
    {
        return $this->connected;
    }

    protected function sendRequest($request)
    {
        if ($this->connected) {
            $response = $this->client->sendRequest($request);

            if ($response instanceof OAAPIResponse && $response->success) {
                return $response->data;
            }

            $error = !empty($response->error) ? $response->error : 'Received unknown answer';

            throw new RequestException($error);
        }

        throw new ConnectException($this->error ?? 'Not connected');
    }
}
