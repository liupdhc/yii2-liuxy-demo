<?php
/**
 * FileName: ProtobufHelper.php
 * Author: liupeng
 * Date: 10/9/15
 */
namespace modules\components\helpers;

use yii\helpers\Inflector;

/**
 * Class ProtobufHelper
 * @package modules\components\helpers
 */
class ProtobufHelper
{
    public static function massiveAssign($pbObject, $assignments){
        if(!($pbObject instanceof \ProtobufMessage)){
            return;
        }
        $primitiveFields = $messageFields = [];
        foreach($pbObject->fields() as $field){
            if(is_int($field['type'])){
                //字段为基本类型
                $primitiveFields[$field['name']] = $field['type'];
            }else{
                //字段为其它消息类型
                $messageFields[$field['name']] = $field['type'];
            }
        }
        foreach($assignments as $fieldName => $fieldValue){
            //required|optional
            $setter = "set". Inflector::camelize($fieldName);
            //repeated
            $appender = "append". Inflector::camelize($fieldName);

            if(($isScalar = method_exists($pbObject, $setter)) === false
                && ($isRepeated = method_exists($pbObject, $appender)) === false){
                continue;
            }
            if(isset($primitiveFields[$fieldName])) {
                if ((is_scalar($fieldValue))) {
                    $pbObject->{$setter}($fieldValue);
                }else if(is_array($fieldValue)){
                    foreach($fieldValue as $v){
                        if(is_array($v)){
                            throw new \InvalidArgumentException("Can't assign multi-dimensional array values for field: {$fieldName}.");
                        }
                        $pbObject->{$appender}($v);
                    }
                }
            }else if(isset($messageFields[$fieldName])){
                if(is_object($fieldValue) && $fieldValue instanceof \ProtobufMessage){
                    $pbObject->{$setter}($fieldValue);
                    continue;
                }elseif(is_array($fieldValue)){
                    $currentClass = new \ReflectionClass($pbObject);
                    $className = $currentClass->getNamespaceName(). "\\" . $messageFields[$fieldName];
                    if(class_exists($className)){
                        if($isScalar){
                            $childPbObject = new $className();
                            self::massiveAssign($childPbObject, $fieldValue);
                            $pbObject->{$setter}($childPbObject);
                        }else{
                            foreach($fieldValue as $v){
                                $childPbObject = new $className();
                                self::massiveAssign($childPbObject, $v);
                                $pbObject->{$appender}($childPbObject);
                            }
                        }
                    }
                }else{
                    throw new \InvalidArgumentException("Can't assign an invalid value for field: {$fieldName}.");
                }
            }
        }
        return $pbObject;
    }
}