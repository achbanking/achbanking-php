<?php

/**
 * Class OAConnectRequest
 * Make initial connection, authenticate and get sessionId.
 *
 * @property string $user_api_token
 * @property string $user_api_key
 */
class OAConnectRequest extends OAAPIRequest
{
    public $action = 'connect';
}

/**
 * Class OADisconnectRequest
 * Close the connection, authenticate and get sessionId.
 */
class OADisconnectRequest extends OAAPIRequest
{
    public $action = 'disconnect';
}

/**
 * Class OAGetExternalAccountRequest
 * Get a single external account, given an external account id.
 *
 * @property string $external_account_id
 */
class OAGetExternalAccountRequest extends OAAPIRequest
{
    public $action = 'getExternalAccount';
}

/**
 * Class OAGetExternalAccountsRequest
 * Get all external accounts, given a payment profile id.
 *
 * @property string $payment_profile_id
 */
class OAGetExternalAccountsRequest extends OAAPIRequest
{
    public $action = 'getExternalAccounts';
}

/**
 * Class OAGetExternalAccountsSummaryRequest
 * Get summary information of external accounts for a given payment profile id.
 *
 *  @property string $payment_profile_id
 */
class OAGetExternalAccountsSummaryRequest extends OAAPIRequest
{
    public $action = 'getExternalAccountsSummary';
}

/**
 * Class OAGetPaymentProfileRequest
 * Get a payment profile, given a payment profile id.
 *
 * @property string $payment_profile_id
 */
class OAGetPaymentProfileRequest extends OAAPIRequest
{
    public $action = 'getPaymentProfile';
}

/**
 * Class OAGetPaymentProfilesListRequest
 * Get the list of payment profiles.
 */
class OAGetPaymentProfilesListRequest extends OAAPIRequest
{
    public $action = 'getPaymentProfilesList';
}

/**
 * Class OAGetPaymentProfileByExtIdRequest
 * Get a payment profile, given an external id.
 *
 * @property string $payment_profile_external_id
 */
class OAGetPaymentProfileByExtIdRequest extends OAAPIRequest
{
    public $action = 'getPaymentProfileByExtId';
}

/**
 * Class OAGetPaymentScheduleRequest
 * Get a payment schedule, given a payment schedule id.
 *
 * @property string $payment_schedule_id
 */
class OAGetPaymentScheduleRequest extends OAAPIRequest
{
    public $action = 'getPaymentSchedule';
}

/**
 * Class OAGetPaymentSchedulesByDateRequest
 * Get a payment schedule, given a date range.
 *
 * @property string $payment_schedule_from_date
 * @property string $payment_schedule_to_date
 */
class OAGetPaymentSchedulesByDateRequest extends OAAPIRequest
{
    public $action = 'getPaymentScheduleByDate';
}

/**
 * Class OAGetPaymentSchedulesLastUpdatesRequest
 * Get a payment schedules, given a date range. only updates.
 *
 * @property string $payment_schedule_from_date
 * @property string $payment_schedule_to_date
 */
class OAGetPaymentSchedulesLastUpdatesRequest extends OAAPIRequest
{
    public $action = 'getPaymentSchedulesLastUpdates';
}

/**
 * Class OAGetPaymentSchedulesLastExtendedUpdatesRequest.
 *
 * @property string $payment_schedule_from_date
 * @property string $payment_schedule_to_date
 */
class OAGetPaymentSchedulesLastExtendedUpdatesRequest extends OAAPIRequest
{
    public $action = 'getPaymentSchedulesLastExtendedUpdates';
}

/**
 * Class OAGetPaymentSchedulesLastExtendedUpdatesForPSRequest.
 *
 * @property string $payment_schedule_id
 */
class OAGetPaymentSchedulesLastExtendedUpdatesForPSRequest extends OAAPIRequest
{
    public $action = 'getPaymentSchedulesLastExtendedUpdatesForPS';
}

