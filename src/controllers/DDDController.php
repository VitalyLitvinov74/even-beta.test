<?php
declare(strict_types=1);

namespace app\controllers;

use app\DDD\Cook;
use app\DDD\Meal;
use app\DDD\Waiter;
use app\forms\MealForm;
use app\Tables\MealsTable;
use Yii;
use yii\helpers\VarDumper;
use yii\rest\Controller;

final class DDDController extends Controller
{
    /**
     * Просим повара приготовить блюдо
     * @return void
     */
    public function actionCookMeal()
    {
        $form = new MealForm();
        if ($form->load(Yii::$app->request->post(), '') and $form->validate()) {
            $cook = Cook::restoreById((int) $form->cookId);
            $cook->makeADish($form->name, (int) $form->price);
        }
        VarDumper::dump($form->getErrors());
    }

    public function actionPopulatedMeals()
    {
        $menu = MealsTable::find()->all();
        return [
            'items' => $menu
        ];
    }

    /**
     * Как только официант принял посетителя в кафе, то для него создается чек (заводится счет)
     * @param string $visitorUuid
     * @return void
     */
    public function actionWelcomeToCafe(string $visitorUuid){
        $waiter = Waiter::restore();
        $waiter->acceptVisitor($visitorUuid);
    }

    /**
     * Когда официант приносит блюдо (bring a dish),
     * то одновременно с этим, это блюдо заносится в чек посетителя
     * @param string $visitorUuid
     * @param string $mealName
     * @param int $count
     * @return void
     */
    public function actionBringADish(string $visitorUuid, string $mealName, int $count)
    {
        $waiter = Waiter::restore();
        $waiter->bringADish(
            Meal::restoreByName($mealName),
            $count,
            $visitorUuid
        );
    }
}