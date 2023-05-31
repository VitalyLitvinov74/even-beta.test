<?php
declare(strict_types=1);

namespace app\controllers;

use app\Domain\Cook;
use app\Domain\Meal;
use app\Domain\Waiter;
use app\forms\MealForm;
use app\Tables\MealsTable;
use PHPUnit\Framework\Warning;
use Yii;
use yii\rest\Controller;

final class DDDController extends Controller
{
    /**
     * Просим повара приготовить блюдо
     * @param int $cookId
     * @return void
     */
    public function actionCookMeal()
    {
        $form = new MealForm();
        if ($form->load(Yii::$app->request->post()) and $form->validate()) {
            $cook = Cook::restoreById($form->cookId);
            $cook->makeADish($form->name, $form->price);
            $cook->persist();
        }
    }

    public function actionPopulateMeals()
    {
        $menu = MealsTable::find()->all();
        return [
            'items' => $menu
        ];
    }

    /**
     * Как только пользователь появился в кафе, для него создается чек (заводится счет)
     * @param string $visitorUuid
     * @return void
     */
    public function actionWelcomeToCafe(string $visitorUuid){
        $waiter = new Waiter();
        $waiter->createOrder($visitorUuid);
        $waiter->persist();
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
        $waiter = new Waiter();
        $waiter->bringADish(
            Meal::restoreByName($mealName),
            $count,
            $visitorUuid
        );
        $waiter->persist();
    }
}