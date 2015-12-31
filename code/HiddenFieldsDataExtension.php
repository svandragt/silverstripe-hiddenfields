<?php
class HiddenFieldsDataExtension extends DataExtension
{

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    public function updateCMSFields(FieldList $fields)
    {
        $owner = $this->owner;
        if (isset($owner::$hidden_fields)) {
            foreach ($owner::$hidden_fields as $field) {
                $fields->removeByName($field);
                $fields->push(new HiddenField($field, false));
            }
        }
    }
}
