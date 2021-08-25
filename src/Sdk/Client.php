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
 * @method array  getExternalAccounts(array|object $attributes = [])
 * @method array  getExternalAccountsSummary(array|object $attributes = [])
 * @method object getPaymentProfile(array|object $attributes = [])
 * @method array  getPaymentProfilesList(array|object $attributes = [])
 * @method object getPaymentProfileByExtId(array|object $attributes = [])
 * @method object getPaymentSchedule(array|object $attributes = [])
 * @method object getPaymentScheduleByDate(array|object $attributes = [])
 * @method array  getPaymentSchedulesLastUpdates(array|object $attributes = [])
 * @method array  getPaymentSchedulesLastExtendedUpdates(array|object $attributes = [])
 * @method array  getPaymentSchedulesLastExtendedUpdatesForPS(array|object $attributes = [])
 * @method array  getPaymentSchedulesSuspends(array|object $attributes = [])
 * @method array  getPaymentSchedules(array|object $attributes = [])
 * @method array  getPaymentSchedulesSummary(array|object $attributes = [])
 * @method object getPaymentType(array|object $attributes = [])
 * @method array  getPaymentTypes(array|object $attributes = [])
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
 * @method array  getTxtByPhoneId(array|object $attributes = [])
 * @method object changePhoneDetails(array|object $attributes = [])
 * @method object getIndividualAchEntryIdByPaymentSchedule(array|object $attributes = [])
 * @method array  getPaymentSchedulesListByDate(array|object $attributes = [])
 * @method array  getCardinalUpdates(array|object $attributes = [])
 * @method object saveSingleTransaction(array|object $attributes = [])
 * @method array  getBlocked(array|object $attributes = [])
 * @method array  getBlockedById(array|object $attributes = [])
 * @method object checkGiact(array|object $attributes = [])
 * @method array  getGiactLog(array|object $attributes = [])
 * @method array  checkOfac(array|object $attributes = [])
 * @method array  getPaymentScheduleTransactionsLog(array|object $attributes = [])
 * @method object getDocument(array|object $attributes = [])
 * @method array  getDocuments(array|object $attributes = [])
 * @method object saveDocument(array|object $attributes = [])
 * @method object savePaymentProfileAndExternalAccount(array|object $attributes = [])
 * @method object experianGetLog(array|object $attributes = [])
 * @method array  experianGetLogs(array|object $attributes = [])
 * @method object experianSearchBusinessOwnerProfile(array|object $attributes = [])
 * @method object tloGetLog(array|object $attributes = [])
 * @method array  tloGetLogs(array|object $attributes = [])
 * @method object tloSearchPersonal(array|object $attributes = [])
 * @method object tloSearchBusiness(array|object $attributes = [])
 */
class Client
{
    /** @var OAClient */
    protected $client;
    /** @var bool */
    protected $connected = false;
    /** @var ?string */
    protected $sessionId;
    /** @var ?string */
    protected $error;

    /** @var string */
    protected $token;
    /** @var string */
    protected $key;
    /** @var string */
    protected $endpoint;
    /** @var int */
    protected $timeout;

    public function __construct(
        ?string $token = null,
        ?string $key = null,
        ?string $endpoint = null,
        ?int $timeout = null
    ) {
        $this->client = new OAClient();

        $this->useCredentials($token, $key, $endpoint, $timeout);
    }

    public function __destruct()
    {
        if ($this->connected) {
            $this->reset();
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
        ?string $token = null,
        ?string $key = null,
        ?string $endpoint = null,
        ?int $timeout = null
    ) {
        if (
            $this->connected
            && $this->token === $token
            && $this->key === $key
            && $this->endpoint === $endpoint
        ) {
            return;
        }

        $this->reset();

        if ($this->connected) {
            $this->client->disconnect();
        }

        $this->token = $token;
        $this->key = $key;
        $this->endpoint = $endpoint;
        $this->timeout = $timeout;

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
                $this->endpoint,
                null,
                $this->timeout
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

    public function withoutAuth(
        ?string $endpoint = null,
        ?int $timeout = null
    ) {
        $this->reset();

        if ($endpoint) {
            $this->endpoint = $endpoint;
        }

        if ($timeout) {
            $this->timeout = $timeout;
        }

        if (!$this->endpoint) {
            $this->error = 'The endpoint is not set';
            return $this;
        }

        $this->client->withoutAuth(
            $this->endpoint,
            null,
            $this->timeout
        );

        $this->connected = true;

        return $this;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function isConnected()
    {
        return $this->connected;
    }

    public function getError()
    {
        return $this->error;
    }

    protected function reset()
    {
        $this->connected = false;
        $this->sessionId = null;
        $this->error = null;
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
