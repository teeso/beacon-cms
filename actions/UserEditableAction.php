<?php
/**
 * Created by PhpStorm.
 * User: DezMonT
 * Date: 25.03.2015
 * Time: 16:53
 */
namespace app\actions;

use app\commands\RbacController;
use dosamigos\editable\EditableAction;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

class UserEditableAction extends  EditableAction
{
    public function beforeRun()
    {
        $class = $this->modelClass;
        $pk = Yii::$app->request->post('pk');
        $pk = unserialize(base64_decode($pk));
        $model = $class::findOne($pk);
        return $this->controller->checkAccess(RbacController::update_profile,['user'=>$model]);
    }

}