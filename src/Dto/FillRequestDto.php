<?php

namespace aslikeyou\OAuth2\Client\Provider\Dto;

class FillRequestDto {
    private $document_id;
    private $access;
    private $email_required;
    private $name_required;
    private $custom_message;
    private $notification_emails;
    private $url;

    public function __construct($document_id){
        $this->document_id = $document_id;
        $this->notification_emails = array();
    }

    public function addNotificationEmails($email, $name){
        array_push($this->notification_emails, array('email' => $email, 'name' => $name));
    }

    public function toArray()
    {
        $object = [
            'document_id' => $this->document_id,
            'access' => $this->access,
            'email_required' => $this->email_required,
            'name_required' => $this->name_required,
            'custom_message' => $this->custom_message,
            'notification_emails' => $this->notification_emails,
            'url' => $this->url,
        ];

        //ignoring empty values
        $object = array_filter( $object);
        return $object;
    }

    public function setDocumentId($document_id)
    {
        $this->document_id = $document_id;
    }

    public function setAccess($access)
    {
        $this->access = $access;
    }

    public function setEmailRequired($email_required)
    {
        $this->email_required = $email_required;
    }

    public function setNameRequired($name_required)
    {
        $this->name_required = $name_required;
    }

    public function setCustomMessage($custom_message)
    {
        $this->custom_message = $custom_message;
    }

    public function setNotificationEmails($notification_emails)
    {
        $this->notification_emails = $notification_emails;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getDocumentId()
    {
        return $this->document_id;
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function getEmailRequired()
    {
        return $this->email_required;
    }

    public function getNameRequired()
    {
        return $this->name_required;
    }

    public function getCustomMessage()
    {
        return $this->custom_message;
    }

    public function getNotificationEmails()
    {
        return $this->notification_emails;
    }

    public function getUrl()
    {
        return $this->url;
    }

}