/**
 * Class OAGetPaymentSchedulesSuspendsRequest
 * Get a payment schedules, given a date range. only suspends.
 *
 * @property string $payment_schedule_from_date
 * @property string $payment_schedule_to_date
 */
class OAGetPaymentSchedulesSuspendsRequest extends OAAPIRequest
{
    public $action = 'getPaymentSchedulesSuspends';
}

/**
 * Class OAGetPaymentSchedulesRequest
 * Get all payment schedules, given a payment profile id.
 *
 * @property string $payment_profile_id
 */
class OAGetPaymentSchedulesRequest extends OAAPIRequest
{
    public $action = 'getPaymentSchedules';
}

/**
 * Class OAGetPaymentSchedulesSummaryRequest
 * Get summary information of external accounts for a given payment profile id.
 *
 * @property string $payment_profile_id
 */
class OAGetPaymentSchedulesSummaryRequest extends OAAPIRequest
{
    public $action = 'getPaymentSchedulesSummary';
}

/**
 * Class OAGetPaymentTypeRequest
 * Get a single payment type by id.
 *
 * @property string $payment_type_id
 */
class OAGetPaymentTypeRequest extends OAAPIRequest
{
    public $action = 'getPaymentType';
}

/**
 * Class OAGetPaymentTypesRequest
 * Get all available payment types.
 */
class OAGetPaymentTypesRequest extends OAAPIRequest
{
    public $action = 'getPaymentTypes';
}

/**
 * Class OASaveExternalAccountRequest
 * Save an external account.
 *
 * @property string $external_account_id
 * @property string $external_account_payment_profile_id
 * @property string $external_account_type
 * @property string $external_account_name
 * @property string $external_account_bank
 * @property string $external_account_holder
 * @property string $external_account_country_code
 * @property string $external_account_dfi_id
 * @property string $external_account_number
 * @property string $external_account_billing_address
 * @property string $external_account_billing_city
 * @property string $external_account_billing_state_province
 * @property string $external_account_billing_postal_code
 * @property string $external_account_billing_country
 * @property string $external_account_business
 * @property string $external_account_verification_status
 * @property string $external_account_status
 */
class OASaveExternalAccountRequest extends OAAPIRequest
{
    public $action = 'saveExternalAccount';
}

/**
 * Class OASavePaymentProfileRequest
 * Save a payment profile.
 *
 * @property string $payment_profile_id
 * @property string $payment_profile_login_name
 * @property string $payment_profile_external_id
 * @property string $payment_profile_agreement
 * @property string $payment_profile_first_name
 * @property string $payment_profile_last_name
 * @property string $payment_profile_email_address
 * @property string $payment_profile_password
 * @property string $payment_profile_confirm_password
 * @property string $payment_profile_security_question_1
 * @property string $payment_profile_security_question_2
 * @property string $payment_profile_security_question_3
 * @property string $payment_profile_security_answer_1
 * @property string $payment_profile_security_answer_2
 * @property string $payment_profile_security_answer_3
 * @property string $payment_profile_phone
 * @property string $payment_profile_company_name
 * @property string $payment_profile_status
 */
class OASavePaymentProfileRequest extends OAAPIRequest
{
    public $action = 'savePaymentProfile';
}

/**
 * Class OASavePaymentScheduleRequest
 * Save a payment schedule.
 *
 * @property string $payment_schedule_id
 * @property string $payment_schedule_external_account_id
 * @property string $payment_schedule_payment_type_id
 * @property string $payment_schedule_amount
 * @property string $payment_schedule_currency_code
 * @property string $payment_schedule_next_date
 * @property string $payment_schedule_frequency
 * @property string $payment_schedule_end_date
 * @property string $payment_schedule_description
 * @property string $payment_schedule_contract_id
 * @property string $payment_schedule_remaining_occurrences
 * @property string $payment_schedule_status
 */
class OASavePaymentScheduleRequest extends OAAPIRequest
{
    public $action = 'savePaymentSchedule';
}

