<?php

require_once(OP_MOD . 'email/ProviderInterface.php');
require_once(OP_MOD . 'email/LoggerInterface.php');

require_once(OP_LIB . 'vendor/egoi-api-class/EgoiApi.php');
ini_set('include_path', OP_LIB . 'vendor/egoi-api-class');


/**
 * Egoi email integration provider
 * @author OptimizePress <info@optimizepress.com>
 */
class OptimizePress_Modules_Email_Provider_Egoi implements OptimizePress_Modules_Email_ProviderInterface
{
    const OPTION_NAME_API_KEY = 'egoi_api_key';

    /**
     * @var OP_EgoiApi
     */
    protected $client = null;

    /**
     * @var boolean
     */
    protected $apiKey = false;

    /**
     * @var OptimizePress_Modules_Email_LoggerInterface
     */
    protected $logger;

    /**
     * Initializes client object and fetches API KEY
     */
    public function __construct(OptimizePress_Modules_Email_LoggerInterface $logger)
    {
        $this->apiKey = op_get_option(self::OPTION_NAME_API_KEY);

        /*
         * Initializing logger
         */
        $this->logger = $logger;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getClient()
     */
    public function getClient()
    {
        if (null === $this->client) {
            $this->client = new OP_EgoiApi($this->logger);
        }

        return $this->client;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getLists()
     */
    public function getLists()
    {
        $arguments = array(
            "apikey" => $this->apiKey
        );

        $lists = $this->getClient()->call('getLists', $arguments);

        $this->logger->info('Lists: ' . print_r($lists, true));

        return $lists;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getData()
     */
    public function getData()
    {
        $data = array(
            'lists' => array()
        );

        /*
         * List parsing
         */
        $lists = $this->getLists();
            foreach ($lists as $list) {
                $data['lists'][$list['listnum']] = array('name' => $list['title']);
            }

        $this->logger->info('Formatted lists: ' . print_r($data, true));

        return $data;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::subscribe()
     */
    public function subscribe($data)
    {
         $this->logger->info('Subscribing user: ' . print_r($data, true));

        if (isset($data['list']) && isset($data['email'])) {

            $params = array(
                'apikey'    => $this->apiKey,
                'listID' => $data['list'],
                'email' => $data['email']
            );

            $params = array_merge($params, $this->prepareMergeVars($data['list']));

            $this->logger->info('params: ' . print_r($params, true));

            $user = $this->getClient()->call('addSubscriber', $params);

            return true;
         } else {
            $this->logger->alert('Mandatory information not present [list and/or email address]');
            wp_die('Mandatory information not present [list and/or email address].');
        }
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::register()
     */
    public function register($list, $email, $fname, $lname)
    {
            $params = array(
                'apikey'    => $this->apikey,
                'listID' => $list,
                'email' => $email,
                'first_name' => $fname,
                'last_name' => $lname
            );

        $user = $this->getClient()->call('addSubscriber', $params);

        return true;
    }

    /**
     * Searches for possible form fields from POST and adds them to the collection
     * @param  string $id
     * @return null|array     Null if no value/field found
     */
    protected function prepareMergeVars($id)
    {
        $vars = array('validate_phone' => 0);
        $allowed = array_keys($this->getFormFields($id));

        foreach ($allowed as $name) {
            if ($name !== 'email' && false !== $value = op_post($name)) {
                $vars[$name] = $value;
            }
        }

        return $vars;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::isEnabled()
     */
    public function isEnabled()
    {
        return $this->apiKey === false ? false : true;
    }

    /**
     * Returns form fields for given list
     * @param  string $id
     * @return array
     */
    public function getFormFields($id)
    {
       $fields = array(
            'first_name'    => __('First Name', OP_SN),
            'last_name'     => __('Last Name', OP_SN),
            'telephone'     => __('Telephone', OP_SN),
            'cellphone'     => __('Cellphone', OP_SN),
            'fax'           => __('Fax', OP_SN),
            'birth_data'    => __('Birth Date', OP_SN),
        );

        $lists = $this->getLists();
        foreach ($lists as $list) {
            if($id == $list['listnum']) {
                if($list['extra_fields'] != false) {
                    foreach($list['extra_fields'] as $field) {
                        $fields['extra_' . $field['id']] = $field['ref'];
                    }
                }
            }
        }

        return $fields;
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getListFields()
     */
    public function getListFields($listId)
    {
        $fields = $this->getFormFields($listId);

        $this->logger->info("Fields for list $listId: " . print_r($fields, true));

        return array('fields' => $fields);
    }

    /**
     * @see OptimizePress_Modules_Email_ProviderInterface::getItems()
     */
    public function getItems()
    {
        $data = array(
            'lists' => array()
        );

        $lists = $this->getLists();

            foreach ($lists as $list) {
                $data['lists'][$list['listnum']] = array('name' => $list['title']);
            }

        $this->logger->info('Items: ' . print_r($data, true));

        return $data;
    }
}