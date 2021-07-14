<?php
/**
 * Validator input request
 */
namespace App\Components;

use Sirius\Validation\Validator as SiriusValidator;

/**
 * Validator input request
 */
class Validator
{
    private $errors;
    /**
     * Validate create request
     *
     * @param array $data
     * @return bool
     */
    public function validateAds(array $data)
    {
        $validator = new SiriusValidator();
        $validator
            ->add('text', 'required | AlphaNumeric', null, 'Invalid text value')
            ->add('price', 'required | Number', null, 'Invalid price value')
            ->add('limit', 'Integer | required ', null, 'Invalid limit value')
            ->add('banner', 'Required | Url', null, 'Invalid banner link');
        $validator->validate($data);
        if (!$validator->validate($data)) {
            foreach ($validator->getMessages() as $attribute => $messages) {
                foreach ($messages as $message) {
                    $this->errors[$attribute] = $message->getTemplate();
                }
            }
            return false;
        }
        return true;
    }
    /**
     * Validate update request
     *
     * @param array $data
     * @return bool
     */
    public function validateUpdateAds(array $data)
    {
        $validator = new SiriusValidator();
        $validator
            ->add('text', 'AlphaNumeric', null, 'Invalid text value')
            ->add('price', 'Number', null, 'Invalid price value')
            ->add('limit', 'Integer', null, 'Invalid limit value')
            ->add('banner', 'Url', null, 'Invalid banner link');
        $validator->validate($data);
        if (!$validator->validate($data)) {
            foreach ($validator->getMessages() as $attribute => $messages) {
                foreach ($messages as $message) {
                    $this->errors[$attribute] = $message->getTemplate();
                }
            }
            return false;
        }
        return true;
    }

    /**
     * return array validation errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
