<?php

namespace App\Presenters;

use App\Models\Category;

/**
 * Class CategoryPresenter
 *
 * @package namespace App\Presenters;
 */
class CategoryPresenter
{

    /**
     * category selects
     *
     * @param int $defaultCategoryId
     * @param string $nullText
     * @return string
     */
    public function getSelect($defaultCategoryId = 0, $nullText = '请选择', $nullValue = 0)
    {
        $category = Category::getNestedList('name', null, '&nbsp;&nbsp;&nbsp;&nbsp;');

        $select = "<select id='cate_id' name='cate_id' class='form-control'>";
        $select .= "<option value='".$nullValue."'>--".$nullText."--</option>";
        if ($category) {
            foreach ($category as $key => $value) {
                $selected = $key == $defaultCategoryId ? " selected " : "";
                $select .= "<option value='".$key."' ".$selected.">".$value."</option>";
            }
        }
        $select .= "</select>";

        return $select;
    }

}
