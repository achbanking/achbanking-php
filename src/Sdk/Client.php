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
 * @method object getExternalAccount(array|object $attributes = [])
 * @method object getExternalAccounts(array|object $attributes = [])
 * @method object getExternalAccountsSummary(array|object $attributes = [])
 * @method object getPaymentProfile(array|object $attributes = [])
 * @method object getPaymentProfilesList(array|object $attributes = [])
 * @method object getPaymentProfileByExtId(array|object $attributes = [])
 * @method object getPaymentSchedule(array|object $attributes = [])
 * @method object getPaymentScheduleByDate(array|object $attributes = [])
 * @method object getPaymentSchedulesLastUpdates(array|object $attributes = [])
 * @method object getPaymentSchedulesLastExtendedUpdates(array|object $attributes = [])
 * @method object getPaymentSchedulesLastExtendedUpdatesForPS(array|object $attributes = [])
 * @method object getPaymentSchedulesSuspends(array|object $attributes = [])
 * @method object getPaymentSchedules(array|object $attributes = [])
 * @method object getPaymentSchedulesSummary(array|object $attributes = [])
 * @method object getPaymentType(array|object $attributes = [])
 * @method object getPaymentTypes(array|object $attributes = [])
 * @method object saveExternalAccount(array|object $attributes = [])
 * @method object savePaymentProfile(array|object $attributes = [])
 * @method object savePaymentSchedule(array|object $attributes = [])
 * @method object changePaymentProfileSatus(array|object $attributes = [])
 * @method object changePaymentScheduleStatus(array|object $attributes = [])
 * @method object saveProfileComplete(array|object $attributes = [])
 * @method object savePaymentType(array|object $attributes = [])
 * @method object savePaymentTypeEA(array|object $attributes = [])
 * @method object getPaymentTypeEA(array|object $attributes = [])
 * @method object getPhoneById(array|object $attributes = [])
 * @method object getTxtByPhoneId(array|object $attributes = [])
 * @method object changePhoneDetails(array|object $attributes = [])
 * @method object getIndividualAchEntryIdByPaymentSchedule(array|object $attributes = [])
 * @method object getPaymentSchedulesListByDate(array|object $attributes = [])
 * @method object getCardinalUpdates(array|object $attributes = [])
 * @method object saveSingleTransaction(array|object $attributes = [])
 * @method object getBlocked(array|object $attributes = [])
 * @method object getBlockedById(array|object $attributes = [])
 * @method object checkGiact(array|object $attributes = [])
 * @method object getGiactLog(array|object $attributes = [])
 * @method object getPaymentScheduleTransactionsLog(array|object $attributes = [])
 * @method object getDocument(array|object $attributes = [])
 * @method object getDocuments(array|object $attributes = [])
 * @method object saveDocument(array|object $attributes = [])
 * @method object savePaymentProfileAndExternalAccount(array|object $attributes = [])
 * @method object experianGetLog(array|object $attributes = [])
 * @method object experianGetLogs(array|object $attributes = [])
 * @method object experianSearchBusinessOwnerProfile(array|object $attributes = [])
 * @method object tloGetLog(array|object $attributes = [])
 * @method object tloGetLogs(array|object $attributes = [])
 * @method object tloSearchPersonal(array|object $attributes = [])
 * @method object tloSearchBusiness(array|object $attributes = [])
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

        foreach ((array) ($arguments[0] ?? []) as $attribute => $value) {
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