/**
 * Class OAChangePaymentProfileStatusRequest
 * Disable or enable a payment profile.
 *
 * @deprecated
 */
class OAChangePaymentProfileStatusRequest extends OAAPIRequest
{
    public $action = 'changePaymentProfileSatus';
}

/**
 * Class OAChangePaymentScheduleStatusRequest
 * Disable or enable a payment schedule.
 *
 * @deprecated
 */
class OAChangePaymentScheduleStatusRequest extends OAAPIRequest
{
    public $action = 'changePaymentScheduleStatus';
}

/**
 * Class OASaveProfileCompleteRequest
 * Save a complete set of: payment profile, external account and payment schedule.
 *
 * @deprecated
 */
class OASaveProfileCompleteRequest extends OAAPIRequest
{
    public $action = 'saveProfileComplete';
}

/**
 * Class OASavePaymentTypeRequest.
 *
 * @property string $payment_type_id
 * @property string $payment_type_name
 * @property string $payment_type_transaction_type
 * @property string $payment_type_status
 * @property string $payment_type_description
 * @property string $payment_type_external_account_id
 */
class OASavePaymentTypeRequest extends OAAPIRequest
{
    public $action = 'savePaymentType';
}

/**
 * Class OASavePaymentTypeEARequest
 * Save an external account for payment type.
 *
 * @property string $external_account_id
 * @property string $external_account_type
 * @property string $external_account_name
 * @property string $external_account_bank
 * @property string $external_account_holder
 * @property string $external_account_country_code
 * @property string $external_account_dfi_id
 * @property string $external_account_number
 * @property string $external_account_billing_address
 * @property string $external_account_billing_city
 * @property string $external_account_billing_state_province
 * @property string $external_account_billing_postal_code
 * @property string $external_account_billing_country
 * @property string $external_account_business
 * @property string $external_account_verification_status
 * @property string $external_account_status
 */
class OASavePaymentTypeEARequest extends OAAPIRequest
{
    public $action = 'savePaymentTypeEA';
}

/**
 * Class OAGetPaymentTypeEARequest.
 *
 * @property string $external_account_id
 */
class OAGetPaymentTypeEARequest extends OAAPIRequest
{
    public $action = 'getPaymentTypeEA';
}

/**
 * Class OAGetPhoneRequest.
 *
 * @property string $phone_settings_id
 */
class OAGetPhoneRequest extends OAAPIRequest
{
    public $action = 'getPhoneById';
}

/**
 * Class OAGetPhoneMessagesRequest.
 *
 * @property string $phone_settings_id
 */
class OAGetPhoneMessagesRequest extends OAAPIRequest
{
    public $action = 'getTxtByPhoneId';
}

/**
 * Class OAChangePhoneDetailsRequest.
 *
 * @property string $phone_settings_id
 * @property string $payment_profile_id
 * @property string $phone_settings_phone
 * @property string $phone_settings_notifications_enabled
 * @property string $phone_settings_hard_decline_notfs_enabled
 * @property string $phone_settings_description
 * @property string $phone_settings_user_id
 * @property string $phone_settings_type
 */
class OAChangePhoneDetailsRequest extends OAAPIRequest
{
    public $action = 'changePhoneDetails';
}

/**
 * Class OAGetIndividualAchEntryIdRequest.
 *
 * @property string $payment_schedule_ids
 */
class OAGetIndividualAchEntryIdRequest extends OAAPIRequest
{
    public $action = 'getIndividualAchEntryIdByPaymentSchedule';
}

/**
 * Class OAGetPaymentSchedulesListRequest.
 *
 * @property string $payment_schedule_from_date
 * @property string $payment_schedule_to_date
 */
class OAGetPaymentSchedulesListRequest extends OAAPIRequest
{
    public $action = 'getPaymentSchedulesListByDate';
}

