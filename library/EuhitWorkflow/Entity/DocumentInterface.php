<?php

interface EuhitWorkflow_Entity_DocumentInterface
{
    public function getId();

    public function getType();

    public function setType($type);

    public function getTitle();

    public function setTitle($title);

    public function getCreatedAt();

    public function setCreatedAt(DateTime $createdAt);

    public function getCreatedBy();

    public function setCreatedBy($createdBy = null);

    public function getSubmittedAt();

    public function setSubmittedAt(DateTime $submittedAt = null);

    public function getData();

    public function setData(array $data);

    public function getDatum($key, $default = null);

    public function setDatum($key, $value);
}
