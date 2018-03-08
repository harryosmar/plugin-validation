<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/8/18
 * Time: 3:37 PM
 */

namespace PluginSimpleValidate;

use PluginSimpleValidate\Exception\RuleNotExist;
use Zend\Diactoros\ServerRequest;

class FormValidation extends Validation implements \PluginSimpleValidate\Contracts\FormValidation
{
    const RULE_DELIMITER  = ',';

    const PARAM_DELIMITER  = ':';

    /**
     * @param ServerRequest $serverRequest
     * @param array $rules
     * @throws RuleNotExist
     */
    public function createFromPost(ServerRequest $serverRequest, $rules = [])
    {
        $body = $serverRequest->getParsedBody();

        foreach ($rules as $name => $values) {

            // create fields
            $field = new Field($name, $body[$name]);

            // rules list
            $rulesArr = array_filter(explode(self::RULE_DELIMITER, $values));

            foreach ($rulesArr as $rule) {
                // rule param list
                $paramArr = array_filter(explode(self::PARAM_DELIMITER, $rule));
                $ruleMethod = $paramArr[0];

                array_shift($paramArr);

                try {
                    call_user_func_array([$field, $ruleMethod], $paramArr);
                } catch (\Exception $exception) {
                    throw new RuleNotExist('wrong rule parameter');
                }
            }

            $this->addField($field);
        }
    }
}