/**
 * Class OAGetCardinalUpdatesRequest.
 *
 * @property string $payment_schedule_from_date
 * @property string $payment_schedule_to_date
 */
class OAGetCardinalUpdatesRequest extends OAAPIRequest
{
    public $action = 'getCardinalUpdates';
}

/**
 * Class OASaveSingleTransactionRequest
 * Save a complete set of: payment profile, external account and payment schedule.
 *
 * @property string $payment_profile_login_name
 * @property string $payment_profile_external_id
 * @property string $payment_profile_agreement
 * @property string $payment_profile_first_name
 * @property string $payment_profile_last_name
 * @property string $payment_profile_email_address
 * @property string $payment_profile_password
 * @property string $payment_profile_confirm_password
 * @property string $payment_profile_security_question_1
 * @property string $payment_profile_security_question_2
 * @property string $payment_profile_security_question_3
 * @property string $payment_profile_security_answer_1
 * @property string $payment_profile_security_answer_2
 * @property string $payment_profile_security_answer_3
 * @property string $payment_profile_phone
 * @property string $payment_profile_company_name
 * @property string $payment_profile_status
 * @property string $external_account_type
 * @property string $external_account_name
 * @property string $external_account_bank
 * @property string $external_account_holder
 * @property string $external_account_country_code
 * @property string $external_account_dfi_id
 * @property string $external_account_number
 * @property string $external_account_billing_address
 * @property string $external_account_billing_city
 * @property string $external_account_billing_state_province
 * @property string $external_account_billing_postal_code
 * @property string $external_account_billing_country
 * @property string $external_account_business
 * @property string $external_account_verification_status
 * @property string $external_account_status
 * @property string $payment_schedule_payment_type_id
 * @property string $payment_schedule_amount
 * @property string $payment_schedule_currency_code
 * @property string $payment_schedule_next_date
 * @property string $payment_schedule_frequency
 * @property string $payment_schedule_end_date
 * @property string $payment_schedule_description
 * @property string $payment_schedule_contract_id
 * @property string $payment_schedule_remaining_occurrences
 * @property string $payment_schedule_status
 */
class OASaveSingleTransactionRequest extends OAAPIRequest
{
    public $action = 'saveSingleTransaction';
}

/**
 * Class OAgetEABlockedListRequest.
 *
 * @property string $date_from
 * @property string $date_to
 */
class OAgetEABlockedListRequest extends OAAPIRequest
{
    public $action = 'getBlocked';
}

/**
 * Class OAgetEABlockedByIdRequest.
 *
 * @property string $id
 */
class OAgetEABlockedByIdRequest extends OAAPIRequest
{
    public $action = 'getBlockedById';
}

/**
 * Class OACheckGiactRequest.
 *
 * @property string $payment_profile_id
 * @property string $giact_search_routing
 * @property string $giact_search_account
 * @property string $giact_search_fname
 * @property string $giact_search_lname
 * @property string $giact_search_address
 * @property string $giact_search_city
 * @property string $giact_search_state
 * @property string $giact_search_zip
 * @property string $giact_search_taxid
 * @property string $giact_search_checkamount
 */
class OACheckGiactRequest extends OAAPIRequest
{
    public $action = 'checkGiact';
}

/**
 * Class OAGetGiactLog.
 *
 * @property string $payment_profile_id
 */
class OAGetGiactLog extends OAAPIRequest
{
    public $action = 'getGiactLog';
}

/**
 * Class OACheckOfac.
 *
 * @property string $company_name
 */
class OACheckOfac extends OAAPIRequest
{
    public $action = 'checkOfac';
}

/**
 * Class OAGetPaymentScheduleTransactionsLogRequest.
 *
 * @property string $payment_schedule_id
 */
class OAGetPaymentScheduleTransactionsLogRequest extends OAAPIRequest
{
    public $action = 'getPaymentScheduleTransactionsLog';
}

/**
 * Class OAGetDocumentRequest.
 *
 * @property string $document_id
 */
class OAGetDocumentRequest extends OAAPIRequest
{
    public $action = 'getDocument';
}

/**
 * Class OAGetDocumentsRequest.
 */
class OAGetDocumentsRequest extends OAAPIRequest
{
    public $action = 'getDocuments';
}

/**
 * Class OASaveDocumentRequest.
 *
 * @property string $document_type
 * @property string $document_signer_email
 * @property string $document_signer_first_name
 * @property string $document_signer_last_name
 * @property string $document_cosigner_email
 * @property string $document_cosigner_first_name
 * @property string $document_cosigner_last_name
 */
class OASaveDocumentRequest extends OAAPIRequest
{
    public $action = 'saveDocument';
}

/**
 * Class OASavePaymentProfileAndExternalAccountRequest.
 *
 * @property string $document_id
 * @property bool   $is_first_run
 * @property string $payment_profile_external_id
 * @property string $payment_profile_login_name
 * @property string $payment_profile_password
 * @property string $payment_profile_confirm_password
 * @property string $payment_profile_company_name
 * @property string $payment_profile_first_name
 * @property string $payment_profile_last_name
 * @property string $payment_profile_email_address
 * @property string $external_account_type
 * @property string $external_account_name
 * @property string $external_account_bank
 * @property string $external_account_holder
 * @property string $external_account_dfi_id
 * @property string $external_account_number
 */
class OASavePaymentProfileAndExternalAccountRequest extends OAAPIRequest
{
    public $action = 'savePaymentProfileAndExternalAccount';
}

/**
 * Class OAExperianGetLogRequest.
 *
 * @property string $experian_id
 * @property bool   $pdf
 */
class OAExperianGetLogRequest extends OAAPIRequest
{
    public $action = 'experianGetLog';
}

/**
 * Class OAExperianGetLogsRequest.
 *
 * @property string $payment_profile_id
 */
class OAExperianGetLogsRequest extends OAAPIRequest
{
    public $action = 'experianGetLogs';
}

/**
 * Class OAExperianSearchBusinessOwnerProfileRequest.
 *
 * @property string $payment_profile_id
 * @property string $business_name
 * @property string $business_tax_id
 * @property string $business_street
 * @property string $business_city
 * @property string $business_state
 * @property string $business_zip
 * @property string $owner1_first_name
 * @property string $owner1_last_name
 * @property string $owner1_ssn
 * @property string $owner1_street
 * @property string $owner1_city
 * @property string $owner1_state
 * @property string $owner1_zip
 * @property string $owner2_first_name
 * @property string $owner2_last_name
 * @property string $owner2_ssn
 * @property string $owner2_street
 * @property string $owner2_city
 * @property string $owner2_state
 * @property string $owner2_zip
 */
class OAExperianSearchBusinessOwnerProfileRequest extends OAAPIRequest
{
    public $action = 'experianSearchBusinessOwnerProfile';
}

/**
 * Class OATloGetLogRequest.
 *
 * @property string $tlo_id
 */
class OATloGetLogRequest extends OAAPIRequest
{
    public $action = 'tloGetLog';
}

/**
 * Class OATloGetLogsRequest.
 *
 * @property string $payment_profile_id
 */
class OATloGetLogsRequest extends OAAPIRequest
{
    public $action = 'tloGetLogs';
}

/**
 * Class OATloSearchPersonalRequest.
 *
 * @property string $payment_profile_id
 * @property string $full_name
 * @property string $ssn
 * @property string $dob
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 */
class OATloSearchPersonalRequest extends OAAPIRequest
{
    public $action = 'tloSearchPersonal';
}

/**
 * Class OATloSearchBusinessRequest.
 *
 * @property string $payment_profile_id
 * @property string $biz_name
 * @property string $biz_filing_number
 * @property string $biz_duns_number
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 */
class OATloSearchBusinessRequest extends OAAPIRequest
{
    public $action = 'tloSearchBusiness';
}
